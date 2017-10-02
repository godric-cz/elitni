<?php

require 'src/_zavadec.php';


// určení stránky, která zpracuje požadavek

$povoleneVUrl = '/^[a-z]+$/';
$stranka = null;

if($_GET['stranka'] === '') {
    $stranka = 'hlavni.html';
} else if($_GET['stranka'] === 'hlavni') {
    $stranka = null;
} else if(preg_match($povoleneVUrl, $_GET['stranka'])) {
    if(is_file('stranky/' . $_GET['stranka'] . '.html')) {
        $stranka = $_GET['stranka'] . '.html';
    } else if(is_file('stranky/' . $_GET['stranka'] . '.php')) {
        $stranka = $_GET['stranka'] . '.php';
    }
}

if($stranka === null) {
    echo 'stránka neexistuje';
    header('HTTP/1.1 404 Not Found');
    exit();
}


// vykonání kódu stránky

$titulek = 'Festival elitního larpu'; // proměnné pro šablonu
ob_start();
include 'stranky/' . $stranka;
$obsah = ob_get_clean();


?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="soubory/styl.css">
    <title><?=$titulek?></title>
</head>
<body>

    <?php include('casti/hlavicka.html'); ?>
    <?=$obsah?>
    <?php include('casti/paticka.html'); ?>

</body>
</html>
