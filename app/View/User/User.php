<?php
namespace App\View\User;

use App\Controllers\UserController;

defined('ROOTPATH') or die('access denied');

class User {

    public $userdata = [];

    public function viewAuth($isauth){
        $menu = \App\Controllers\MenuController::instance();
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
        if(UserController::instance()->auth()){
            return true;
        }
        return false;
    }
    public function viewAdd(){
        $messages = UserController::$messages;
        $allow_add = $this->allowAdd();
        $menu = \App\Controllers\MenuController::instance();
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