<?php
namespace Kernel;
use Aura\SqlQuery\QueryFactory;
defined('ROOTPATH') or die('access denied');
class DB {

    private static $host;
    private static $dbname;
    private static $user;
    private static $password;
    private static $pdo = null;
    private static $QF;

    private static function db_conn(){
        if(!self::$pdo){
            self::getConfig();
            try {
                self::$pdo = new \PDO('mysql:host='.self::$host.';dbname='.self::$dbname.';charset=utf8mb4', self::$user, self::$password);
            }
            catch (\PDOException $exception){
                file_put_contents(__DIR__.DS.'log.txt', $exception->getMessage()."\n",  FILE_APPEND);
                die('db error');
            }
        }
    }

    public static function createFactory(){
        self::db_conn();
        if(!self::$QF) self::$QF = new QueryFactory('mysql');
        return self::$QF;
    }

    private static function getConfig(){
        foreach(\Kernel\ConfLoad::getDbConf() as $name => $val){
            self::$$name = $val;
        }
    }

    public static function instance(){
        self::db_conn();
    }

    public static function get_insert_id(){
        return self::$pdo->lastInsertId();
    }

    public static function escape($string){
        return self::$pdo->quote($string);
    }

    public static function execute($query){
        $sth = self::$pdo->prepare($query->getStatement());
        $sth->execute($query->getBindValues());
        return $sth;
    }
}
?>