<?php

namespace Kernel;
use Kernel\Objects;
use Kernel\Main;

class Controller extends Objects {

    public static $messages = [];

    public static $curr_list_opt = 3;

    public static $sort = false;

    public static $list_start;

    protected $main;

    public function __construct(){
        $this->main = Main::instance();
        self::$curr_list_opt = intval($this->main->getCookie('curr_list_opt', 3));
        self::$sort = $this->main->get('sort', false);
        self::$list_start = $this->main->getInt('list_start', 0);
    }

    public static function instance($class = __CLASS__){
        return parent::instance($class);
    }

    public function auth(){
        try {
            return \App\Controllers\UserController::instance()->auth();
        }
        catch (\Error $error){
            file_put_contents(__DIR__.DS.'log.txt', $error->getMessage()."\n",  FILE_APPEND);
        }
    }

    public function __call($name, $value){
        $this->not_page();
    }

    public function not_page(){
        $view = new \App\View\NotPage;
        $view->display();
    }
}