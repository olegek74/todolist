<?php
namespace App\View\User;

use App\Controllers\UserController;
use Kernel\View;

defined('ROOTPATH') or die('access denied');

class User extends View {

    public $userdata = [];

    public function auth($isauth){

        if($isauth){
            $this->page_title = 'You profile';
            $this->header();
            $this->tmpl('user', 'unlogin');
        }
        else {
            $this->page_title = 'Login';
            $this->header();
            $this->tmpl('user', 'login', ['messages' => UserController::$messages]);
        }
        $this->footer();
    }

    public function edit(){
        $this->title = $this->page_title = 'Edit profile';
        if($this->userdata['is_self']) {
            $this->title = $this->page_title = 'Edit you profile';
        }
        $this->header();
        if($this->userdata['access'] && ($this->userdata['is_self'] || UserController::instance()->allow('edit'))){
            $this->tmpl('user', 'form', ['messages' => UserController::$messages]);
        }
        else $this->tmpl('utils', 'deny');
        $this->footer();
    }

    public function add(){
        $this->title = $this->page_title = 'Add user';
        $this->header();
        if(UserController::instance()->allow('create')) $this->tmpl('user', 'form', ['messages' => UserController::$messages]);
        else $this->tmpl('utils', 'deny');
        $this->footer();
    }

    public function __get($name){
        if(isset($this->userdata[$name])) return $this->userdata[$name];
        return '';
    }
}
?>