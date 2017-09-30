<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
spl_autoload_register(function($trida) {
    require __DIR__ . '/src/' . $trida . '.php';
});
require 'src/funkce.php';
DbObject::$sdb = new Db;

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
    } else if($u && $a->volnoPro($u)) {
        echo '
            <form method="post">
                <input type="hidden" name="prihlasit" value="' . $a->id() . '">
                <input type="submit" value="přihlásit">
            </form>
        ';
    }
    echo '<br><br>';
}
