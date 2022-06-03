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
        parent::$meta['description'] = 'This is a add category page';
        if(CategoryController::instance()->allow('create')){
            $this->tmpl('category', 'add', [
                'catlist' => $this->getCatList(),
                'messages' => $this->messages()
            ]);
        }
        else $this->tmpl('utils', 'deny');
    }

    public function edit(){
        $this->page_title = 'Edit Category';
        parent::$meta['description'] = 'This is a edit category page';
        if(CategoryController::instance()->allow('edit')) {
            $this->tmpl('category', 'edit', [
                'catlist' => $this->getCatList(),
                'messages' => $this->messages()
            ]);
        }
        else $this->tmpl('utils', 'deny');
    }

    public function show(){
        $this->page_title = 'Show Category';
        parent::$meta['description'] = 'This is a category show page';
        $this->tmpl('category', 'show', ['messages' => $this->messages()]);
    }

    public function __get($name){
        if(!empty($this->category_data) && isset($this->category_data[$name])) return $this->category_data[$name];
        return '';
    }
}