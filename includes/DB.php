<?php

// define globals
$DB_HOST = "localhost";
$DB_USER = "root";
$DB_PASS = "";
$DB_NAME = "php_ecommerce";

class DB
{
    private static $instance = null;
    private $conn;

    private function __construct()
    {
        $this->conn = new PDO("mysql:host=" . $GLOBALS['DB_HOST'] . ";dbname=" . $GLOBALS['DB_NAME'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASS']);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new DB();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }
}
