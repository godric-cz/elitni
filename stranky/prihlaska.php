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
        if(!mailpole.value) {
            alert('Vyplňte prosím e-mail.')
            return false
        }
        mailpole.value = mailpole.value.trim()
        if(mailpole.value.search(/^\S+@\S+\.[a-z]+$/) !== 0) {
            alert('Zkontrolujte prosím, že e-mailová adresa je správná.')
            return false
        }
        mailpole.value = mailpole.value.toLowerCase()
        return true
    }
</script>

<div class="pruh obrazekHra" style="background-image: url(soubory/formular_uvodka.jpg); height: 300px;"></div>
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
                        <input type="text" name="mail" id="mailpole">
                    </div>
                    <div class="polozka">
                        Korespondenční adresa
                        <input type="text" name="polozky[Adresa]" id="adresa">
                    </div>
                    <div class="polozka">
                        Telefonní kontakt
                        <input type="text" name="polozky[Telefon]" id="telefon">
                    </div>
                    <div class="polozka vyber">
                        Máte zájem o ubytování?<br>
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
                    <?php if($GLOBALS['CONFIG']['lzeObjednatTricko']) { ?>
                        <div class="polozka vyber">
                            Máte zájem o tričko? (<a href="soubory/tricko.jpg" target="_blank">náhled</a>)<br>
                            <label>
                                <input type="radio" name="polozky[Tričko]" value="ano" checked="true">
                                <div class="pseudoinput"></div>
                                Ano
                            </label>
                            <label>
                                <input type="radio" name="polozky[Tričko]" value="ne">
                                <div class="pseudoinput"></div>
                                Ne
                            </label>
                        </div>
                        <div class="polozka vyber">
                            Vaše konfekční velikost<br>
                            <label>
                                <input type="radio" name="polozky[Velikost]" value="S">
                                <div class="pseudoinput"></div>
                                S
                            </label>
                            <label>
                                <input type="radio" name="polozky[Velikost]" value="M">
                                <div class="pseudoinput"></div>
                                M
                            </label>
                            <label>
                                <input type="radio" name="polozky[Velikost]" value="L">
                                <div class="pseudoinput"></div>
                                L
                            </label>
                            <label>
                                <input type="radio" name="polozky[Velikost]" value="XL">
                                <div class="pseudoinput"></div>
                                XL
                            </label>
                            <label>
                                <input type="radio" name="polozky[Velikost]" value="XXL">
                                <div class="pseudoinput"></div>
                                XXL
                            </label>
                        </div>
                    <?php } else { ?>
                        <input type="hidden" name="polozky[Tričko]" value="ne">
                    <?php } ?>
                    <div class="polozka vyber">
                        Jste<br>
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
                        <input type="submit" name="prihlasit" value="Odeslat přihlášku" onclick="return validuj()">
                    </div>
                </form>
            </div>
        </div>

        <?php } ?>

    </div>
</div>
