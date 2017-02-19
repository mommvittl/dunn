<?php

final class PDOLib {

    private $pdo; // PDO instance;

    public static function getInstance() {
        static $inst = null;
        if ($inst === null) {
            $inst = new PDOLib();
        }
        return $inst;
    }

    public function getPDO() {
        return $this->pdo;
    }

    private function __construct() {
        $dsn = "mysql:host=" . HOST_NAME . ";dbname=" . DB_NAME . ";charset=utf8";
//      $opt = array( PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
//           PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
//      $this->pdo = new PDO($dsn, USER_NAME, PASSWORD, $opt);
        $this->pdo = new PDO($dsn, USER_NAME, PASSWORD);
    }

    private function __clone() {

    }

}
