<?php
namespace App\Controllers;

use App\Objects;
use \App\Models\TaskModel as Model;
use \App\View\Task\TaskList as TList;
use \App\View\Task\TaskEdit as Edit;
use \App\Main;

defined('ROOTPATH') or die('access denied');

class TaskController extends Objects {
    public static $list_start;
    public static $sort = false;
    public static $curr_list_opt = 3;
    public static $messages = [];
    private $main;
    protected static $object;
    public function __construct()
    {
        $this->main = Main::instance();
        self::$curr_list_opt = intval($this->main->getCookie('curr_list_opt', 3));
    }

    public function getList(){

        self::$list_start = $this->main->getInt('list_start', 0);
        self::$sort = $this->main->get('sort', false);
        $model = Model::instance();
        $list = $model->getList(self::$list_start, self::$sort, self::$curr_list_opt);
        $view = new TList;
        self::$messages[] = $this->main->getSess('message', null);
        $this->main->setSess('message', null);
        $view->tasklist($list);
    }

    public function auth(){
        $user = \App\Controllers\UserController::instance();
        return $user->auth();
    }

    public function edit(){

        $err = false;
        $data = [];

        if (!$data['task_id'] = $this->main->getInt('id', false)) {
            $err = true;
        }
        if (!$data['description'] = $this->main->get('description', false)) {
            $err = true;
        }
        if($this->auth()){
            if(!$data['user_id'] = $this->main->getInt('user_id', false)){
                $err = true;
            }
        }

        $data['status'] = $this->main->getInt('status', 0);

        if (!$err) {
            $model = Model::instance();
            $model->edit($data);
            $this->main->setSess('message', 'success|Post edit successfully');
        }
        else $this->main->setSess('message', 'error|Edit error');
        header('location:index.php');
    }

    public function viewadd() {
        $view = new Edit;
        $view->task_add();
    }

    public function addNew(){
        if($this->auth()) {
            $err = false;
            $data = [];

            if (!$data['user_id'] = $this->main->getInt('user_id', false)) {
                $err = true;
            }

            if (!$data['description'] = $this->main->get('description', false)) {
                $err = true;
            }

            $data['status'] = $this->main->getInt('status', 0);

            if (!$err) {
                $model = Model::instance();
                $model->addNew($data);
                $this->main->setSess('message', 'success|Post added successfully');
            }
            else $this->main->setSess('message', 'error|Add error');
        }
        else $this->main->setSess('message', 'error|Add error.Authorization is required to add');
        header('location:index.php');
    }
    public function delete(){
        if($this->auth()) {
            if ($id = $this->main->getInt('id', false)) {
                $model = Model::instance();
                $model->delete($id);
                $this->main->setSess('message', 'success|Task #' . $id . ' has been deleted');
            }
        } else $this->main->setSess('message', 'error|Delete error.You do not have access');
        header('location:index.php');
    }

    public function viewedit(){
        if($id = $this->main->getInt('id', false)){
            $model = Model::instance();
            $task = $model->getOne($id);
            $view = new Edit;
            $view->task_edit($task);
        }
    }

    public static function instance(){
        self::$object = parent::_instance(__CLASS__);
        return self::$object;
    }
}

?>