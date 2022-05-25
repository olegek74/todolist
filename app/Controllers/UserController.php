<?php
namespace App\Controllers;

use App\Controller;
use App\Models\UserModel as Model;
use App\View\User\User;
use App\View\User\Users;

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
            header('location: index.php?ctrl=user&task=viewauth');
        }
        die;
    }

    public function unlogin(){
        $this->main->setSess('password', null);
        $this->main->setSess('login', null);
        setcookie('login', '', time()-3600, '/');
        setcookie('password', '', time()-3600, '/');
        header('location: index.php?ctrl=user&task=viewauth');
        die;
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
                    $this->main->setSess('password', md5($password));
                    $this->main->setSess('login', $login);
                    $this->main->setSess('status', $user['status']);
                    setcookie('login', $login, time()+3600, '/');
                    setcookie('password', $password, time()+3600, '/');
                    $auth = true;
                }
            }
        }
        return $auth;
    }

    public function viewauth(){
        self::$messages[] = $this->main->getSess('message', null);
        $this->main->setSess('message', '');
        $view = new User;
        $view->viewAuth($this->auth());
    }

    public function viewadd(){
        self::$messages[] = $this->main->getSess('message', null);
        $this->main->setSess('message', null);
        $view = new User;
        if($id = $this->main->getInt('id', false)){
            $view->userdata = Model::instance()->getUserData($id);
            $view->title = 'Edit user';
        }
        else {
            $view->userdata = $this->main->getSess('userdata', null);
            $this->main->setSess('userdata', null);
            $view->title = 'Add user';
        }
        $view->viewAdd();
    }

    public function viewlist(){
        self::$messages[] = $this->main->getSess('message', null);
        $this->main->setSess('message', null);
        self::$list_start = $this->main->getInt('list_start', 0);
        self::$sort = $this->main->get('sort', false);
        $view = new Users;
        $view->users_list = Model::instance()->getList(self::$list_start, self::$sort, self::$curr_list_opt);
        $view->viewList();
    }

    public function viewedit(){
        $this->viewadd();
    }

    public function delete(){
        if($this->auth()) {
            $id = $this->main->getInt('id', false);
            Model::instance()->delete($id);
            $this->main->setSess('message', 'success|User deleted successfully');
        }
        else $this->main->setSess('message', 'error|Delete error.You do not have access');
        header('location:index.php?ctrl=user&task=viewlist');
    }

    public function update(){
        $this->add();
    }
    public function add(){

        if($this->auth()) {
            $err = [];
            $data = [];
            $model = Model::instance();

            $data['manager'] = $this->main->get('manager', false);
            $data['id'] = $this->main->getInt('id', false);
            $task = $this->main->get('task', 'add');

            if ($data['manager']) {
                if (!$data['login'] = $this->main->get('login', false)) {
                    $err[2] = 'Login is missing';
                }
                else {
                    if($model->getDubleLogin($data['login'], $data['id'])) {
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
            if($model->getDubleEmail($data['email'], $data['id'])){
                $err[5] = 'Email already exists';
            }
            $this->main->setSess('userdata', $data);

            if (empty($err)) {
                if ($model->save($data)) {
                    if($task == 'update') $this->main->setSess('message', 'success|User edit successfully');
                    else $this->main->setSess('message', 'success|User added successfully');
                }
                else $this->main->setSess('message', 'error|Error adding user');
            } else {
                $mess = 'Error form';
                foreach ($err as $er) {
                    $mess .= '<br>' . $er . '';
                }
                $this->main->setSess('message', 'error|' . $mess);
            }
        }

        if($task == 'update' && $data['id']) header('location:index.php?ctrl=user&task=viewedit&id='.$data['id']);
        else header('location:index.php?ctrl=user&task=viewadd');
    }

    public static function instance($class = __CLASS__){
        return parent::instance($class);
    }
}
    ?>