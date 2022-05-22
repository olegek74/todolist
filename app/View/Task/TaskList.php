<?php

namespace App\View\Task;

defined('ROOTPATH') or die('access denied');

class TaskList {
    private $allowadd = null;
    public function tasklist($list){
        require_once ROOTPATH . DS . 'html' . DS . 'global'. DS .'head.php';
        ?>
        <h1 class="display-4">List of Tasks</h1>
        <br>
        <?php
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