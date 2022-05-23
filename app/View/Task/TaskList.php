<?php

namespace App\View\Task;

use App\Controllers\UserController as User;

defined('ROOTPATH') or die('access denied');

class TaskList {
    private $allow_delete = null;

    private function allowDelete(){
        if(is_null($this->allow_delete)){
            $user = new User();
            $this->allow_delete = $user->auth();
        }
        return $this->allow_delete;
    }

    public function tasklist($list){
        $allow_delete = $this->allowDelete();
        require_once ROOTPATH . DS . 'html' . DS . 'global'. DS .'head.php';
        $paginator = $this->pagination();
        $sort = $this->sort();
        $messages = \App\Controllers\TaskController::$messages;
        require_once ROOTPATH.DS.'html'.DS.'task'. DS .'tasks_list.php';
        require_once ROOTPATH . DS . 'html' . DS . 'global'. DS .'foot.php';
    }
    private function sort(){
        $sort = \App\Controllers\TaskController::$sort;
        if(!$sort || $sort == 'desc') {
            $sort = 'asc';
            $icon = '&uarr;';
        }
        else {
            $sort = 'desc';
            $icon = '&darr;';
        }
        return '<a href="index.php?sort='.$sort.'">&nbsp;'.$icon.'&nbsp;</a>';
    }
    private function pagination(){
        $count = \App\Models\TaskModel::getTotal();
        $list_start = \App\Controllers\TaskController::$list_start;
        $sort = \App\Controllers\TaskController::$sort;
        $append = '';
        if($sort == 'asc' || $sort == 'desc'){
            $append = '&sort='.$sort;
        }
        $numpages = $count/3;
        $num = intval($numpages);
        if($numpages != $num) $numpages = $num+1;
        ob_start();
        require_once ROOTPATH.DS.'html'.DS.'utils'. DS .'paginator.php';
        return ob_get_clean();
    }
}