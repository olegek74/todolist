<?php
namespace App\View\User;

use App\Controllers\UserController;
use Kernel\View;


class User extends View {

    public $userdata = [];

    public function auth($isauth){

        if($isauth){
            $this->page_title = 'You profile';
            $this->content('user', 'unlogin');
        }
        else {
            $this->page_title = 'Login';
            $this->content('user', 'login');
        }
    }

    public function edit(){
        $this->title = $this->page_title = 'Edit profile';
        if($this->userdata['is_self']) {
            $this->title = $this->page_title = 'Edit you profile';
        }

        if($this->userdata['access'] && ($this->userdata['is_self'] || UserController::instance()->allow('edit'))){
            $this->content('user', 'form');
        }
        else $this->content('utils', 'deny');
    }

    public function add(){
        $this->title = $this->page_title = 'Add user';
        if(UserController::instance()->allow('create')) $this->content('user', 'form');
        else $this->content('utils', 'deny');
    }

    public function show(){
        $this->page_title = 'Show User';
        parent::$meta['description'] = 'This is a user show page';
        $this->content('user', 'show');
    }

    public function __get($name){
        if(isset($this->userdata[$name])) return $this->userdata[$name];
        return '';
    }
}
?>