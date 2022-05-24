<?php
namespace App\Controllers;

use App\Objects;
use App\Models\UserModel as Model;
use \App\Main;

defined('ROOTPATH') or die('access denied');

class UserController extends Objects{

    public static $messages = [];

    private $main;

    protected static $object;

    public function __construct()
    {
        $this->main = Main::instance();
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
                if($usermodel->getAuth($login, $password)){
                    $this->main->setSess('password', md5($password));
                    $this->main->setSess('login', $login);
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
        $view = new \App\View\User\User;
        $view->viewAuth($this->auth());
    }

    public function viewadd(){
        self::$messages[] = $this->main->getSess('message', null);
        $this->main->setSess('message', null);
        $view = new \App\View\User\User;
        $view->userdata = $this->main->getSess('userdata', null);
        $this->main->setSess('userdata', null);
        $view->viewAdd();
    }

    public function add(){
        $err = [];
        $data = [];

        $data['manager'] = $this->main->get('manager', false);

        if($data['manager']) {
            if (!$data['login'] = $this->main->get('login', false)) {
                $err[2] = 'Login is missing';
                unset($data['login']);
            }
            if (!$data['password'] = $this->main->get('password', false)) {
                $err[3] = 'Password is missing';
                unset($data['password']);
            }
        }
        if(!$data['name'] = $this->main->get('name', false)){
            $err[4] = 'Name is missing';
            unset($data['name']);
        }
        if(!$data['email'] = $this->main->get('email', false)){
            $err[1] = 'Email is missing';
            unset($data['email']);
        }

        $this->main->setSess('userdata', $data);

        if(empty($err)){
            $model = Model::instance();
            if($model->save($data)){
                $this->main->setSess('message', 'success|User added successfully');
            }
            else $this->main->setSess('message', 'error|Error adding user');
        }
        else {
            $mess = 'Error form';
            foreach($err as $er){
                $mess .= '<br>'.$er.'';
            }
            $this->main->setSess('message', 'error|'.$mess);
        }
        header('location:index.php?ctrl=user&task=viewadd');
    }

    public static function instance(){
        self::$object = parent::_instance(__CLASS__);
        return self::$object;
    }
}
    ?>