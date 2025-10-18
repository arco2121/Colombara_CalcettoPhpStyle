<?php
require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$dotenv->required("HOST")->notEmpty();
class database
{
    private static $istance = null;
    private $db;

    private function __construct()
    {
        $this -> db = new PDO("mysql:host=".$_ENV['HOST'].";dbname=".$_ENV['DATABASE'], "root", "",[
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

