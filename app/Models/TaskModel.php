<?php

namespace App\Models;
use Kernel\DB;
use Kernel\Model;


class TaskModel extends Model
{
    private static $roles = [
        '1' => ['edit', 'delete', 'create'],
        '0' => ['edit']
    ];

    public function getAllow($action, $role){
        if(in_array($action, self::$roles[$role])) return true;
        else return false;
    }

    public function __construct()
    {
        parent::__construct();
    }

    public function create($data) {

        $insert = parent::$queryFactory->newInsert();
        $insert->into('tasks')->cols(['id','description','user_id','status'])
            ->bindValues([
                'id' => NULL,
                'description' => $data['description'],
                'user_id' => $data['user_id'],
                'status' => $data['status']
            ]);

        $sth = DB::execute($insert);
    }

    public static function getTotal($table = 'tasks'){
        return parent::getTotal($table);
    }

    public function getList($list_start = 0, $sort = false, $curr_list_opt = 3){

        $select = parent::$queryFactory->newSelect();
        $select->cols(['t.*', 'u.email'])->from('tasks AS t')->join('LEFT', 'users AS u', 't.user_id = u.id');
        $select->limit($curr_list_opt)->offset($list_start);
        if($sort == 'asc' || $sort == 'desc'){
            $select->orderBy(['t.status '.strtoupper($sort), 't.id ASC']);
        }
        else {
            $select->orderBy(['t.id ASC']);
        }
        $sth = DB::execute($select);
        return $this->get_list($sth);
    }

    public function edit($data){

        $update = parent::$queryFactory->newUpdate();
        $cols = ['description', 'status'];
        $binds = ['description' => $data['description'], 'status' => $data['status']];
        if(isset($data['user_id'])) {
            $binds['user_id'] = $data['user_id'];
            $cols[] = 'user_id';
        }
        $update->table('tasks')->cols($cols)->where('id='.$data['task_id']);
        $update->bindValues($binds);
        DB::execute($update);
    }

    public function getOne($id){
        $select = parent::$queryFactory->newSelect();
        $select->cols(['*'])->from('tasks')->where('id = :id');
        $select->bindValues(['id'=>$id]);
        $sth = DB::execute($select);
        return $sth->fetch(\PDO::FETCH_ASSOC);
    }

    public function delete($id, $table = 'tasks', $key = 'id'){
        parent::delete($id, $table, $key);
    }

    public static function instance($class = __CLASS__){
        return parent::instance($class);
    }
}
?>