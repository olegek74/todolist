<?php
namespace App\Controllers;

use App\Models\UserModel as Model;

defined('ROOTPATH') or die('access denied');

class UserController {

    public static $messages = [];
    public function login(){
        if($this->auth()){
            $_SESSION['message'] = 'success|Welcome!';
            header('location: index.php');
        }
        else {
            $_SESSION['message'] = 'error|Incorrect login or password';
            header('location: index.php?ctrl=user&task=viewauth');
        }
        die;
    }

    public function unlogin(){
        $_SESSION['password'] = null;
        $_SESSION['login'] = null;
        setcookie('login', '', time()-3600, '/');
        setcookie('password', '', time()-3600, '/');
        header('location: index.php?ctrl=user&task=viewauth');
        die;
    }

    public function auth(){

        $auth = false;
        $login = '';
        $password = '';
        if(!isset($_COOKIE['login']) || !isset($_COOKIE['password'])){
            if(isset($_GET['login'])) $login = $_GET['login'];
            if(isset($_GET['password'])) $password = md5(trim($_GET['password']));
        }
        else {
            $login = trim($_COOKIE['login']);
            $password = trim($_COOKIE['password']);
        }

        if($login != "" && $password != "") {
            if(isset($_SESSION['login']) && isset($_SESSION['password'])){
                if($_SESSION['login'] == $login && $_SESSION['password'] == $password){
                    $auth = true;
                }
            }

            if(!$auth){
                $usermodel = new Model();
                if($usermodel->getAuth($login, $password)){
                    $_SESSION['password'] = md5($password);
                    $_SESSION['login'] = $login;
                    setcookie('login', $login, time()+3600, '/');
                    setcookie('password', $password, time()+3600, '/');
                    $auth = true;
                }
            }
        }
        return $auth;
    }

    public function viewauth(){
        if(isset($_SESSION['message'])) self::$messages[] = $_SESSION['message'];
        $_SESSION['message'] = '';
        $view = new \App\View\User\User;
        $view->viewAuth($this->auth());
    }
}
    ?>