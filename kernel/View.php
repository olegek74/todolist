<?php
namespace Kernel;

use App\Controllers\MenuController;
use App\Controllers\UserController;
use Kernel\Controller;

class View {

    protected $count;

    protected $main_link;

    protected $sort;

    public $page_title;

    public $title;

    public function __construct() {
        $this->sort = Controller::$sort;
    }

    protected function header(){
        $menu = MenuController::instance();
        require_once ROOTPATH . DS . 'html' . DS . 'global'. DS .'header.php';
    }

    protected function footer(){
        require_once ROOTPATH . DS . 'html' . DS . 'global'. DS .'footer.php';
    }

    protected function pagination(){
        $list_start = Controller::$list_start;
        $curr_list_opt =  Controller::$curr_list_opt;
        $sort = $this->sort;
        $count = $this->count;
        $main_link = $this->main_link;
        ob_start();
        require_once ROOTPATH.DS.'html'.DS.'utils'. DS .'paginator.php';
        return ob_get_clean();
    }

    protected function sort(){
        $sort = $this->sort;
        $main_link = $this->main_link;
        ob_start();
        require ROOTPATH.DS.'html'.DS.'utils'. DS .'sort.php';
        return ob_get_clean();
    }
}