<?php

namespace App\View\Task;

use App\Controllers\TaskController;
use App\Controllers\MenuController;
use App\Models\UserModel;

defined('ROOTPATH') or die('access denied');

class Task {

    public $task_data;

    private function getUserList(){
        UserModel::instance()->getList();
    }

    public function add(){
        $allow_create = TaskController::instance()->allow('create');
        $menu = MenuController::instance();
        require_once ROOTPATH . DS . 'html' . DS . 'global'. DS .'head.php';
        if($allow_create){
            $userlist = $userlist = $this->getUserList();
            require_once ROOTPATH.DS.'html'.DS.'task'. DS .'add.php';
        }
        else require_once ROOTPATH.DS.'html'.DS.'utils'. DS .'deny.php';
        require_once ROOTPATH . DS . 'html' . DS . 'global'. DS .'foot.php';
    }
    public function edit(){
        $userlist = false;
        $allow_create = TaskController::instance()->allow('create');
        if($allow_create) $userlist = $this->getUserList(); // не все пользоватли могут пере
        $menu = MenuController::instance();
        require_once ROOTPATH . DS . 'html' . DS . 'global'. DS .'head.php';
        require_once ROOTPATH . DS . 'html' . DS . 'task'. DS .'edit.php';
        require_once ROOTPATH . DS . 'html' . DS . 'global'. DS .'foot.php';
    }
    public function __get($name){
        if(!empty($this->task_data) && isset($this->task_data[$name])) return $this->task_data[$name];
        return '';
    }
}
?>