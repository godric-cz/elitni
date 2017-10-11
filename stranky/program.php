<?php

/**
 * Test výpisu aktivit s přihlašováním a odhlašováním
 */

$u = Uzivatel::zId(8); // TODO

if(post('prihlasit')) {
    Aktivita::zId(post('prihlasit'))->prihlas($u);
    back();
}

if(post('odhlasit')) {
    Aktivita::zId(post('odhlasit'))->odhlas($u);
    back();
}


//echo $u->mail() . '<br><br>';

?>

<div class="pruh">
    <div class="obsah">
        <h2 style="margin-bottom: 50px">Program</h2>
        <div class="box2">
            <div>
            <div class="program">
                <?php
                    $uzivatel = $u; // proměnná pro program
                    include 'casti/program-tabulka.php';
                ?>
            </div>
            </div>
        </div>
    </div>
</div>

