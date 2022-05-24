<?php
namespace App\View;

class NotPage{

    public function display(){
        $menu = \App\Controllers\MenuController::instance();
        require_once ROOTPATH . DS . 'html' . DS . 'global'. DS .'head.php';
        require_once ROOTPATH . DS . 'html' . DS . 'utils'. DS .'page404.php';
        require_once ROOTPATH . DS . 'html' . DS . 'global'. DS .'foot.php';
    }
}
?>