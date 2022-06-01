<?php
namespace App\View\User;

use App\Controllers\UserController;
use Kernel\View;

defined('ROOTPATH') or die('access denied');

class User extends View {

    public $userdata = [];
    public $title;

    public function auth($isauth){

        $messages = UserController::$messages;
        if($isauth){
            $this->page_title = 'You profile';
            $this->header();
            require_once ROOTPATH . DS . 'html' . DS . 'user'.DS.'unlogin.php';
        }
        else {
            $this->page_title = 'Login';
            $this->header();
            require_once ROOTPATH . DS . 'html' . DS . 'user'.DS.'login.php';
        }
        $this->footer();
    }
    public function add(){
        $messages = UserController::$messages;
        $allow_add = UserController::instance()->allow('create');
        $allow_edit = UserController::instance()->allow('edit');
        $this->page_title = 'Add User';
        $this->header();
        if((isset($this->userdata['is_self']) && $this->userdata['is_self']) || $allow_add || $allow_edit) require_once ROOTPATH . DS . 'html' . DS . 'user'.DS.'add.php';
        else require_once ROOTPATH.DS.'html'.DS.'utils'. DS .'deny.php';
        $this->footer();
    }
    public function __get($name){
        if(isset($this->userdata[$name])) return $this->userdata[$name];
        return '';
    }
}
?>