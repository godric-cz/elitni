<?php

if(post('prihlasit')) {

    if(Uzivatel::zMailu(post('mail'))) {
        cookie_flag_push('prihlaska_duplicitni');
        back();
    }

    $polozky = post('polozky');
    $polozky['E-mail'] = post('mail');
    $db->query(
        'INSERT INTO uzivatel(mail, pohlavi, prihlaska) VALUES (?, ?, ?)',
        post('mail'),
        post('pohlavi'),
        json_encode($polozky, JSON_UNESCAPED_UNICODE)
    );

    cookie_flag_push('prihlaska_uspech');
    back();

}

?>

<script>
    function validuj(e) {
        // TODO validace
        return true;
    }
</script>

<div class="pruh" style="background-image: url(soubory/formular_uvodka.jpg); height: 300px; background-size: auto 400%; background-position: 50% 37%"></div>
<div class="pruh">
    <div class="obsah">

        <?php if(cookie_flag_pop('prihlaska_uspech')) { ?>

        <div class="box2">
            <div>
                <div class="polozka">
                    Děkujeme, Vaši přihlášku jsme obdrželi a přidali Vaše jméno na seznam hostů.
                </div>
            </div>
        </div>

        <?php } else if(cookie_flag_pop('prihlaska_duplicitni')) { ?>

        <div class="box2">
            <div>
                <div class="polozka">
                    Už jste přihlášeni.
                </div>
            </div>
        </div>

        <?php } else { ?>

        <?php include 'casti/prihlaska-text.html' ?>

        <div class="box2">
            <!-- TODO nadpis -->
            <div>
                <form method="post">
                    <div class="polozka">
                        Jméno a příjmení hosta festivalu
                        <input type="text" name="polozky[Jméno]">
                    </div>
                    <div class="polozka">
                        Preferované oslovení hosta festivalu
                        <input type="text" name="polozky[Oslovení]">
                    </div>
                    <div class="polozka">
                        E-mailová adresa
                        <input type="text" name="mail">
                    </div>
                    <div class="polozka vyber">
                        Máte zájem o ubytování z pátku na sobotu?<br>
                        <label>
                            <input type="radio" name="polozky[Ubytování]" value="ano" checked="true">
                            <div class="pseudoinput"></div>
                            Ano
                        </label>
                        <label>
                            <input type="radio" name="polozky[Ubytování]" value="ne">
                            <div class="pseudoinput"></div>
                            Ne
                        </label>
                    </div>
                    <div class="polozka vyber">
                        Pohlaví<br>
                        <label>
                            <input type="radio" name="pohlavi" value="m" checked="true">
                            <div class="pseudoinput"></div>
                            Muž
                        </label>
                        <label>
                            <input type="radio" name="pohlavi" value="f">
                            <div class="pseudoinput"></div>
                            Žena
                        </label>
                    </div>
                    <div class="polozka">
                        Chcete nám ještě něco říci?
                        <textarea name="polozky[Poznámka]"></textarea>
                    </div>
                    <div class="odeslat">
                        <input type="submit" name="prihlasit" value="Odeslat přihlášku" onclick="return validuj(this)">
                    </div>
                </form>
            </div>
        </div>

        <?php } ?>

    </div>
</div>
