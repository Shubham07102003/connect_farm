<?php
namespace Config;
// The Fusion Force authors

class Config{
    private static $dbname = "u182278162_1sec" ;// give here the database name
    private static $uname = "u182278162_1sec";//give the username
    private static $password ="@Anu123456"; //give here the password
    private static $host = "localhost"; // change if needed
    private static $port = "3306"; //change if needed

    /**
     * @return string
     */
    public static function getDbname()
    {
        return self::$dbname;
    }

    /**
     * @return string
     */
    public static function getHost()
    {
        return self::$host;
    }

    /**
     * @return string
     */
    public static function getPassword()
    {
        return self::$password;
    }

    /**
     * @return string
     */
    public static function getUname()
    {
        return self::$uname;
    }

    /**
     * @return string
     */
    public static function getPort()
    {
        return self::$port;
    }

}

