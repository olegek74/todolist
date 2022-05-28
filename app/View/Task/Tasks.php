<?php

namespace App\View\Task;

use App\Models\TaskModel;
use App\Controllers\TaskController;
use App\Controllers\MenuController;

defined('ROOTPATH') or die('access denied');

class Tasks {

    public $list;

    public function task_list(){
        $allow_delete = TaskController::instance()->allow('delete');
        $menu = MenuController::instance();
        require_once ROOTPATH . DS . 'html' . DS . 'global'. DS .'head.php';
        $paginator = $this->pagination();
        $sort = $this->sort();
        $messages = TaskController::$messages;
        $curr_list_opt = TaskController::$curr_list_opt;
        require_once ROOTPATH.DS.'html'.DS.'task'. DS .'list.php';
        require_once ROOTPATH . DS . 'html' . DS . 'global'. DS .'foot.php';
    }

    private function sort(){
        $sort = TaskController::$sort;
        $main_link = '';
        ob_start();
        require ROOTPATH.DS.'html'.DS.'utils'. DS .'sort.php';
        return ob_get_clean();
    }

    private function pagination(){
        $count = TaskModel::getTotal();
        $list_start = TaskController::$list_start;
        $curr_list_opt =  TaskController::$curr_list_opt;
        $sort = TaskController::$sort;
        $main_link = '';
        ob_start();
        require_once ROOTPATH.DS.'html'.DS.'utils'. DS .'paginator.php';
        return ob_get_clean();
    }
}