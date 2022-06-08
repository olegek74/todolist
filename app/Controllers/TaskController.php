<?php
namespace App\Controllers;

use Kernel\Controller;
use Kernel\Router;
use \App\Models\TaskModel as Model;
use \App\View\Task\Tasks;
use \App\View\Task\Task;


class TaskController extends Controller{

    private $router;

    public function __construct(){
        parent::__construct();
        $this->router = Router::instance();
    }

    public function view_list(){
        $view = new Tasks;
        $view->list = Model::instance()->getList(parent::$list_start, parent::$sort, parent::$curr_list_opt);
        $view->task_list();
    }

    public function view_show(){
        if($id = $this->main->getInt('id', false)){
            $view = new Task;
            $view->data = Model::instance()->getOne($id);
            $view->show();
        }
    }

    public function edit(){
        if($this->allow('edit')) {
            $err = []; //false;
            $data = [];

            if (!$data['task_id'] = $this->main->getInt('id', false)) {
                $err[] = 'task_id error';
            }
            if (!$data['description'] = $this->main->get('description', false)) {
                $err[] = 'Description is empty';
            }
            if ($this->allow('create')) {
                $data['user_id'] = $this->main->getInt('user_id', false);
            }

            $data['status'] = $this->main->getInt('status', 0);
            $data['cat_id'] = $this->main->getInt('cat_id', null);

            if (empty($err)) {
                $model = Model::instance();
                $model->edit($data);
                $this->main->setSess('message', 'success|Post edit successfully');
            } else {
                $this->buildErrorMessage($err, 'Errors:<br>');
            }
        }
        else $this->main->setSess('message', 'error|Edit error.Access denied');
        $this->redirect($this->router->getLink('index.php'));
    }

    public function view_add() {
        $view = new Task;
        $view->add();
    }

    public function add(){
        if($this->allow('create')) {
            $err = [];
            $data = [];

            if (!$data['user_id'] = $this->main->getInt('user_id', false)) {
                $err[] = 'Unknown user';
            }

            if (!$data['description'] = $this->main->get('description', false)) {
                $err[] = 'Description is empty';
            }

            $data['create_date'] = time();

            $data['status'] = $this->main->getInt('status', 0);
            $data['cat_id'] = $this->main->getInt('cat_id', null);

            if (empty($err)) {
                $model = Model::instance();
                $model->create($data);
                $this->main->setSess('message', 'success|Post added successfully');
            }
            else {
                $this->buildErrorMessage($err, 'Errors:<br>');
            }
        }
        else $this->main->setSess('message', 'error|Add error.Authorization is required to add');
        $this->redirect($this->router->getLink('index.php'));
    }

    public function allow($action){
        return Model::instance()->getAllow($action, $this->main->getSess('role', 0));
    }

    public function delete(){
        if($this->allow('delete')) {
            if ($id = $this->main->getInt('id', false)) {
                $model = Model::instance();
                $model->delete($id);
                $this->main->setSess('message', 'success|Task #' . $id . ' has been deleted');
            }
        }
        else $this->main->setSess('message', 'error|Delete error.You do not have access');
        $this->redirect($this->router->getLink('index.php'));
    }

    public function view_edit(){
        if($id = $this->main->getInt('id', false)){
            $view = new Task;
            $view->data = Model::instance()->getOne($id);
            $view->edit();
        }
    }

    public static function instance($class = __CLASS__){
        return parent::instance($class);
    }
}

?>