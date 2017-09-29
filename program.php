<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
spl_autoload_register(function($trida) {
    require __DIR__ . '/src/' . $trida . '.php';
});
DbObject::$sdb = new Db;

/**
 * Test výpisu aktivit s přihlašováním a odhlašováním
 */

$u = Uzivatel::zMailu('godric@korh.cz');

foreach(Aktivita::zVsech() as $a) {
    echo $a->nazev() . '<br>';
    if($u && $u->prihlasenNa($a)) {
        echo 'přihlášeno – odhlásit';
    } else if($u && $a->volnoPro($u)) {
        echo 'přihlásit';
    }
    echo '<br><br>';
}
