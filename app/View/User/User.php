<?php
namespace App\View\User;

use App\Controllers\UserController;
use App\Controllers\MenuController;

defined('ROOTPATH') or die('access denied');

class User {

    public $userdata = [];
    public $title;

    public function auth($isauth){
        $menu = MenuController::instance();
        require_once ROOTPATH . DS . 'html' . DS . 'global'. DS .'head.php';
        $messages = UserController::$messages;
        if($isauth){
            require_once ROOTPATH . DS . 'html' . DS . 'user'.DS.'unlogin.php';
        }
        else {
            require_once ROOTPATH . DS . 'html' . DS . 'user'.DS.'login.php';
        }
        require_once ROOTPATH . DS . 'html' . DS . 'global'. DS .'foot.php';
    }
    private function allowAdd(){
        if(UserController::instance()->allow('create')){
            return true;
        }
        return false;
    }
    public function add(){
        $messages = UserController::$messages;
        $allow_add = UserController::instance()->allow('create');
        $menu = MenuController::instance();
        require_once ROOTPATH . DS . 'html' . DS . 'global'. DS .'head.php';
        if($allow_add) require_once ROOTPATH . DS . 'html' . DS . 'user'.DS.'add.php';
        else require_once ROOTPATH.DS.'html'.DS.'utils'. DS .'deny.php';
        require_once ROOTPATH . DS . 'html' . DS . 'global'. DS .'foot.php';
    }
    public function __get($name){
        if(isset($this->userdata[$name])) return $this->userdata[$name];
        return '';
    }
}
?>