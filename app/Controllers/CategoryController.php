<?php
namespace App\Controllers;

use Kernel\Controller;
use App\Models\CategoryModel as Model;
use App\View\Category\Categories;
use App\View\Category\Category;

class CategoryController extends Controller {

    private $redirect_url = 'index.php?ctrl=category';

    public function __construct(){
        parent::__construct();
    }

    public function view_list(){
        $view = new Categories;
        $model = Model::instance();
        $list = $model->getList(parent::$list_start, parent::$sort, parent::$curr_list_opt);
        $view->list = $list;
        $view->category_list();
    }

    public function allow($action){
        return Model::instance()->getAllow($action, $this->main->getSess('role', 0));
    }

    public function view_add() {
        $view = new Category;
        $view->add();
    }

    public function view_show(){
        if($id = $this->main->getInt('id', false)){
            $view = new Category;
            $view->data = Model::instance()->getOne($id);
            if($view->data['parent_id']) {
                $parent_data = Model::instance()->getOne($view->data['parent_id']);
                $view->data['parent'] = $parent_data['name'];
            }
            $view->show();
        }
    }

    public function view_edit(){
        if($id = $this->main->getInt('id', false)){
            $view = new Category;
            $view->data = Model::instance()->getOne($id);
            $view->edit();
        }
    }

    public function edit(){
        if ($this->allow('edit')) {
            $err = [];
            $data = [];

            if (!$data['cat_id'] = $this->main->getInt('id', false)) {
                $err[] = 'Uncnown category';
            }
            else $this->redirect_url .= '&task=view_edit&id='.$data['cat_id'];

            if (!$data['name'] = $this->main->get('name', false)) {
                $err[] = 'Category name is empty';
            }

            if (!$data['description'] = $this->main->get('description', false)) {
                $err[] = 'Category description is empty';
            }

            $data['parent_id'] = $this->main->getInt('parent_id', '0');

            if (empty($err)) {
                $model = Model::instance();
                $model->edit($data);
                $this->main->setSess('message', 'success|Category edit successfully');
            } else {
                $this->buildErrorMessage($err, 'Errors:<br>');
            }
        }
        else $this->main->setSess('message', 'error|Edit error.Access denied');

        $this->redirect($this->redirect_url);
    }

    public function add(){

        if($this->allow('create')) {
            $err = [];
            $data = [];

            if (!$data['name'] = $this->main->get('name', false)) {
                $err[] = 'Name is empty';
            }

            if (!$data['description'] = $this->main->get('description', false)) {
                $err[] = 'Description is empty';
            }

            $data['parent_id'] = $this->main->getInt('parent_id', '0');

            if (empty($err)) {
                $model = Model::instance();
                if($new_id = $model->create($data)){
                    $this->redirect_url .= '&task=view_show&id='.$new_id;
                    $this->main->setSess('message', 'success|Category added successfully');
                }
                else {
                    $err[] = 'Uncnown error insert category';
                    $this->redirect_url .= '&task=view_add';
                }
            }
            else {
                $this->buildErrorMessage($err, 'Errors:<br>');
                $this->redirect_url .= '&task=view_add';
            }
        }
        else $this->main->setSess('message', 'error|Add error.Authorization is required to add');
        $this->redirect($this->redirect_url);
    }

    public function delete(){
        if($this->allow('delete')) {
            if ($id = $this->main->getInt('id', false)) {
                $model = Model::instance();
                $model->delete($id);
                $this->main->setSess('message', 'success|Category #' . $id . ' has been deleted');
            }
        }
        else $this->main->setSess('message', 'error|Delete error.You do not have access');
        $this->redirect($this->redirect_url);
    }

    public static function instance($class = __CLASS__){
        return parent::instance($class);
    }
}

?>