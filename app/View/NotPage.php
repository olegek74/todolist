<?php
namespace App\View;

use Kernel\View;

class NotPage extends View{

    public function display(){
		$this->tmpl('utils', 'page404');
    }
}
?>