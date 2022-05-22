<?php
namespace App\View\User;

defined('ROOTPATH') or die('access denied');

class User {
    public function viewAuth($isauth){
        require_once ROOTPATH . DS . 'html' . DS . 'global'. DS .'head.php';
        $messages = \App\Controllers\UserController::$messages;
        if($isauth){
            require_once ROOTPATH . DS . 'html' . DS . 'user'.DS.'unlogin.php';
        }
        else {
            require_once ROOTPATH . DS . 'html' . DS . 'user'.DS.'login.php';
        }
        require_once ROOTPATH . DS . 'html' . DS . 'global'. DS .'foot.php';
    }
}
?>