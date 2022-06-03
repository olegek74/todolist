<?php
namespace Kernel;

use Kernel\Main;

class Router {
    public $controller_default = 'App\Controllers\TaskController';
    private $controller;
    public $task_default = 'view_list';
    private $task;
    private static $object;
    public function __construct(){
        $main = Main::instance();
        $ctrl = $main->get('ctrl', false);
        if($ctrl){
            $this->controller = 'App\Controllers\\'.ucfirst($ctrl).'Controller';
        }
        else $this->controller = $this->controller_default;
        $task = $main->get('task', false);
        if($task){
            $this->task = $task;
        }
        else $this->task = $this->task_default;
    }
    public function __get($name){
        if($name == 'controller') return $this->controller;
        if($name == 'task') return $this->task;
    }
    public static function instance(){
        if(!self::$object){
            self::$object = new self;
        }
        return self::$object;
    }
}
?>