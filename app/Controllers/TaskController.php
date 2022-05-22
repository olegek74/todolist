<?php
namespace App\Controllers;

use \App\Models\TaskModel as Model;

use \App\View\Task\TaskList as TList;

use \App\View\Task\TaskEdit as Edit;

defined('ROOTPATH') or die('access denied');

class TaskController {
    public static $list_start;
    public static $sort = false;
    public static $messages = [];
    public function getList(){
        $model = new Model;
        $list_start = 0;
        if(isset($_GET['list_start'])){
            $list_start = intval($_GET['list_start']);
        }
        self::$list_start = $list_start;
        $sort = false;
        if(isset($_GET['sort'])){
            $sort = $_GET['sort'];
        }
        self::$sort = $sort;
        $list = $model->getList($list_start, $sort);
        $view = new TList;
        if(isset($_SESSION['message'])){
            self::$messages[] = $_SESSION['message'];
            $_SESSION['message'] = '';
        }
        $view->tasklist($list);
    }

    public function auth(){
        $user = new \App\Controllers\UserController();
        return $user->auth();
    }

    public function edit(){

        $err = false;
        $data = [];
        if (!$data['task_id'] = $_GET['id']) {
            $err = true;
        }
        if (!$data['description'] = $_GET['description']) {
            $err = true;
        }
        if (!$data['status'] = $_GET['status']) {
            $status = 0;
        }
        if (!$err) {
            $model = new Model;
            $model->edit($data);
            $_SESSION['message'] = 'success|Post edit successfully';
        }
        else $_SESSION['message'] = 'error|Edit error';
        header('location:index.php');
    }

    public function viewadd() {
        $user = new \App\Models\UserModel;
        $view = new Edit;
        $view->task_add($user->getList());
    }

    public function addNew(){
        if($this->auth()) {
            $err = false;
            $data = [];
            if (!$data['user_id'] = $_GET['user_id']) {
                $err = true;
            }
            if (!$data['description'] = $_GET['description']) {
                $err = true;
            }
            if (!$data['status'] = $_GET['status']) {
                $data['status'] = 0;
            }

            if (!$err) {
                $model = new Model;
                $model->addNew($data);
                $_SESSION['message'] = 'success|Post added successfully';
            }
            else $_SESSION['message'] = 'error|Add error';
        }
        else $_SESSION['message'] = 'error|Add error.Authorization is required to add';
        header('location:index.php');
    }
    public function viewedit(){
        if($id = $_GET['id']){
            $model = new Model;
            $task = $model->getOne($id);
            $view = new Edit;
            $view->task_edit($task);
        }
    }
}

?>