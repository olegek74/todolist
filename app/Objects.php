<?php

namespace App;

class Objects {
    private static $objects = [];

    public static function _instance($class){
        if(!isset(self::$objects[$class])){
            self::$objects[$class] = new $class;
            $class::$object = self::$objects[$class];
        }
        return self::$objects[$class];
    }

    public function __call($name, $value){
        $this->not_page();
    }

    public function not_page(){
        $view = new \App\View\NotPage;
        $view->display();
    }
}