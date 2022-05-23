<?php
namespace App\Controllers;

use \App\Models\TaskModel as Model;
use \App\View\Task\TaskList as TList;
use \App\View\Task\TaskEdit as Edit;
use \App\Main;

defined('ROOTPATH') or die('access denied');

class TaskController {
    public static $list_start;
    public static $sort = false;
    public static $messages = [];
    private $main;
    public function __construct()
    {
        $this->main = new Main;
    }

    public function getList(){

        self::$list_start = $this->main->get('list_start', 0);
        self::$sort = $this->main->get('sort', false);
        $model = new Model;
        $list = $model->getList(self::$list_start, self::$sort);
        $view = new TList;
        self::$messages[] = $this->main->getSess('message', null);
        $this->main->setSess('message', null);
        $view->tasklist($list);
    }

    public function auth(){
        $user = new \App\Controllers\UserController();
        return $user->auth();
    }

    public function edit(){

        $err = false;
        $data = [];

        if (!$data['task_id'] = $this->main->get('id', false)) {
            $err = true;
        }
        if (!$data['description'] = $this->main->get('description', false)) {
            $err = true;
        }

        $data['status'] = $this->main->get('status', 0);

        if (!$err) {
            $model = new Model;
            $model->edit($data);
            $this->main->setSess('message', 'success|Post edit successfully');
        }
        else $this->main->setSess('message', 'error|Edit error');
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

            if (!$data['user_id'] = $this->main->get('user_id', false)) {
                $err = true;
            }

            if (!$data['description'] = $this->main->get('description', false)) {
                $err = true;
            }

            $data['status'] = $this->main->get('status', 0);

            if (!$err) {
                $model = new Model;
                $model->addNew($data);
                $this->main->setSess('message', 'success|Post added successfully');
            }
            else $this->main->setSess('message', 'error|Add error');
        }
        else $this->main->setSess('message', 'error|Add error.Authorization is required to add');
        header('location:index.php');
    }
    public function viewedit(){
        if($id = $this->main->get('id', false)){
            $model = new Model;
            $task = $model->getOne($id);
            $view = new Edit;
            $view->task_edit($task);
        }
    }
}

?>