<?php

require 'src/_zavadec.php';


// určení stránky, která zpracuje požadavek

try {
    $url = Url::zCesty($_GET['stranka']);
    if($url->stranka() === '') {
        $stranka = 'hlavni.php';
    } else if($url->stranka() === 'hlavni') {
        throw new NepovolenaUrl;
    } else {
        $stranka = $url->stranka() . '.php';
    }
    if(!is_file('stranky/' . $stranka)) {
        throw new NepovolenaUrl;
    }
} catch(NepovolenaUrl $e) {
    echo 'stránka neexistuje';
    header('HTTP/1.1 404 Not Found');
    exit();
}


// vykonání kódu stránky

$titulek = 'Festival elitních larpů'; // proměnné pro šablonu (stránka je může měnit)
ob_start();
include 'stranky/' . $stranka;
$obsah = ob_get_clean();


// další proměnné pro šablonu

$httpRoot = str_repeat('../', $url->zanoreni());


?>
<!DOCTYPE html>
<html>
<head>
    <title><?=$titulek?></title>
    <base href="<?=$httpRoot?>"> <!-- pozor na pořadí -->
    <script src="soubory/pohyb-menu.js"></script>
    <script src="soubory/scroll-sneak.js"></script>
    <link rel="stylesheet" type="text/css" href="soubory/styl.css?v3">
    <link rel="icon" href="soubory/diamond.png" type="image/png" sizes="16x16">
    <meta property="og:url"             content="http://festivalelitnichlarpu.vip">
    <meta property="og:title"           content="Festival elitních larpů">
    <meta property="og:description"     content="Exkluzivní zážitek. Pouze hry v červených číslech. Larpový galavečer. V.I.P. hosté. Šampaňské a červený koberec. To nejlepší z české larpové scény na Festivalu elitních larpů. V Brně, samozřejmě.">
    <meta property="og:image"           content="http://festivalelitnichlarpu.vip/soubory/fb_logo.jpg">
</head>
<body>

    <?php include('casti/hlavicka.html'); ?>
    <?=$obsah?>
    <?php include('casti/paticka.html'); ?>

</body>
</html>
