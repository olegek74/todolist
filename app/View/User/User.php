<?php
namespace App\View\User;

use App\Controllers\UserController;
use Kernel\View;

defined('ROOTPATH') or die('access denied');

class User extends View {

    public $userdata = [];
    public $title;

    public function auth($isauth){
        $this->page_title = 'Login';
        $this->header();
        $messages = UserController::$messages;
        if($isauth){
            require_once ROOTPATH . DS . 'html' . DS . 'user'.DS.'unlogin.php';
        }
        else {
            require_once ROOTPATH . DS . 'html' . DS . 'user'.DS.'login.php';
        }
        $this->footer();
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
        $this->page_title = 'Add User';
        $this->header();
        if($allow_add) require_once ROOTPATH . DS . 'html' . DS . 'user'.DS.'add.php';
        else require_once ROOTPATH.DS.'html'.DS.'utils'. DS .'deny.php';
        $this->footer();
    }
    public function __get($name){
        if(isset($this->userdata[$name])) return $this->userdata[$name];
        return '';
    }
}
?>