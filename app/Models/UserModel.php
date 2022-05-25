<?php

namespace App\Models;
use App\DB;
use App\Model;

class UserModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    private function prepare($login){
        return str_replace(' ', '', $login);
    }

    public function getAuth($login, $password){
        $login = $this->prepare($login);
        if($login) {
            $query = 'SELECT * FROM `managers` WHERE `login` = "' . DB::escape($login) . '" AND `password` = "' . $password . '" LIMIT 1';
            if ($result = mysqli_fetch_assoc(DB::query($query))) {
                return $result;
            }
        }
        return false;
    }

    public function getDubleLogin($login, $id){
        $query = 'SELECT * FROM `managers` WHERE `login` = "'.DB::escape($login).'"';
        if($id) $query .= ' AND `user_id` <> '.$id.'';
        if(mysqli_fetch_assoc(DB::query($query))) return true;
        return false;
    }

    public function getDubleEmail($email, $id){
        $query = 'SELECT * FROM `users` WHERE `email` = "'.DB::escape($email).'"';
        if($id) $query .= ' AND `id` <> '.$id.'';
        if(mysqli_fetch_assoc(DB::query($query))) return true;
        return false;
    }

    public static function getTotal($table = 'users'){
        return parent::getTotal($table);
    }

    public function getList($list_start = 0, $sort = false, $curr_list_opt = 3){

        $select = 'SELECT u.*, u.`id` AS uid, `m`.`login` FROM `users` AS `u` LEFT JOIN `managers` AS `m` ON `m`.`user_id` = `u`.`id`';
        if($sort == 'asc' || $sort == 'desc'){
            $select .= ' ORDER BY `u`.`name` '.strtoupper($sort).', `u`.`id` ASC';
        }
        else {
            $select .= ' ORDER BY `u`.`id` ASC';
        }
        $select .= ' LIMIT '.$list_start.','.$curr_list_opt;
        return parent::_getList($select);
    }

    public function save($data){
        if(!$data['id']) {
            $query = 'INSERT INTO `users` (`id`, `name`, `email`) VALUES ';
            $query .= '(NULL, "' . DB::escape($data['name']) . '", "' . DB::escape($data['email']) . '")';
            DB::query($query);
            $user_id = DB::insert_id();
            if ($data['manager']) {
                $query = 'INSERT INTO `managers` (`user_id`, `login`, `password`) VALUES ';
                $query .= '(' . intval($user_id) . ', "' . DB::escape($data['login']) . '", "' . md5($data['password']) . '")';
                DB::query($query);
            }
            if ($user_id) {
                return true;
            }
        } else {
            $query = 'UPDATE `users` SET `name` = "'.DB::escape($data['name']).'", `email` = "'.DB::escape($data['email']).'"';
            $query .= ' WHERE id = '.$data['id'];
            DB::query($query);
            if($data['manager']){
                $query = 'SELECT * FROM `managers` WHERE `user_id` = '.$data['id'];
                if(mysqli_fetch_assoc(DB::query($query))){
                    $query = 'UPDATE `managers` SET `login` = "'.DB::escape($data['login']).'"';
                    if($data['password']) $query .= ', `password` = "'.md5($data['password']).'"';
                    $query .= ' WHERE `user_id`='.$data['id'];
                }
                else {
                    $query = 'INSERT INTO `managers` (`user_id`, `login`';
                    if($data['password']) $query .= ', `password`';
                    $query .= ') VALUES ('.$data['id'].', "'.DB::escape($data['login']).'"';
                    if($data['password']) $query .= ', "'.md5($data['password']).'"';
                    $query .= ')';
                }
                DB::query($query);
                return true;
            } else {
                DB::query('DELETE FROM `managers` WHERE `user_id`='.$data['id']);
                return true;
            }
        }
        return false;
    }

    public function getUserData($id){
        $query = 'SELECT u.*, m.*, IF(m.`user_id` IS NULL, 0, 1) AS manager FROM `users` AS u LEFT JOIN `managers` AS m ON u.`id` = m.`user_id` WHERE u.`id` = '.$id;
        return mysqli_fetch_assoc(DB::query($query));
    }

    public function delete($id, $table = 'users'){
        parent::delete($id, $table);
    }

    public static function instance($class = __CLASS__){
        return parent::instance($class);
    }

}
?>