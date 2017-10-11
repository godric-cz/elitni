<?php

/**
 * Test výpisu aktivit s přihlašováním a odhlašováním
 */

$u = isset($_COOKIE['prednastaveny_mail']) ? Uzivatel::zMailu($_COOKIE['prednastaveny_mail']) : null;

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

if(isset($_POST['zadatMail'])) {
    $u = Uzivatel::zMailu(post('zadatMail'));
    if(!$u) {
        cookie_flag_push('program_neexistujici_mail');
    } else {
        setcookie('prednastaveny_mail', post('zadatMail'));
    }
    back();
}

if(isset($_POST['zrusitMail'])) {
    setcookie('prednastaveny_mail', null);
    back();
}

?>

<div class="pruh" style="padding-bottom: 200px">
    <div class="obsah">
        <h2 style="margin-bottom: 50px">Program</h2>

        <div class="box2">
            <div>

                <?php if(cookie_flag_pop('program_neexistujici_mail')) { ?>

                    E-mailová adresa bohužel není na seznamu hostů, nejdříve se tedy prosím <a href="prihlaska" style="color: #fff">přihlašte na festival</a>.<br><br>
                    <a href="" style="color: #fff">zpět</a>

                <?php } else if(!$u) { ?>

                    <form method="post">
                        <div class="polozka">
                            Zadejte prosím e-mail, se kterým jste se přilásili na festival.
                            <input type="text" name="zadatMail">
                        </div>
                        <div class="odeslat">
                            <input type="submit" value="Pokračovat k přihlašování her">
                        </div>
                    </form>

                <?php } else if(cookie_flag_pop('program_PrekrytiAktivit')) { ?>

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
                            if(strtotime($GLOBALS['CONFIG']['startRegu']) < time()) {
                                $uzivatel = $u; // proměnná pro program (jen pokud už běží registrace)
                            } else {
                                $uzivatel = null;
                            }
                            include 'casti/program-tabulka.php';
                        ?>
                    </div>

                <?php } ?>

            </div>
        </div>

        <?php if($u) { ?>
            <br><br>
            Přihlašujete se jako <em><?=$u->mail()?></em>. Pokud to nejste vy, můžete si
            <form method="post" style="display: inline;">
                <input type="hidden" name="zrusitMail" value="1">
                <input type="submit" value="zvolit jiný e-mail" style="padding:0; background: none; border: 0; font: inherit; color: #fff; cursor: pointer;">.
            </form>
        <?php } ?>
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
