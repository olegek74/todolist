<?php

namespace App\Models;
use Kernel\DB;
use Kernel\Model;

class CategoryModel extends Model
{
    private static $roles = [
        '2' => ['edit', 'delete', 'create'],
        '1' => ['edit'],
        '0' => []
    ];

    public function __construct() {
        parent::__construct();
    }

    public function getAllow($action, $role){
        if(in_array($action, self::$roles[$role])) return true;
        else return false;
    }

    public function create($data) {
        $insert = parent::$queryFactory->newInsert();
        $insert->into('categories')->cols(['id', 'name', 'description','parent_id'])
            ->bindValues([
                'id' => NULL,
                'name' => $data['name'],
                'description' => $data['description'],
                'parent_id' => $data['parent_id']
            ]);

        $sth = DB::execute($insert);
        return DB::get_insert_id();
    }

    public function edit($data){

        $update = parent::$queryFactory->newUpdate();
        $cols = ['name', 'description', 'parent_id'];
        $binds = ['name' => $data['name'], 'description' => $data['description'], 'parent_id' => $data['parent_id']];
        $update->table('categories')->cols($cols)->where('id='.$data['cat_id']);
        $update->bindValues($binds);
        DB::execute($update);
    }

    public function getAll($table = 'categories'){
        return parent::getAll($table);
    }

    public function getList($list_start = 0, $sort = false, $curr_list_opt = 3){

        $select = parent::$queryFactory->newSelect();
        $select->cols(['c.*, c1.name AS parent'])->from('categories AS c');
        $select->limit($curr_list_opt)->offset($list_start);
        $select->join('LEFT','categories AS c1', 'c1.id = c.parent_id');

        $this->buidSort($select, $sort, 'c.id');

        $sth = DB::execute($select);
        return $this->get_list($sth);
    }

    public function getFiedListByIds($ids, $table = 'categories', $field = 'name', $key = 'id'){
        return parent::getFiedListByIds($ids, $table, $field, $key);
    }

    public function getOne($id, $table = 'categories'){
        return parent::getOne($id, $table);
    }

    public static function getTotal($table = 'categories'){
        return parent::getTotal($table);
    }

    public function delete($id, $table = 'categories', $key = 'id'){
        parent::delete($id, $table, $key);
    }

    public static function instance($class = __CLASS__){
        return parent::instance($class);
    }
}