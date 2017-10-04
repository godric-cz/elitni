<?php

error_reporting(E_ALL); // TODO zobrazení na produkci
ini_set('display_errors', true);

spl_autoload_register(function($trida) {
    require __DIR__ . '/' . $trida . '.php';
});

require __DIR__ . '/_funkce.php';

$db = new Db;

DbObject::$sdb = $db;
