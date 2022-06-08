<?php
namespace App\View\User;

use App\Controllers\UserController;
use App\Models\UserModel;
use Kernel\View;


class Users extends View {

    public $list;

    public function __construct(){
        parent::__construct();
        $this->main_link = 'ctrl=user&task=view_list&';
        $this->count = UserModel::getTotal();
    }

    public function user_list(){
        $this->page_title = 'List of Users';
        $this->content('user', 'list', [
            'allow_delete' => UserController::instance()->allow('delete'),
            'allow_edit' => UserController::instance()->allow('edit')
        ]);
    }
}
?>