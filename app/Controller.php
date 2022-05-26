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

    public static function instance($class = __CLASS__){
        return parent::instance($class);
    }

    public function auth(){
        return \App\Controllers\UserController::instance()->auth();
    }

    public function __call($name, $value){
        $this->not_page();
    }

    public function not_page(){
        $view = new \App\View\NotPage;
        $view->display();
    }
}