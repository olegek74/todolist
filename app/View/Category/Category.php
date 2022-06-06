<?php

namespace App\View\Category;

use App\Models\CategoryModel;
use App\Controllers\CategoryController;
use Kernel\View;

class Category extends View{
    public $data;

    private function getCatList(){
        return CategoryModel::instance()->getList(0, false, 10);
    }

    public function add(){
        $this->page_title = 'Add Category';
        parent::$meta['description'] = 'This is a add category page';
        if(CategoryController::instance()->allow('create')){
            $this->content('category', 'add', [
                'catlist' => $this->getCatList()
            ]);
        }
        else $this->content('utils', 'deny');
    }

    public function edit(){
        $this->page_title = 'Edit Category';
        parent::$meta['description'] = 'This is a edit category page';
        if(CategoryController::instance()->allow('edit')) {
            $this->content('category', 'edit', [
                'catlist' => $this->getCatList()
            ]);
        }
        else $this->content('utils', 'deny');
    }

    public function show(){
        $this->page_title = 'Show Category';
        parent::$meta['description'] = 'This is a category show page';
        $this->content('category', 'show');
    }

    public function __get($name){
        if(!empty($this->data) && isset($this->data[$name])) return $this->data[$name];
        return '';
    }
}