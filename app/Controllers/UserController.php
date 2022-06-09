<?php
namespace App\Controllers;

use Kernel\Controller;
use Kernel\Router;
use App\Models\UserModel as Model;
use App\View\User\User;
use App\View\User\Users;
use App\Classes\Validate;


class UserController extends Controller{

    private $router;
    public function __construct()
    {
        parent::__construct();
        $this->router = Router::instance();
    }

    public function login(){
        if($this->auth()){
            $this->main->setSess('message', 'success|Welcome!');
            $this->redirect($this->router->getLink('index.php'));
        }
        else {
            $this->main->setSess('message', 'error|Incorrect login or password');
            $this->redirect($this->router->getLink('index.php?ctrl=user&task=view_auth'));
        }
        die;
    }

    public function unlogin(){
        $this->main->setSess('auth', null);
        session_destroy();
        $this->redirect($this->router->getLink('index.php?ctrl=user&task=view_auth'));
        die;
    }

    public function allow($allow){
        return Model::instance()->getAllow($allow, $this->main->getSess('role', 0));
    }

    public function auth(){

        if(!$auth = $this->main->getSess('auth', false)) {

            $login = $this->main->get('login', false);
            $password = $this->main->get('password', false);

            if ($login != "" && $password != "") {
                if ($user = Model::instance()->getAuth($login, $password)) {
                    $this->saveData($user);
                    $auth = true;
                }
            }
        }

        return $auth;
    }

    public function view_auth(){
        $view = new User;
        $view->userdata = Model::instance()->getUserData($this->main->getSess('user_id'));
        $view->auth($this->auth());
    }

    public function view_show(){
        if($id = $this->main->getInt('id', false)){
            $view = new User;
            $view->userdata = Model::instance()->getUserData($id);
            $view->show();
        }
    }

    public function view_add(){
        $view = new User;
        if($id = $this->main->getInt('id', false)){
            $view->userdata = Model::instance()->getUserData($id);
            $user_id = $this->main->getSess('user_id', null);
            $view->userdata['access'] = true;
            if($view->userdata['role'] == '2' && $user_id != $id){
                $view->userdata['access'] = false;
            }
            $view->userdata['is_self'] = false;
            if($view->userdata['user_id'] == $user_id) $view->userdata['is_self'] = true;
            $view->edit();
        }
        else {
            $view->userdata = $this->main->getSess('userdata', null);
            $this->main->setSess('userdata', null);
            $view->add();
        }
    }

    public function view_list(){
        $view = new Users;
        $view->list = Model::instance()->getList(parent::$list_start, parent::$sort, parent::$curr_list_opt);
        $view->user_list();
    }

    public function view_edit(){
        $this->view_add();
    }

    public function delete(){
        if($this->allow('delete')) {
            $id = $this->main->getInt('id', false);
            $userdata = Model::instance()->getUserData($id);
            if($userdata['role'] != '2' || $id == $this->main->getSess('user_id', null)){
                Model::instance()->delete($id);
                $this->main->setSess('message', 'success|User deleted successfully');
                $this->redirect($this->router->getLink('index.php?ctrl=user&task=view_list'));
                die;
            }
        }
        $this->main->setSess('message', 'error|Delete error.You do not have access');
        $this->redirect($this->router->getLink('index.php?ctrl=user&task=view_list'));
    }

    public function edit(){
        if($this->allow('edit')){
            if($this->save($id)){
                $this->main->setSess('message', 'success|User edit successfully');
            }
            $this->redirect($this->router->getLink('index.php?ctrl=user&task=view_edit&id='.$id));
        }
        else $this->main->setSess('message', 'error|Edit error.You do not have access');
    }

    private function saveData($data){
        $this->main->setSess('user_id', $data['user_id']);
        $this->main->setSess('auth', '1');
        if(isset($data['role'])) $this->main->setSess('role', $data['role']);
    }

    public function self_edit(){
        $user_id = $this->main->getSess('user_id', false);
        $id = $this->main->getInt('id', false);
        if($user_id && $id == $user_id){
            $data = $this->save($id);
            if(!empty($data)){
                $this->saveData($data);
                $this->main->setSess('message', 'success|You profile edit successfully');
            }
        }
        else $this->main->setSess('message', 'error|Edit error.You do not have access');
        $this->redirect($this->router->getLink('index.php?ctrl=user&task=view_add'));
    }

    public function add(){
        if($this->allow('create')){
            if($this->save()){
                $this->main->setSess('message', 'success|User added successfully');
            }
        }
        $this->redirect($this->router->getLink('index.php?ctrl=user&task=view_add'));
    }

    private function save(&$id = null){
        $err = [];
        $data = [];
        $validate = [];
        $model = Model::instance();

        $data['manager'] = $this->main->get('manager', false);

        if(!$id) {
            $id = $this->main->getInt('id', false);
        }

        $data['user_id'] = $id;

        if($data['user_id']) {
            $userdata = Model::instance()->getUserData($id);
            if($userdata['role'] == '2' && $data['user_id'] != $this->main->getSess('user_id')){
                $this->main->setSess('message', 'error|You do not have access');
                return false;
            }
        }

        if ($data['manager']) {

            if (!$data['login'] = $this->main->get('login', false)) {
                $err[2] = 'Login is missing';
            }
            else {
                if($model->getDubleLogin($data['login'], $data['user_id'])) {
                    $err[6] = 'Login already exists';
                }
                else $validate['login'] = $data['login'];
            }

            if (!$data['password'] = $this->main->get('password', false)) {
                $err[3] = 'Password is missing';
            }
            else $validate['password'] = $data['password'];
        }
        else $data['role'] = '0';

        if (!$data['name'] = $this->main->get('name', false)) {
            $err[4] = 'Name is missing';
        }
        else $validate['name'] = $data['name'];

        if (!$data['email'] = $this->main->get('email', false)) {
            $err[1] = 'Email is missing';
        }
        elseif($model->getDubleEmail($data['email'], $data['user_id'])) {
            $err[5] = 'Email already exists';
        }
        else $validate['email'] = $data['email'];

        Validate::instance()->validateData($validate, $err);

        $this->main->setSess('userdata', $data);

        if (empty($err)) {

            if(isset($data['password'])) $data['password'] = md5($data['password']);

            if ($model->save($data)) {
                return $data;
            }
            else $this->main->setSess('message', 'error|Error adding user');
        } else {
            $this->buildErrorMessage($err, 'Errors:<br>');
            return false;
        }
    }

    public static function instance($class = __CLASS__){
        return parent::instance($class);
    }
}
    ?>