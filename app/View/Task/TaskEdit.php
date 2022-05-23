<?php

namespace App\View\Task;

use App\Controllers\UserController as User;

defined('ROOTPATH') or die('access denied');

class taskEdit {

    private $allow_add;
    private function allowAdd(){
        if(is_null($this->allow_add)){
            $user = new User();
            $this->allow_add = $user->auth();
        }
        return $this->allow_add;
    }

    public function task_add($userlist){
        $allow_add = $this->allow_add();
        require_once ROOTPATH . DS . 'html' . DS . 'global'. DS .'head.php';
        require_once ROOTPATH.DS.'html'.DS.'task'. DS .'task_add.php';
        require_once ROOTPATH . DS . 'html' . DS . 'global'. DS .'foot.php';
    }
    public function task_edit($data){
        require_once ROOTPATH . DS . 'html' . DS . 'global'. DS .'head.php';
        require_once ROOTPATH . DS . 'html' . DS . 'task'. DS .'task_edit.php';
        require_once ROOTPATH . DS . 'html' . DS . 'global'. DS .'foot.php';
    }
}
?>