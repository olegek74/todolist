<?php
namespace App\View\User;

use App\Controllers\UserController;
use App\Models\UserModel;
use Kernel\View;

defined('ROOTPATH') or die('access denied');

class Users extends View {

    public $users_list;

    public function __construct(){
        parent::__construct();
        $this->main_link = 'ctrl=user&task=view_list&';
        $this->count = UserModel::getTotal();
    }

    public function user_list(){
        $allow_delete = UserController::instance()->allow('delete');
        $allow_edit = UserController::instance()->allow('edit');
        $this->page_title = 'List of Users';
        $this->header();
        $paginator = $this->pagination();
        $sort = $this->sort();
        $messages = UserController::$messages;
        $curr_list_opt = UserController::$curr_list_opt;
        require_once ROOTPATH . DS . 'html' . DS . 'user'.DS.'users.php';
        $this->footer();
    }
}
?>