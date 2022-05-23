<?php

namespace App\View\Task;

use App\Controllers\UserController as User;
use App\Models\TaskModel;
use App\Controllers\TaskController;

defined('ROOTPATH') or die('access denied');

class TaskList {
    private $allow_delete = null;

    private function allowDelete(){
        if(is_null($this->allow_delete)){
            $user = User::instance();
            $this->allow_delete = $user->auth();
        }
        return $this->allow_delete;
    }

    public function tasklist($list){
        $allow_delete = $this->allowDelete();
        $menu = \App\Controllers\MenuController::instance();
        require_once ROOTPATH . DS . 'html' . DS . 'global'. DS .'head.php';
        $paginator = $this->pagination();
        $sort = $this->sort();
        $messages = TaskController::$messages;
        $curr_list_opt = TaskController::$curr_list_opt;
        require_once ROOTPATH.DS.'html'.DS.'task'. DS .'tasks_list.php';
        require_once ROOTPATH . DS . 'html' . DS . 'global'. DS .'foot.php';
    }
    private function sort(){
        $sort = TaskController::$sort;
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
        $count = TaskModel::getTotal();
        $list_start = TaskController::$list_start;
        $curr_list_opt =  TaskController::$curr_list_opt;
        $sort = TaskController::$sort;
        $append = '';
        if($sort == 'asc' || $sort == 'desc'){
            $append = '&sort='.$sort;
        }
        $numpages = $count/$curr_list_opt;
        $num = intval($numpages);
        if($numpages != $num) $numpages = $num+1;
        ob_start();
        require_once ROOTPATH.DS.'html'.DS.'utils'. DS .'paginator.php';
        return ob_get_clean();
    }
}