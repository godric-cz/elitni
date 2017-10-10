<?php

/**
 * Test výpisu aktivit s přihlašováním a odhlašováním
 */

$u = Uzivatel::zMailu('godric@korh.cz');

if(post('prihlasit')) {
    Aktivita::zId(post('prihlasit'))->prihlas($u);
    back();
}

if(post('odhlasit')) {
    Aktivita::zId(post('odhlasit'))->odhlas($u);
    back();
}

///////////////////////////////////////////////

function aktivita_zabira_blok($aktivita, $blok) {
    static $a = 1;
    if($aktivita->nazev() == 'Bucañero') // FIXME testovací
        return max($a--, 0);
    else
        return 0;
}

function zacatek_na_blok($zacatek) {
    $h = $zacatek->format('H'); // TODO
    if($h == 18) return 0;
    if($h ==  9) return 1;
    if($h == 15) return 2;
    if($h == 10) return 3;
}

$aktivity = Aktivita::zVsech();
sort_by_method($aktivity, 'zacatek');

// sestavit program jako matici
$program = [];
foreach($aktivity as $aktivita) {
    $blok = zacatek_na_blok($aktivita->zacatek()) ;
    $radek = 0;
    while(!empty($program[$radek][$blok])) {
        $radek++;
    }
    $program[$radek][$blok] = [
        'aktivita'  =>  $aktivita,
        'delka'     =>  1,
    ];

    $dalsiBlok = $blok + 1;
    while(aktivita_zabira_blok($aktivita, $dalsiBlok)) {
        $program[$radek][$blok]['delka']++; // délka pro colspan tabulky
        $program[$radek][$dalsiBlok]['aktivita'] = $aktivita; // blokace pozice pro další hry
        $dalsiBlok++;
    }

}

// vytisknout vč. prázdných polí
$vsechnyBloky = [
    [
        'zacatek'   =>  new DateTimeImmutable('2017-11-03 18:00:00'),
        'konec'     =>  new DateTimeImmutable('2017-11-03 22:00:00'),
    ],
    [
        'zacatek'   =>  new DateTimeImmutable('2017-11-04 09:00:00'),
        'konec'     =>  new DateTimeImmutable('2017-11-04 13:00:00'),
    ],
    [
        'zacatek'   =>  new DateTimeImmutable('2017-11-04 15:00:00'),
        'konec'     =>  new DateTimeImmutable('2017-11-04 19:00:00'),
    ],
    [
        'zacatek'   =>  new DateTimeImmutable('2017-11-05 10:00:00'),
        'konec'     =>  new DateTimeImmutable('2017-11-05 14:00:00'),
    ],
];

echo '<table border="1">';
foreach($program as $radek => $bloky) {
    echo '<tr>';
    foreach($vsechnyBloky as $blokId => $blok) {
        //echo '<td colspan="' . $obsah['delka'] . '">' . $obsah['aktivita']->zacatek()->format('H') . '</td>';
        $nazev = '';
        $delka = 1;
        $extra = '';
        if(isset($bloky[$blokId])) {
            if(!isset($bloky[$blokId]['delka'])) continue; // colspanová buňka
            $aktivita = $bloky[$blokId]['aktivita'];
            $nazev = $aktivita->nazev();
            $delka = $bloky[$blokId]['delka'];
            if($aktivita->zacatek() != $blok['zacatek'] || $aktivita->konec() != $blok['konec']) {
                $extra = '<br>(' . $aktivita->zacatek()->format('H:i') . '–' . $aktivita->konec()->format('H:i') . ')';
            }
        }
        echo "<td colspan='$delka'><!--$radek $blokId--> $nazev $extra</td>";
    }
    echo '</tr>';
}

die();

//////////////////////////////////////////////

foreach(Aktivita::zVsech() as $a) {
    echo $a->nazev() . '<br>';
    if($u && $u->prihlasenNa($a)) {
        echo '
            <form method="post">
                přihlášeno –
                <input type="hidden" name="odhlasit" value="' . $a->id() . '">
                <input type="submit" value="odhlásit">
            </form>
        ';
    } else if($u && $u->organizuje($a)) {
        echo 'organizátor<br><br>';
    } else if($u && $a->volnoPro($u)) {
        echo '
            <form method="post">
                <input type="hidden" name="prihlasit" value="' . $a->id() . '">
                <input type="submit" value="přihlásit">
            </form>
        ';
    }
    echo '<br>';
}
