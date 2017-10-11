<?php

/**
 * Test výpisu aktivit s přihlašováním a odhlašováním
 */

$u = Uzivatel::zId(8); // TODO

if(post('prihlasit')) {
    try {
        Aktivita::zId(post('prihlasit'))->prihlas($u);
    } catch(ChybaPrihlasovani $e) {
        cookie_flag_push('program_' . get_class($e));
    }
    back();
}

if(post('odhlasit')) {
    Aktivita::zId(post('odhlasit'))->odhlas($u);
    back();
}


//echo $u->mail() . '<br><br>';

?>

<div class="pruh" style="padding-bottom: 200px">
    <div class="obsah">
        <h2 style="margin-bottom: 50px">Program</h2>
        <div class="box2">
            <div>

                <?php if(cookie_flag_pop('program_PrekrytiAktivit')) { ?>

                    V daném čase už máte přihlášenu jinou hru.<br><br>
                    <a href="" style="color: #fff">zpět</a>

                <?php } else if(cookie_flag_pop('program_Plno')) { ?>

                    Omlouváme se, hra už je plná.<br><br>
                    <a href="" style="color: #fff">zpět</a>

                <?php } else if(cookie_flag_pop('program_PrekrocenPocetAktivit')) { ?>

                    V této vlně už jste si přihlásili maximální možný počet her.<br><br>
                    <a href="" style="color: #fff">zpět</a>

                <?php } else { ?>

                    <div class="program">
                        <?php
                            $uzivatel = $u; // proměnná pro program
                            include 'casti/program-tabulka.php';
                        ?>
                    </div>

                <?php } ?>

            </div>
        </div>
    </div>
</div>

<script>
(function(){
    var sneaky = new ScrollSneak(location.hostname);

    for(i = 0, len = document.forms.length; i < len; i++) {
        document.forms[i].onclick = sneaky.sneak;
    }
})();
</script>
