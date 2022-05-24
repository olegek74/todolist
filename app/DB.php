<?php
namespace App;
defined('ROOTPATH') or die('access denied');
class DB {

    private static $host;
    private static $dbname;
    private static $user;
    private static $password;
    private static $db = null;

    private static function db_conn(){
        if(!self::$db){
            self::getConfig();
            if(!self::$db = mysqli_connect(self::$host, self::$user, self::$password, self::$dbname)){
                die('error connect to db');
            }
            mysqli_set_charset(self::$db, "utf8mb4");
        }
    }

    private static function getConfig(){
        foreach(\App\ConfLoad::getDbConf() as $name => $val){
            self::$$name = $val;
        }
    }

    public static function instance(){
        self::db_conn();
    }

    public static function query($query){
        return mysqli_query(self::$db, $query);
    }

    public static function insert_id(){
        return mysqli_insert_id(self::$db);
    }

    public static function escape($string){
        return mysqli_real_escape_string(self::$db, $string);
    }
}
?>