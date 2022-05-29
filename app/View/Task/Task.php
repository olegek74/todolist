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

    private function getAuthorData(){
        $user_data = UserModel::instance()->getUserData($this->user_id);
        $this->task_data['name'] = $user_data['name'];
        $this->task_data['email'] = $user_data['email'];
    }

    public function add(){
        $allow_create = TaskController::instance()->allow('create');
        $this->page_title = 'Add Task';
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
        $this->page_title = 'Edit Task';
        $allow_create = TaskController::instance()->allow('create');
        if($allow_create) $userlist = $this->getUserList(); // не все пользоватли могут пере
        $this->getAuthorData();
        $this->header();
        require_once ROOTPATH . DS . 'html' . DS . 'task'. DS .'edit.php';
        $this->footer();
    }

    public function show(){
        $this->page_title = 'Show Task';
        $this->getAuthorData();
        $this->header();
        require_once ROOTPATH . DS . 'html' . DS . 'task'. DS .'show.php';
        $this->footer();
    }

    public function __get($name){
        if(!empty($this->task_data) && isset($this->task_data[$name])) return $this->task_data[$name];
        return '';
    }
}
?>