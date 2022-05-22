<?php
namespace App;
defined('ROOTPATH') or die('access denied');
class DB {

    private static $host = 'localhost';
    private static $dbname = 'todolist';
    private static $user = 'mysql';
    private static $password = 'mysql';
    private static $db = null;
    private static function db_conn(){
        if(!self::$db){
            if(!self::$db = mysqli_connect(self::$host, self::$user, self::$password, self::$dbname)){
                die('error connect to db');
            }
            mysqli_set_charset(self::$db, "utf8mb4");
        }
    }
    public static function instance(){
        self::db_conn();
    }
    public static function query($query){
        return mysqli_query(self::$db, $query);
    }
    public static function escape($string){
        return mysqli_real_escape_string(self::$db, $string);
    }
}
?>