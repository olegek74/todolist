<?php
namespace App\View;

use Kernel\View;

class NotPage extends View{

    public function display(){
		$this->content('utils', 'page404');
    }
}
?>