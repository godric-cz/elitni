<?php

require 'src/_zavadec.php';


// určení stránky, která zpracuje požadavek

$povoleneVUrl = '/^[a-z]+$/';
$stranka = null;

if($_GET['stranka'] === '') {
    $stranka = 'hlavni.php';
} else if($_GET['stranka'] === 'hlavni') {
    $stranka = null;
} else if(
    preg_match($povoleneVUrl, $_GET['stranka']) &&
    is_file('stranky/' . $_GET['stranka'] . '.php')
) {
    $stranka = $_GET['stranka'] . '.php';
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
    <link rel="icon" href="soubory/diamond.png" type="image/png" sizes="16x16">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300" rel="stylesheet">
</head>
<body>

    <?php include('casti/hlavicka.html'); ?>
    <?=$obsah?>
    <?php include('casti/paticka.html'); ?>

</body>
</html>
