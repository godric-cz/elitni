<?php

// pomocné funkce
require __DIR__ . '/_funkce.php';


// načtení konfigurace
$nastaveni = realpath(__DIR__ . '/../nastaveni');
$config = require "$nastaveni/default.php";

if($_SERVER['REMOTE_ADDR'] == '127.0.0.1' || $_SERVER['REMOTE_ADDR'] == '::1') {
    $specificConfig = @include "$nastaveni/localhost.php";
} else {
    $specificConfig = @include "$nastaveni/production.php";
}

if(is_array($specificConfig)) {
    $config = config_merge($config, $specificConfig);
}

$GLOBALS['CONFIG'] = $config;


// zobrazení chyb
if($GLOBALS['CONFIG']['errors']) {
    error_reporting(E_ALL);
    ini_set('display_errors', true);
} else {
    ini_set('display_errors', false); // záměrně error_reporting bez změny kvůli logování
}


// automatické načítání tříd
spl_autoload_register(function($trida) {
    require __DIR__ . '/' . $trida . '.php';
});


// databáze
$db = new Db;

DbObject::$sdb = $db;
