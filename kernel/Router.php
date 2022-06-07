<?php
namespace Kernel;

use Kernel\Main;

class Router {
    public $controller_default = 'App\Controllers\TaskController';
    private $controller;
    public $task_default = 'view_list';
    private $task;
    private static $object;
    private static $main_link;
    private static $sef = true;
    public function __construct(){
        $main = Main::instance();
        $uri = $main->uri();
        if(preg_match_all('/\/([a-z_\-]+)/', $uri, $matches) && $matches[1][0] != 'index'){
            $ctrl = $matches[1][0];
            $task = $matches[1][1];
            self::$main_link = $ctrl.'/'.$task;
            self::$sef = true;
        }
        else {
            $ctrl = $main->get('ctrl', false);
            $task = $main->get('task', false);
            self::$main_link = 'ctrl='.$ctrl.'&task='.$task;
        }

        if($ctrl){
            $this->controller = 'App\Controllers\\'.ucfirst($ctrl).'Controller';
        }
        else $this->controller = $this->controller_default;
        if($task){
            $this->task = $task;
        }
        else $this->task = $this->task_default;

    }

    public function getLink($link){
        if(!self::$sef) return $link;
        $_link = trim($link, '/');
        $_link = str_replace('index.php?', '/?', $_link);
        $_link = str_replace('index.php', '', $_link);
        $_link = str_replace('&amp;', '&', $_link);
        if($_link == '') return '/';
        $parts = preg_split('/[&\?]/', $_link);
        $ctrl = $task = false;
        $qs = [];
        foreach($parts as $part){
            if($part == '/' || $part == '') continue;
            if(strpos($part, 'ctrl=')===0) {
                $ctrl = explode('=', $part)[1];
                continue;
            }
            if(strpos($part, 'task=')===0) {
                $task = explode('=', $part)[1];
                continue;
            }
            $qs[] = $part;
        }
        if(!$ctrl) $ctrl = 'task';
        if(!$task) $task = $this->task_default;
        $_link = '/'.$ctrl.'/'.$task.'/';
        if(!empty($qs)) $_link .= '?'.implode('&', $qs);
        return $_link;
    }

    public function __get($name){
        if($name == 'controller') return $this->controller;
        if($name == 'task') return $this->task;
        if($name == 'main_link') return self::$main_link;
    }
    public static function instance(){
        if(!self::$object){
            self::$object = new self;
        }
        return self::$object;
    }
}
?>