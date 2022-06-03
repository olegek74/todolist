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

    protected function requireHtml($folder, $file, $data = []){
        extract($data);
        unset($data);
        ob_start();
        require_once ROOTPATH . DS . 'html' . DS . $folder . DS . $file.'.php';
        return ob_get_clean();
    }

    protected function header(){
        self::$tpl['header'] .= $this->requireHtml('global', 'header', ['menu' => MenuController::instance()]);
    }

    protected function footer(){
        self::$tpl['footer'] .= $this->requireHtml('global', 'footer');
    }

    protected function pagination(){
        return $this->requireHtml('utils', 'paginator', [
            'list_start' => Controller::$list_start,
            'curr_list_opt' => Controller::$curr_list_opt,
            'sort' => $this->sort,
            'count' => $this->count,
            'main_link' => $this->main_link
        ]);
    }

    protected function selector(){
        return $this->requireHtml('utils', 'selector');
    }

    protected function messages(){
        return $this->requireHtml('utils', 'messages', ['messages' => Controller::$messages]);
    }

    protected function sort(){
        return $this->requireHtml('utils', 'sort', ['main_link' => $this->main_link, 'sort' => $this->sort]);
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