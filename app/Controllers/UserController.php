<?php
namespace App\Controllers;

use Kernel\Controller;
use App\Models\UserModel as Model;
use App\View\User\User;
use App\View\User\Users;
use App\Classes\Validate;

defined('ROOTPATH') or die('access denied');

class UserController extends Controller{

    public function __construct()
    {
        parent::__construct();
    }

    public function login(){
        if($this->auth()){
            $this->main->setSess('message', 'success|Welcome!');
            header('location: index.php');
        }
        else {
            $this->main->setSess('message', 'error|Incorrect login or password');
            header('location: index.php?ctrl=user&task=view_auth');
        }
        die;
    }

    public function unlogin(){
        $this->main->setSess('password', null);
        $this->main->setSess('login', null);
        setcookie('login', '', time()-3600, '/');
        setcookie('password', '', time()-3600, '/');
        header('location: index.php?ctrl=user&task=view_auth');
        die;
    }

    public function allow($allow){
        return Model::instance()->getAllow($allow, $this->main->getSess('role', 0));
    }

    public function auth(){

        $auth = false;

        $login = $this->main->getCookie('login', false);
        $password = $this->main->getCookie('password', false);

        if(!$login || !$password){
            $login = $this->main->get('login', false);
            $password = $this->main->get('password', false);
            if($password) $password = md5($password);
        }

        if($login != "" && $password != "") {
            $_login = $this->main->getSess('login', false);
            $_password = $this->main->getSess('password', false);
            if($_login && $_password){
                if($_login == $login && $_password == $password){
                    $auth = true;
                }
            }

            if(!$auth){
                $usermodel = Model::instance();
                if($user = $usermodel->getAuth($login, $password)){
                    $this->saveData($user);
                    $auth = true;
                }
            }
        }
        if(!$auth) $this->main->setSess('role', 0);
        return $auth;
    }

    public function view_auth(){
        self::$messages[] = $this->main->getSess('message', null);
        $this->main->setSess('message', '');
        $view = new User;
        $view->userdata = Model::instance()->getUserData($this->main->getSess('user_id'));
        $view->auth($this->auth());
    }

    public function view_add(){
        self::$messages[] = $this->main->getSess('message', null);
        $this->main->setSess('message', null);
        $view = new User;
        if($id = $this->main->getInt('id', false)){
            $view->userdata = Model::instance()->getUserData($id);
            $user_id = $this->main->getSess('user_id', null);
            $view->userdata['is_self'] = false;
            if($view->userdata['user_id'] == $user_id) $view->userdata['is_self'] = true;
            $view->title = 'Edit user';
        }
        else {
            $view->userdata = $this->main->getSess('userdata', null);
            $this->main->setSess('userdata', null);
            $view->title = 'Add user';
        }
        $view->add();
    }

    public function view_list(){
        self::$messages[] = $this->main->getSess('message', null);
        $this->main->setSess('message', null);
        $view = new Users;
        $view->users_list = Model::instance()->getList(parent::$list_start, parent::$sort, parent::$curr_list_opt);
        $view->user_list();
    }

    public function view_edit(){
        $this->view_add();
    }

    public function delete(){
        if($this->allow('delete')) {
            $id = $this->main->getInt('id', false);
            Model::instance()->delete($id);
            $this->main->setSess('message', 'success|User deleted successfully');
        }
        else $this->main->setSess('message', 'error|Delete error.You do not have access');
        header('location:index.php?ctrl=user&task=view_list');
    }

    public function update(){
        if($this->allow('edit')){
            if($this->save($id)){
                $this->main->setSess('message', 'success|User edit successfully');
            }
            header('location:index.php?ctrl=user&task=view_edit&id='.$id);
        }
        else $this->main->setSess('message', 'error|Edit error.You do not have access');
    }

    private function saveData($data){
        $this->main->setSess('login', $data['login']);
        $this->main->setSess('password', $data['password']);
        $this->main->setSess('user_id', $data['user_id']);
        if(isset($data['role'])) $this->main->setSess('role', $data['role']);
        setcookie('login', $data['login'], time()+3600, '/');
        setcookie('password', $data['password'], time()+3600, '/');
    }

    public function self_update(){
        $user_id = $this->main->getSess('user_id', false);
        $id = $this->main->getInt('id', false);
        if($user_id && $id == $user_id){
            $data = $this->save($id);
            if(!empty($data)){
                $this->saveData($data);
                $this->main->setSess('message', 'success|You profile edit successfully');
            }
            header('location:index.php?ctrl=user&task=view_add&id='.$id);
        }
        else $this->main->setSess('message', 'error|Edit error.You do not have access');
    }

    public function add(){
        if($this->allow('create')){
            if($this->save()){
                $this->main->setSess('message', 'success|User added successfully');
            }
        }
        header('location:index.php?ctrl=user&task=view_add');
    }

    private function save(&$id = null){
        $err = [];
        $data = [];
        $model = Model::instance();

        $data['manager'] = $this->main->get('manager', false);

        if(!$id) {
            $id = $this->main->getInt('id', false);
        }

        $data['user_id'] = $id;

        $task = $this->main->get('task', 'add');

        if ($data['manager']) {
            if (!$data['login'] = $this->main->get('login', false)) {
                $err[2] = 'Login is missing';
            }
            else {
                if($model->getDubleLogin($data['login'], $data['user_id'])) {
                    $err[6] = 'Login already exists';
                }
            }
            if (!$data['password'] = $this->main->get('password', false)) {
                $err[3] = 'Password is missing';
            }
        }
        if (!$data['name'] = $this->main->get('name', false)) {
            $err[4] = 'Name is missing';
        }
        if (!$data['email'] = $this->main->get('email', false)) {
            $err[1] = 'Email is missing';
        }
        if($model->getDubleEmail($data['email'], $data['user_id'])){
            $err[5] = 'Email already exists';
        }

        Validate::instance()->validateData($data, $err);

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