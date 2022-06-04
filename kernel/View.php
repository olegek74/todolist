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

    private static $tpl = ['head' => '', 'header' => '', 'content' => '', 'footer' => ''];

    public function __construct() {
    }

    protected function requireHtml($folder, $file, $data = []){
        extract($data);
        unset($data);
        ob_start();
        require ROOTPATH . DS . 'html' . DS . $folder . DS . $file.'.php';
        return ob_get_clean();
    }

    protected function header(){
        self::$tpl['header'] .= $this->requireHtml('common', 'header', [
            'menu' => MenuController::instance()
        ]);
    }

    protected function head(){
        self::$tpl['head'] .= $this->requireHtml('common', 'head');
    }

    protected function footer(){
        self::$tpl['footer'] .= $this->requireHtml('common', 'footer');
    }

    protected function buidSortLink($sort_data, $sort_by, $title){
        return $this->requireHtml('utils', 'build_sort', [
            'sort_data' => $sort_data, 'sort_by' => $sort_by, 'title' => $title
        ]);
    }

    protected function pagination(){
        return $this->requireHtml('utils', 'paginator', [
            'list_start' => Controller::$list_start,
            'curr_list_opt' => Controller::$curr_list_opt,
            'sort' => Controller::$sort,
            'count' => $this->count,
            'main_link' => $this->main_link
        ]);
    }

    protected function selector(){
        return $this->requireHtml('utils', 'selector', ['curr_list_opt' => Controller::$curr_list_opt]);
    }

    protected function messages(){
        return $this->requireHtml('utils', 'messages', ['messages' => Controller::$messages]);
    }

    protected function sort(){
       return $this->requireHtml('utils', 'sort', ['main_link' => $this->main_link, 'sort' => Controller::$sort]);
    }

    protected function tmpl($folder, $tpl, $data = []){
        extract($data);
        unset($data);
        ob_start();
        require_once ROOTPATH . DS . 'html' . DS . $folder. DS . $tpl .'.php';
        self::$tpl['content'] .= ob_get_clean();
    }

    public function __destruct(){
        $this->head();
        $this->header();
        $this->footer();
        $tpl_file = file_get_contents(ROOTPATH.DS.'tpl.bak');
        echo str_replace(['{head}','{header}','{content}','{footer}'], [self::$tpl['head'], self::$tpl['header'], self::$tpl['content'], self::$tpl['footer']], $tpl_file);
    }
}