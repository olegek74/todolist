<?php
namespace App\View\User;

use App\Controllers\UserController;
use Kernel\View;


class User extends View {

    public $userdata = [];

    public function auth($isauth){

        if($isauth){
            $this->page_title = 'You profile';
            $this->tmpl('user', 'unlogin');
        }
        else {
            $this->page_title = 'Login';
            $this->tmpl('user', 'login', ['messages' => $this->messages()]);
        }
    }

    public function edit(){
        $this->title = $this->page_title = 'Edit profile';
        if($this->userdata['is_self']) {
            $this->title = $this->page_title = 'Edit you profile';
        }

        if($this->userdata['access'] && ($this->userdata['is_self'] || UserController::instance()->allow('edit'))){
            $this->tmpl('user', 'form', ['messages' => $this->messages()]);
        }
        else $this->tmpl('utils', 'deny');
    }

    public function add(){
        $this->title = $this->page_title = 'Add user';
        if(UserController::instance()->allow('create')) $this->tmpl('user', 'form', ['messages' => $this->messages()]);
        else $this->tmpl('utils', 'deny');
    }

    public function __get($name){
        if(isset($this->userdata[$name])) return $this->userdata[$name];
        return '';
    }
}
?>