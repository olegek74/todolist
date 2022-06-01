<?php
namespace App\View\User;

use App\Controllers\UserController;
use Kernel\View;

defined('ROOTPATH') or die('access denied');

class User extends View {

    public $userdata = [];

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

    public function edit(){
        $messages = UserController::$messages;
        $this->title = $this->page_title = 'Edit profile';
        if($this->userdata['is_self']) {
            $this->title = $this->page_title = 'Edit you profile';
        }
        $this->header();
        if($this->userdata['access'] && ($this->userdata['is_self'] || UserController::instance()->allow('edit'))){
            require_once ROOTPATH . DS . 'html' . DS . 'user'.DS.'form.php';
        }
        else require_once ROOTPATH.DS.'html'.DS.'utils'. DS .'deny.php';
        $this->footer();
    }

    public function add(){
        $messages = UserController::$messages;
        $this->title = $this->page_title = 'Add user';
        $this->header();
        if(UserController::instance()->allow('create')) require_once ROOTPATH . DS . 'html' . DS . 'user'.DS.'form.php';
        else require_once ROOTPATH.DS.'html'.DS.'utils'. DS .'deny.php';
        $this->footer();
    }

    public function __get($name){
        if(isset($this->userdata[$name])) return $this->userdata[$name];
        return '';
    }
}
?>