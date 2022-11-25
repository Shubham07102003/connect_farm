<?php
namespace Database;

use Config\Config;
use PDO;
use PDOException;

class Connect{

public static $db;

public function __construct()
{
    try {
        //initialize PDO
        self::$db = new PDO('mysql:host=' . Config::getHost() . ';dbname=' . Config::getDbname() . ';port=' . Config::getPort() . ';charset=utf8', Config::getUname(), Config::getPassword());
        self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


        //check ii
    }
catch(PDOException $ex){
    die('Unable to connect to database as ' . $ex->getMessage());
}

}

    /**
     * @return PDO
     */
    public static function getDb()
    {
        return self::$db;
    }





}




