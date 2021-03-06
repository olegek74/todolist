<?php
namespace Kernel;


class ConfLoad{

    private static $read_env;

    public static function getDbConf(){
        self::load();
        $params = [];
        foreach (self::$read_env as $param => $value){
            if(strpos($param, 'DB_') === 0){
                $param = str_replace('DB_', '', $param);
                $params[strtolower($param)] = $value;
            }
        }
        return $params;
    }

    public static function load(){
        if(is_null(self::$read_env)){
            try {
                $dotenv = \Dotenv\Dotenv::createImmutable(ROOTPATH);
                self::$read_env = $dotenv->load();
            }
            catch (\Exception $exception){
                file_put_contents(__DIR__.DS.'log.txt', $exception->getMessage()."\n",  FILE_APPEND);
                die('error config');
            }
            if(empty(self::$read_env)) die('Config file is empty');
        }
    }
}
?>