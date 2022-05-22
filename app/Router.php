<?php
namespace App;

defined('ROOTPATH') or die('access denied');

class Router {
    public $controller = 'App\Controllers\TaskController';
    public $task = 'getList';
    public function __construct(){
        $ctrl = '';
        if(isset($_GET['ctrl'])){
            $ctrl = trim($_GET['ctrl']);
            if($ctrl){
                $this->controller = 'App\Controllers\\'.ucfirst($ctrl).'Controller';
            }
        }
        if(isset($_GET['task'])){
            $task = trim($_GET['task']);
            if($task){
                $this->task = $task;
            }
        }
    }
    public function __get($name){
        if($name == 'controller') return $this->controller;
        if($name == 'task') return $this->task;
    }
}
?>