<?php

namespace App;

class Objects {
    private static $objects = [];

    public static function instance($class){
        if(!isset(self::$objects[$class])){
            self::$objects[$class] = new $class;
        }
        return self::$objects[$class];
    }
}