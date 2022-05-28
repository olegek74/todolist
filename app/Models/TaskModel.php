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

       $query = 'INSERT INTO `tasks` (`id`, `description`, `user_id`, `status`) VALUES ';
       $query .= '(NULL, "'.DB::escape($data['description']).'", '.intval($data['user_id']).', '.intval($data['status']).')';
       DB::query($query);
    }

    public static function getTotal($table = 'tasks'){
        return parent::getTotal($table);
    }

    public function getList($list_start = 0, $sort = false, $curr_list_opt = 3){

        $select = 'SELECT t.*, `u`.`email` FROM `tasks` AS `t` LEFT JOIN `users` AS `u` ON `t`.`user_id` = `u`.`id`';
        if($sort == 'asc' || $sort == 'desc'){
            $select .= ' ORDER BY `t`.`status` '.strtoupper($sort).', `t`.`id` ASC';
        }
        else {
            $select .= ' ORDER BY `t`.`id` ASC';
        }
        $select .= ' LIMIT '.$list_start.','.$curr_list_opt;
        return parent::_getList($select);
    }

    public function edit($data){
        $query = 'UPDATE `tasks` SET `description`="'.DB::escape($data['description']).'", `status` = '.intval($data['status']);
        if(isset($data['user_id'])) $query .= ', user_id = '.$data['user_id'];
        $query .= ' WHERE `id` = '.intval($data['task_id']).'';
        DB::query($query);
    }

    public function getOne($id){
        $query = 'SELECT * FROM `tasks` WHERE `id` = '.$id.'';
        $res = DB::query($query);
        $return  = mysqli_fetch_assoc($res);
        return $return;
    }

    public function delete($id, $table = 'tasks'){
        parent::delete($id, $table);
    }

    public static function instance($class = __CLASS__){
        return parent::instance($class);
    }
}
?>