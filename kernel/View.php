<?php
namespace Kernel;

use App\Controllers\MenuController;
use Kernel\Controller;
use App\Classes\Helper;
use Kernel\Router;

class View {

    protected $count;

    protected $main_link;

    protected $sort;

    public $page_title;

    public $title;

    public static $meta = ['description' => 'Todolist for managers and users'];

    private static $tpl = ['head' => '', 'header' => '', 'content' => '', 'footer' => ''];

    private static $instance;

    public function __construct() {
        self::$instance = $this;
    }

    public static function instance(){
        return self::$instance;
    }

    protected function header(){
        self::$tpl['header'] .= Helper::requireHtml('common', 'header', [
            'menu' => MenuController::instance(),
            'router' => Router::instance()
        ]);
    }

    protected function head(){
        self::$tpl['head'] .= Helper::requireHtml('common', 'head', ['meta' => self::$meta, 'page' => Controller::$page]);
    }

    protected function footer(){
        self::$tpl['footer'] .= Helper::requireHtml('common', 'footer');
    }

    public function buidSortLink($sort_by, $title){
        return Helper::requireHtml('utils', 'build_sort', [
            'sortData' => $this->sort(), 'sort_by' => $sort_by, 'title' => $title, 'router' => Router::instance()
        ]);
    }

    public function pagination(){
        return Helper::requireHtml('utils', 'paginator', [
            'curr_list_opt' => Controller::$curr_list_opt,
            'sort' => Controller::$sort,
            'count' => $this->count,
            'main_link' => $this->main_link,
            'router' => Router::instance(),
            'current_page' => Controller::$page
        ]);
    }

    public function selector(){
        return Helper::requireHtml('utils', 'selector', ['curr_list_opt' => Controller::$curr_list_opt, 'main_link' => Router::instance()->getLink($this->main_link), 'sort' => Controller::$sort]);
    }

    public function messages(){
        return Helper::requireHtml('utils', 'messages', ['messages' => Controller::$messages]);
    }

    public function sort(){
       return Helper::requireHtml('utils', 'sort', ['main_link' => Router::instance()->getLink($this->main_link), 'sort' => Controller::$sort]);
    }

    protected function content($folder, $tpl, $data = []){
        self::$tpl['content'] .= Helper::requireHtml($folder, $tpl, $data);
    }

    public function __destruct(){
        $this->head();
        $this->header();
        $this->footer();
        $tpl_file = file_get_contents(ROOTPATH.DS.'tpl.html');
        echo str_replace(['{head}','{header}','{content}','{footer}'], [self::$tpl['head'], self::$tpl['header'], self::$tpl['content'], self::$tpl['footer']], $tpl_file);
    }
}