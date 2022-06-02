<?php
namespace App\Controllers;

use Kernel\Objects;
use Kernel\Main;
use Kernel\Router;

defined('ROOTPATH') or die('access denied');

class MenuController extends Objects {

    protected $main;
    protected $router;
    protected $controler;
    protected $task;
    protected $ctrl;

    public $items = [
        'index.php'=>'Task list',
        'index.php?ctrl=task&task=view_add'=>'Add Task',
        'index.php?ctrl=category&task=view_list'=>'Categories',
        'index.php?ctrl=category&task=view_add'=>'Add category',
        'index.php?ctrl=user&task=view_list'=>'Users',
        'index.php?ctrl=user&task=view_add'=>'Add user',
        'index.php?ctrl=user&task=view_auth'=>'Login'
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
                    $parts = explode('=', $part);
                    if(!isset($parts[1]) || !$parts[1]) continue;
                    $path[$parts[0]] = $parts[1];
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

    public static function instance($class = __CLASS__){
        return parent::instance($class);
    }
}