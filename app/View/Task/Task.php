<?php

namespace App\View\Task;

use App\Controllers\UserController as User;
use App\Controllers\MenuController;
use App\Models\UserModel;

defined('ROOTPATH') or die('access denied');

class Task {

    private $allow_add;
    public $task_data;
    private function allowAdd(){
        if(is_null($this->allow_add)){
            $user = User::instance();
            $this->allow_add = $user->auth();
        }
        return $this->allow_add;
    }

    public function task_add(){
        $allowass = $this->allowAdd();
        $menu = MenuController::instance();
        require_once ROOTPATH . DS . 'html' . DS . 'global'. DS .'head.php';
        if($allowass){
            $userlist = UserModel::instance()->getList();
            require_once ROOTPATH.DS.'html'.DS.'task'. DS .'task_add.php';
        }
        else require_once ROOTPATH.DS.'html'.DS.'utils'. DS .'deny.php';
        require_once ROOTPATH . DS . 'html' . DS . 'global'. DS .'foot.php';
    }
    public function task_edit(){
        $userlist = false;
        if($this->allowAdd()) {
            $userlist = UserModel::instance()->getList();
        }
        $menu = MenuController::instance();
        require_once ROOTPATH . DS . 'html' . DS . 'global'. DS .'head.php';
        require_once ROOTPATH . DS . 'html' . DS . 'task'. DS .'task_edit.php';
        require_once ROOTPATH . DS . 'html' . DS . 'global'. DS .'foot.php';
    }
    public function __get($name){
        if(!empty($this->task_data) && isset($this->task_data[$name])) return $this->task_data[$name];
        return '';
    }
}
?>