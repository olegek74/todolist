<?php

namespace App\View\Task;

use App\Controllers\UserController as User;

defined('ROOTPATH') or die('access denied');

class taskEdit {

    private $allowadd;
    private function allowAdd(){
        if(is_null($this->allowadd)){
            $user = new User();
            $this->allowadd = $user->auth();
        }
        return $this->allowadd;
    }

    public function task_add($userlist){
        $allowadd = $this->allowAdd();
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