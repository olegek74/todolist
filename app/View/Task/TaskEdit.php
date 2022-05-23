<?php

namespace App\View\Task;

use App\Controllers\UserController as User;

defined('ROOTPATH') or die('access denied');

class taskEdit {

    private $allow_add;
    private function allowAdd(){
        if(is_null($this->allow_add)){
            $user = User::instance();
            $this->allow_add = $user->auth();
        }
        return $this->allow_add;
    }

    public function task_add(){
        $allowass = $this->allowAdd();
        $menu = \App\Controllers\MenuController::instance();
        require_once ROOTPATH . DS . 'html' . DS . 'global'. DS .'head.php';
        if($allowass){
            $userlist = \App\Models\UserModel::instance()->getList();
            require_once ROOTPATH.DS.'html'.DS.'task'. DS .'task_add.php';
        }
        else require_once ROOTPATH.DS.'html'.DS.'task'. DS .'task_deny.php';
        require_once ROOTPATH . DS . 'html' . DS . 'global'. DS .'foot.php';
    }
    public function task_edit($data){
        $userlist = false;
        if($this->allowAdd()) {
            $userlist = \App\Models\UserModel::instance()->getList();
        }
        $menu = \App\Controllers\MenuController::instance();
        require_once ROOTPATH . DS . 'html' . DS . 'global'. DS .'head.php';
        require_once ROOTPATH . DS . 'html' . DS . 'task'. DS .'task_edit.php';
        require_once ROOTPATH . DS . 'html' . DS . 'global'. DS .'foot.php';
    }
}
?>