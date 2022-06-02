<?php

namespace App\View\Category;

use App\Models\CategoryModel;
use App\Controllers\CategoryController;
use Kernel\View;

class Category extends View{
    public $category_data;

    private function getCatList(){
        return CategoryModel::instance()->getList(0, false, 10);
    }

    public function add(){
        $this->page_title = 'Add Category';
        $this->header();
        if(CategoryController::instance()->allow('create')){
            $this->tmpl('category', 'add', [
                'catlist' => $this->getCatList(),
                'messages' => CategoryController::$messages
            ]);
        }
        else $this->tmpl('utils', 'deny');
        $this->footer();
    }

    public function edit(){
        $this->page_title = 'Edit Category';
        $this->header();
        if(CategoryController::instance()->allow('edit')) {
            $this->tmpl('category', 'edit', [
                'catlist' => $this->getCatList(),
                'messages' => CategoryController::$messages
            ]);
        }
        else $this->tmpl('utils', 'deny');
        $this->footer();
    }

    public function show(){
        $this->page_title = 'Show Category';
        $this->header();
        $this->tmpl('category', 'show', ['messages' => CategoryController::$messages]);
        $this->footer();
    }

    public function __get($name){
        if(!empty($this->category_data) && isset($this->category_data[$name])) return $this->category_data[$name];
        return '';
    }
}