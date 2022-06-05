<?php
namespace App\View\User;

use App\Controllers\UserController;
use App\Models\UserModel;
use Kernel\View;


class Users extends View {

    public $users_list;

    public function __construct(){
        parent::__construct();
        $this->main_link = 'ctrl=user&task=view_list&';
        $this->count = UserModel::getTotal();
    }

    public function user_list(){
        $this->page_title = 'List of Users';
        $this->content('user', 'users', [
            'curr_list_opt' => UserController::$curr_list_opt,
            'messages' => $this->messages(),
            'sort' => $this->sort(),
            'paginator' => $this->pagination(),
            'selector' => $this->selector(),
            'allow_delete' => UserController::instance()->allow('delete'),
            'allow_edit' => UserController::instance()->allow('edit')
        ]);
    }
}
?>