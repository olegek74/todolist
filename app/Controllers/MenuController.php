<?php
namespace App\Controllers;

use App\Objects;
use \App\Main;
use App\Router;

defined('ROOTPATH') or die('access denied');

class MenuController extends Objects {

    protected $main;
    protected $router;
    protected $controler;
    protected $task;
    protected $ctrl;
    protected static $object;
    public $items = [
        'index.php'=>'Task list',
        'index.php?ctrl=task&task=viewadd'=>'Add Task',
        'index.php?ctrl=user&task=viewauth'=>'Login'
    ];

    public function __construct(){
        $this->main = Main::instance();
        $this->router = Router::instance();
        $this->controler = $this->router->controller;
        $this->task = $this->router->task;
        $ctrl = explode('\\', $this->controler);
        $ctrl = end($ctrl);
        $ctrl = str_replace('Controller', '', $ctrl);
        $this->ctrl = strtolower($ctrl);
    }

    public function isActive($link){
        $link = trim($link, '/');
        if($link != ''){
            $_link = preg_split('/[\?\&]/', $link);
            if(count($_link) > 0){
                $path = [];
                foreach($_link as $part){
                    list($name, $value) = explode('=', $part);
                    if(!$value) continue;
                    $path[$name] = $value;
                }
                if(isset($path['ctrl'])){
                    if($path['ctrl'] == $this->ctrl){
                        if(isset($path['task'])){
                            if($path['task'] == $this->task){
                                return true;
                            }
                            else return false;
                        }
                        else return true;
                    }
                }
                elseif($this->controler == $this->router->controller_default && $this->task == $this->router->task_default) {
                    return true;
                }
            }
        }
        return false;
    }

    public static function instance(){
        self::$object = parent::_instance(__CLASS__);
        return self::$object;
    }
}