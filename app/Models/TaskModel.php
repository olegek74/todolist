<?php

namespace App\Models;
use App\DB;
use App\Objects;

class TaskModel extends Objects
{

    protected static $object;

    public function __construct()
    {
        DB::instance();
    }

    public function addNew($data) {

       $query = 'INSERT INTO `tasks` (`id`, `description`, `user_id`, `status`) VALUES ';
       $query .= '(NULL, "'.DB::escape($data['description']).'", '.intval($data['user_id']).', '.intval($data['status']).')';
       DB::query($query);
    }

    public static function getTotal(){
        $query = 'SELECT COUNT(*) AS cnt FROM `tasks`';
        $res = DB::query($query);
        $result = mysqli_fetch_assoc($res);
        $count = $result['cnt'];
        return $count;
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
        $res = DB::query($select);
        $list = [];
        while($row = $res->fetch_assoc()){
            $list[] = $row;
        }
        return $list;
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

    public function delete($id){
        $query = 'DELETE FROM `tasks` WHERE `id` = '.$id.'';
        $res = DB::query($query);
    }

    public static function instance(){
        self::$object = parent::_instance(__CLASS__);
        return self::$object;
    }
}
?>