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

    //protected static $referrer_param = ['sort' => false, 'list_start' => false];

    public function __construct(){
        $this->main = Main::instance();
        self::$curr_list_opt = intval($this->main->getCookie('curr_list_opt', 3));
        self::$sort = $this->main->get('sort', false);
        self::$list_start = $this->main->getInt('list_start', 0);
        self::$messages[] = $this->main->getSess('message', null); //var_dump(self::$messages); die;
        $this->main->setSess('message', null);
        //file_put_contents(ROOTPATH.DS.'sess.txt', "\n".'ctrl'."\n".var_export(self::$messages, 1)."\n", FILE_APPEND);
/*
        if(preg_match('/list_start=([0-9]+)/', $_SERVER['HTTP_REFERER'], $match)){
            self::$referrer_param['list_start'] = $match[1];
        }
        if(preg_match('/sort=([ascde]{3,4})/', $test, $match)){
            self::$referrer_param['sort'] = $match[1];
        }*/
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

    public function __call($name, $value){
        $this->not_page();
    }

    public function not_page(){
        $view = new \App\View\NotPage;
        $view->display();
    }

    protected function redirect($url){
        header('location:'.$url);
        //file_put_contents(ROOTPATH.DS.'sess.txt', "contr"."\n".var_export($_SESSION, 1)."\n", FILE_APPEND);
        die;
    }
}