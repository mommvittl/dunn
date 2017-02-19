<?php
function __autoload($class) {

    preg_match_all('/[A-Z][^A-Z]*/', $class, $results);
    $results =  end($results[0]);
    $pathToClassFile = __DIR__ . '/../'. strtolower($results). '/' . $class.'.php';
    if (file_exists($pathToClassFile)) {
        require_once $pathToClassFile;
    }
}

define("HOST_NAME", 'localhost');
define("DB_NAME", 'snake');
define("USER_NAME", 'vtrl345ih');
define("PASSWORD", 'qmr67ipk');