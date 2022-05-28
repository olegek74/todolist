<?php
namespace App\View\User;

use App\Controllers\UserController;
use App\Controllers\MenuController;

defined('ROOTPATH') or die('access denied');

class Users {
    public $users_list;

    public function user_list(){
        $allow_delete = UserController::instance()->allow('delete');
        $menu = MenuController::instance();
        require_once ROOTPATH . DS . 'html' . DS . 'global'. DS .'head.php';
        $paginator = $this->pagination();
        $sort = $this->sort();
        $messages = UserController::$messages;
        $curr_list_opt = UserController::$curr_list_opt;
        require_once ROOTPATH . DS . 'html' . DS . 'user'.DS.'users.php';
        require_once ROOTPATH . DS . 'html' . DS . 'global'. DS .'foot.php';
    }

    private function pagination(){
        $count = \App\Models\UserModel::getTotal();
        $list_start = UserController::$list_start;
        $curr_list_opt =  UserController::$curr_list_opt;
        $sort = UserController::$sort;
        $main_link = 'ctrl=user&task=view_list&';
        ob_start();
        require_once ROOTPATH.DS.'html'.DS.'utils'. DS .'paginator.php';
        return ob_get_clean();
    }
    private function sort(){
        $sort = UserController::$sort;
        $main_link = 'ctrl=user&task=view_list&';
        ob_start();
        require ROOTPATH.DS.'html'.DS.'utils'. DS .'sort.php';
        return ob_get_clean();
    }
}
?>