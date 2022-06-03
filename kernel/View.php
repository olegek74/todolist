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

    public static $meta = ['description' => 'Todolist for managers and users'];

    private static $tpl = ['header' => '', 'content' => '', 'footer' => ''];

    public function __construct() {
        $this->sort = Controller::$sort;
    }

    protected function header(){
        ob_start();
        $menu = MenuController::instance();
        require_once ROOTPATH . DS . 'html' . DS . 'global' . DS . 'header.php';
        self::$tpl['header'] .= ob_get_clean();
    }

    protected function footer(){
        ob_start();
        require_once ROOTPATH . DS . 'html' . DS . 'global' . DS . 'footer.php';
        self::$tpl['footer'] .= ob_get_clean();
    }

    protected function pagination(){
        $list_start = Controller::$list_start;
        $curr_list_opt = Controller::$curr_list_opt;
        $sort = $this->sort;
        $count = $this->count;
        $main_link = $this->main_link;
        ob_start();
        require_once ROOTPATH . DS . 'html' . DS . 'utils' . DS . 'paginator.php';
        return ob_get_clean();
    }

    protected function selector(){
        ob_start();
        require_once ROOTPATH . DS . 'html' . DS . 'utils' . DS . 'selector.php';
        return ob_get_clean();
    }

    protected function messages(){
        $messages = Controller::$messages;
        ob_start();
        require_once ROOTPATH . DS . 'html' . DS . 'utils' . DS . 'messages.php';
        return ob_get_clean();
    }

    protected function sort(){
        $sort = $this->sort;
        $main_link = $this->main_link;
        ob_start();
        require_once ROOTPATH . DS . 'html' . DS . 'utils' . DS . 'sort.php';
        return ob_get_clean();
    }

    protected function tmpl($folder, $tpl, $data = []){
        extract($data);
        unset($data);
        ob_start();
        require_once ROOTPATH . DS . 'html' . DS . $folder. DS . $tpl .'.php';
        self::$tpl['content'] .= ob_get_clean();
    }

    public function __destruct(){
        $this->header();
        $this->footer();
        $tpl_file = file_get_contents(ROOTPATH.DS.'tpl.bak');
        echo str_replace(['{header}','{content}','{footer}'], [self::$tpl['header'], self::$tpl['content'], self::$tpl['footer']], $tpl_file);
    }
}