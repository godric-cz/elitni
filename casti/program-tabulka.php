<?php

namespace program_tabulka;

use \Aktivita;
use \Blok;
use \Uzivatel;

$uzivatel = $uzivatel ?? null; // musí být nastaveno zvenčí, pokud se má přihlašovat

$bloky = [
    Blok::zRetezcu('2017-11-03 18:00', '2017-11-03 22:00'),
    Blok::zRetezcu('2017-11-04 09:00', '2017-11-04 13:00'),
    Blok::zRetezcu('2017-11-04 15:00', '2017-11-04 19:00'),
    Blok::zRetezcu('2017-11-05 10:00', '2017-11-05 14:00'),
];

$aktivity = Aktivita::zVsech();

////////////////////
// pomocné funkce //
////////////////////

function aktivita_zabira_blok($aktivita, $blok) {
    static $a = 1;
    if($aktivita->nazev() == 'Bucañero') // FIXME testovací
        return max($a--, 0);
    else
        return 0;
}

function den_cesky($zacatek) {
    static $dny = [
        'pondělí',
        'úterý',
        'středa',
        'čtvrtek',
        'pátek',
        'sobota',
        'neděle'
    ];
    return $dny[$zacatek->format('w')];
}

/**
 * sestavit program jako řídkou matici s aktivitou a délkou v blocích
 */
function sestav_program_z($aktivity, $bloky) {
    $program = [];

    sort_by_methods($aktivity, 'zacatek', 'nazev');
    foreach($aktivity as $aktivita) {
        $blok  = zacatek_na_blok($aktivita->zacatek());
        $radek = 0;

        // najít první prázdný řádek a vložit tam aktivitu
        while(!empty($program[$radek][$blok])) {
            $radek++;
        }
        $program[$radek][$blok] = [
            'aktivita'  =>  $aktivita,
            'delka'     =>  1,
        ];

        // vložit aktivitu i do dalších bloků, které zabírá + spočítat délku
        $dalsiBlok = $blok + 1;
        while(aktivita_zabira_blok($aktivita, $dalsiBlok)) {
            $program[$radek][$blok]['delka']++; // délka pro colspan tabulky
            $program[$radek][$dalsiBlok]['aktivita'] = $aktivita; // blokace pozice pro další hry
            $dalsiBlok++;
        }
    }

    return $program;
}

function zacatek_na_blok($zacatek) {
    $h = $zacatek->format('H'); // TODO
    if($h == 18) return 0;
    if($h ==  9) return 1;
    if($h == 15) return 2;
    if($h == 10) return 3;
}

function zobraz_aktivitu($aktivita, $delka, $blok, $uzivatel) {
    $extra = '';
    if($aktivita->zacatek() != $blok->zacatek() || $aktivita->konec() != $blok->konec()) {
        $zacatek = $aktivita->zacatek()->format('H:i');
        $konec = $aktivita->konec()->format('H:i');
        $extra = "<br>({$zacatek}–{$konec})";
    }

    ?>
        <td colspan="<?=$delka?>">
            <?=$aktivita->nazev()?>
            <?=$extra?>
            <?php if($uzivatel) zobraz_prihlasovani($aktivita, $uzivatel); ?>
        </td>
    <?php
}

function zobraz_bloky($bloky) {
    echo '<tr>';
    foreach($bloky as $blok) {
        ?>
            <th>
                <div class="den">
                    <?=ucfirst(den_cesky($blok->zacatek()))?>
                </div>
                <div class="cas">
                    <?=$blok->zacatek()->format('H:i')?>–<?=$blok->konec()->format('H:i')?>
                </div>
            </th>
        <?php
    }
    echo '</tr>';
}

function zobraz_prazdnou_bunku() {
    echo '<td></td>';
}

function zobraz_prihlasovani($aktivita, $uzivatel) {
    if($uzivatel->prihlasenNa($aktivita)) {
        ?>
            <form method="post">
                přihlášeno –
                <input type="hidden" name="odhlasit" value="<?=$aktivita->id()?>">
                <input type="submit" value="odhlásit">
            </form>
        <?php
    } else if($aktivita->volnoPro($uzivatel)) {
        ?>
            <form method="post">
                <input type="hidden" name="prihlasit" value="<?=$aktivita->id()?>">
                <input type="submit" value="přihlásit">
            </form>
        <?php
    }
}

function zobraz_program($program, $bloky, $uzivatel) {
    echo '<table>';
    zobraz_bloky($bloky);
    foreach($program as $radek => $bunky) {
        echo '<tr>';

        foreach($bloky as $i => $blok) {
            $bunka = $bunky[$i] ?? null;
            if($bunka) {

                // vynechaná buňka, pokud ta předchozí má větší colspan
                if(!isset($bunka['delka'])) continue;

                zobraz_aktivitu($bunka['aktivita'], $bunka['delka'], $blok, $uzivatel);
            } else {
                zobraz_prazdnou_bunku();
            }
        }

        echo '</tr>';
    }
    echo '</table>';
}

////////////////
// hlavní kód //
////////////////

$start = microtime(true);

$program = sestav_program_z($aktivity, $bloky);
zobraz_program($program, $bloky, $uzivatel);

echo '<br>' . (microtime(true) - $start);
