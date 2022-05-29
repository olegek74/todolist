<?php
namespace App\View;

use Kernel\View;

class NotPage extends View{

    public function display(){
        $this->header();
        require_once ROOTPATH . DS . 'html' . DS . 'utils'. DS .'page404.php';
        $this->footer();
    }
}
?>