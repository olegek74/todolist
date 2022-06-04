<?php

namespace App\View\Category;

use App\Models\CategoryModel;
use App\Controllers\CategoryController;
use Kernel\View;

class Categories extends View{
    public $list;

    public function __construct(){
        parent::__construct();
        $this->main_link = 'ctrl=category&task=view_list&';
        $this->count = CategoryModel::getTotal();
        parent::$meta['description'] = 'This is a category list page';
    }

    public function category_list(){
        $this->page_title = 'List of Category';
        $this->tmpl('category', 'list', [
            'allow_delete' => CategoryController::instance()->allow('delete'),
            'allow_edit' => CategoryController::instance()->allow('edit'),
            'paginator' => $this->pagination(),
            'selector' => $this->selector(),
            'messages' => $this->messages(),
            'curr_list_opt' => CategoryController::$curr_list_opt,
            'sort' => $this->sort()
        ]);
    }
}