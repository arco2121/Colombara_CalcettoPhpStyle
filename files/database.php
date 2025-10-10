<?php
namespace files;
use PDO;

class database
{
    private static $istance = null;
    private $db;

    private function __construct()
    {
        $this -> db = new PDO("mysql:host=localhost;dbname=col_php_database", "root", "",[
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }

    public static function getInstance()
    {
        if (self::$istance == null) {
            self::$istance = new self();
        }
        return self::$istance;
    }

    public function getConnection()
    {
        return $this -> db;
    }
}