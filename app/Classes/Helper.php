<?php
namespace App\Classes;

use Kernel\View;

class Helper {

    public static function getView(){
        return View::instance();
    }

    public static function requireHtml($folder, $file, $data = []){
        extract($data);
        unset($data);
        ob_start();
        require ROOTPATH . DS . 'html' . DS . $folder . DS . $file.'.php';
        return ob_get_clean();
    }

}