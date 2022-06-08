<?php

namespace Kernel;
use Kernel\Objects;
use Kernel\Main;

class Controller extends Objects {

    public static $messages = [];

    public static $curr_list_opt = 50;

    public static $sort = false;

    public static $list_start;

    public static $page;

    protected $main;

    public function __construct(){
        $this->main = Main::instance();
        self::$curr_list_opt = intval($this->main->getCookie('curr_list_opt', 50));
        self::$sort = $this->main->get('sort', false);
        self::$page = $this->main->getInt('page', 0);
        if(self::$page < 1) self::$page = 1;
        self::$list_start = self::$curr_list_opt * (self::$page - 1);
        self::$messages[] = $this->main->getSess('message', null);
        $this->main->setSess('message', null);
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

    protected function buildErrorMessage($errors, $mess = ''){
        foreach ($errors as $error) {
            $mess .= '' . $error . '<br>';
        }
        $this->main->setSess('message', 'error|' . $mess);
    }

    public function close(){
        \App\View\Footer::instance()->display();
    }

    public function __call($name, $value){
        $this->not_page();
    }

    public function not_page(){
        $view = new \App\View\NotPage;
        $view->display();
    }

    public function buildFieldValueByKey($assoclist, $key){
        $fieldValueByKey = [];
        foreach($assoclist as $item){
            if($item[$key]) $fieldValueByKey[] = (int) $item[$key];
        }
        return $fieldValueByKey;
    }

    protected function redirect($url){
        header('location:'.$url);
        die;
    }
}