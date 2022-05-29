<?php

namespace App\View\Task;

use App\Models\TaskModel;
use App\Controllers\TaskController;
use Kernel\View;

defined('ROOTPATH') or die('access denied');

class Tasks extends View{

    public $list;

    public function __construct(){
        parent::__construct();
        $this->main_link = '';
        $this->count = TaskModel::getTotal();
    }

    public function task_list(){
        $allow_delete = TaskController::instance()->allow('delete');
        $this->header();
        $paginator = $this->pagination();
        $sort = $this->sort();
        $messages = TaskController::$messages;
        $curr_list_opt = TaskController::$curr_list_opt;
        require_once ROOTPATH.DS.'html'.DS.'task'. DS .'list.php';
        $this->footer();
    }
}