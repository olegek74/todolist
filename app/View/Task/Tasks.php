<?php

namespace App\View\Task;

use App\Models\TaskModel;
use App\Controllers\TaskController;
use Kernel\View;


class Tasks extends View{

    public $list;

    public function __construct(){
        parent::__construct();
        $this->main_link = '';
        $this->count = TaskModel::getTotal();
    }

    public function task_list(){
        $this->page_title = 'List of task';
        $this->tmpl('task', 'list', [
            'allow_delete' => TaskController::instance()->allow('delete'),
            'allow_edit' => TaskController::instance()->allow('edit'),
            'paginator' => $this->pagination(),
            'sort' => $this->sort(),
            'messages' => $this->messages(),
            'curr_list_opt' => TaskController::$curr_list_opt
        ]);
    }
}