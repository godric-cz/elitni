<?php

if(post('prihlasit')) {

    // TODO duplicitní přihlášky?
    // TODO pohlaví
    $polozky = post('polozky');
    $polozky['E-mail'] = post('mail');
    $db->query(
        'INSERT INTO uzivatel(mail, pohlavi, prihlaska) VALUES (?, ?, ?)',
        post('mail'),
        'm', // TODO
        json_encode($polozky, JSON_UNESCAPED_UNICODE)
    );

    setcookie('prihlaska_uspech', '1');
    back();

}

$vyplneno = false;
if(isset($_COOKIE['prihlaska_uspech'])) {
    setcookie('prihlaska_uspech', null, 1);
    $vyplneno = true;
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

        <?php if(!$vyplneno) { ?>

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

        <?php } else { ?>

        <div class="box2">
            <div>
                <div class="polozka">
                    Děkujeme, Vaši přihlášku jsme obdrželi a přidali Vaše jméno na seznam hostů.
                </div>
            </div>
        </div>

        <?php } ?>

    </div>
</div>
