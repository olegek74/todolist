<?php

namespace App\View\Task;

use App\Controllers\TaskController;
use App\Models\UserModel;
use App\Models\CategoryModel;
use Kernel\View;


class Task extends View{

    public $task_data;

    private function getCategoryList(){
        return CategoryModel::instance()->getList(0, false, 20);
    }

    private function getUserList(){
        return UserModel::instance()->getList(0, false, 20);
    }

    private function getCategory($id){
        return CategoryModel::instance()->getOne($id, 'categories');
    }

    private function getAuthorData(){
        $user_data = UserModel::instance()->getUserData($this->user_id);
        $this->task_data['name'] = $user_data['name'];
        $this->task_data['email'] = $user_data['email'];
    }

    public function add(){
        $this->page_title = 'Add Task';
        if(TaskController::instance()->allow('create')){
            $this->tmpl('task', 'add', [
                'cat_list' => $this->getCategoryList(),
                'userlist' => $this->getUserList(),
                'messages' => $this->messages()
            ]);
        }
        else $this->tmpl('utils', 'deny');
    }

    public function edit(){

        $tpl_data = [];
        $this->page_title = 'Edit Task';
        $tpl_data['userlist'] = false;
        $tpl_data['messages'] = $this->messages();
        if($this->task_data['category_id']) {
            $category = $this->getCategory($this->task_data['category_id']);
            $this->task_data['category'] = $category['name'];
        }

        if(TaskController::instance()->allow('create')) $tpl_data['userlist'] = $this->getUserList();

        $tpl_data['cat_list'] = $this->getCategoryList();
        $this->getAuthorData();
        $this->tmpl('task', 'edit', $tpl_data);
    }

    public function show(){
        $this->page_title = 'Show Task';
        $this->getAuthorData();
        $this->tmpl('task', 'show', ['messages' => $this->messages()]);
    }

    public function __get($name){
        if(!empty($this->task_data) && isset($this->task_data[$name])) return $this->task_data[$name];
        return '';
    }
}
?>