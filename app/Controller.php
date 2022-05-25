<?php

namespace App;
use App\Objects;
use \App\Main;

class Controller extends Objects {

    public static $messages = [];

    public static $curr_list_opt = 3;

    public static $sort = false;

    public static $list_start;

    protected $main;

    public function __construct(){
        $this->main = Main::instance();
        self::$curr_list_opt = intval($this->main->getCookie('curr_list_opt', 3));
    }

    public static function _instance($class){
        return parent::_instance($class);
    }

    public function auth(){
        return \App\Controllers\UserController::instance()->auth();
    }
}