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

$titulek = 'Festival elitního larpu'; // proměnné pro šablonu (stránka je může měnit)
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
    <link rel="stylesheet" type="text/css" href="soubory/styl.css">
    <link rel="icon" href="soubory/diamond.png" type="image/png" sizes="16x16">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300" rel="stylesheet">
    <meta property="og:url"                content="http://festivalelitnichlarpu.vip" />
    <meta property="og:title"              content="Festival elitních larpů" />
    <meta property="og:description"        content="Ten nejelitnější" />
    <meta property="og:image"              content="soubory/fb_logo.jpg" />
</head>
<body>

    <?php include('casti/hlavicka.html'); ?>
    <?=$obsah?>
    <?php include('casti/paticka.html'); ?>

</body>
</html>
