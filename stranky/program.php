<?php

/**
 * Test výpisu aktivit s přihlašováním a odhlašováním
 */

$mail = 'godric@korh.cz';

$u = Uzivatel::zMailu($mail);

if(post('prihlasit')) {
    Aktivita::zId(post('prihlasit'))->prihlas($u);
    back();
}

if(post('odhlasit')) {
    Aktivita::zId(post('odhlasit'))->odhlas($u);
    back();
}

///////////////////////////////////////////////
echo '<style>
    table { width: 100%; }
    td { border: solid; text-align: center; width: 25%; height: 100px; }
</style>';

include 'casti/program-tabulka.php';
die();



$aktivity = Aktivita::zVsech();




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
