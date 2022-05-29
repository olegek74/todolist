<?php

namespace App\View\Task;

use App\Controllers\TaskController;
use App\Models\UserModel;
use Kernel\View;

defined('ROOTPATH') or die('access denied');

class Task extends View{

    public $task_data;

    private function getUserList(){
        return UserModel::instance()->getList();
    }

    public function add(){
        $allow_create = TaskController::instance()->allow('create');
        $this->header();
        if($allow_create){
            $userlist = $userlist = $this->getUserList();
            require_once ROOTPATH.DS.'html'.DS.'task'. DS .'add.php';
        }
        else require_once ROOTPATH.DS.'html'.DS.'utils'. DS .'deny.php';
        $this->footer();
    }
    public function edit(){
        $userlist = false;
        $allow_create = TaskController::instance()->allow('create');
        if($allow_create) $userlist = $this->getUserList(); // не все пользоватли могут пере
        $this->header();
        require_once ROOTPATH . DS . 'html' . DS . 'task'. DS .'edit.php';
        $this->footer();
    }
    public function __get($name){
        if(!empty($this->task_data) && isset($this->task_data[$name])) return $this->task_data[$name];
        return '';
    }
}
?>