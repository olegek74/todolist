<?php
namespace Kernel;

use App\Controllers\MenuController;
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
        $this->tmpl('global', 'header', ['menu'=> $menu]);
    }

    protected function footer(){
        $this->tmpl('global', 'footer');
    }

    protected function pagination(){
        ob_start();
        $this->tmpl('utils', 'paginator', [
            'list_start' => Controller::$list_start,
            'curr_list_opt' => Controller::$curr_list_opt,
            'sort' => $this->sort,
            'count' => $this->count,
            'main_link' => $this->main_link
        ]);
        return ob_get_clean();
    }

    protected function sort(){
        ob_start();
        $this->tmpl('utils', 'sort', ['sort' => $this->sort, 'main_link' => $this->main_link]);
        return ob_get_clean();
    }

    protected function tmpl($folder, $tpl, $data = []){
        extract($data);
        unset($data);
        require_once ROOTPATH . DS . 'html' . DS . $folder. DS . $tpl .'.php';
    }
}