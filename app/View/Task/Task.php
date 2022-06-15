<?php

namespace App\View\Task;

use App\Controllers\TaskController;
use App\Models\UserModel;
use App\Models\CategoryModel;
use Kernel\View;


class Task extends View{

    public $data;

    private function getCategoryList(){
        return CategoryModel::instance()->getAll();
    }

    private function getUserList(){
        return UserModel::instance()->getAll();
    }

    private function getCategory($id){
        return CategoryModel::instance()->getOne($id, 'categories');
    }

    private function getAuthorData(){
        $user_data = UserModel::instance()->getUserData($this->user_id);
        $this->data['name'] = $user_data['name'];
        $this->data['email'] = $user_data['email'];
    }

    public function add(){
        $this->page_title = 'Add Task';
        if(TaskController::instance()->allow('create')){
            $this->content('task', 'add', [
                'cat_list' => $this->getCategoryList(),
                'userlist' => $this->getUserList()
            ]);
        }
        else $this->content('utils', 'deny');
    }

    public function edit(){

        $tpl_data = [];
        $this->page_title = 'Edit Task';
        $tpl_data['userlist'] = false;
        if($this->data['category_id']) {
            $category = $this->getCategory($this->data['category_id']);
            $this->data['category'] = $category['name'];
        }

        if(TaskController::instance()->allow('create')) $tpl_data['userlist'] = $this->getUserList();

        $tpl_data['cat_list'] = $this->getCategoryList();
        $this->getAuthorData();
        $this->content('task', 'edit', $tpl_data);
    }

    public function show(){
        $this->page_title = 'Show Task';
        $this->getAuthorData();
        $this->content('task', 'show');
    }

    public function __get($name){
        if(!empty($this->data) && isset($this->data[$name])) return $this->data[$name];
        return '';
    }
}
?>