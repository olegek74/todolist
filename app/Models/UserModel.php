<?php

namespace App\Models;
use App\DB;
use App\Model;

class UserModel extends Model
{

    protected static $object;

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
            $query = 'SELECT COUNT(*) AS cnt FROM `managers` WHERE `login` = "' . DB::escape($login) . '" AND `password` = "' . $password . '" LIMIT 1';

            $result = mysqli_fetch_assoc(DB::query($query));
            if ($result['cnt'] == 1) {
                return true;
            }
        }
        return false;
    }

    public function getDubleLogin($login){
        $query = 'SELECT * FROM `managers` WHERE `login` = "'.DB::escape($login).'"';
        if(mysqli_fetch_assoc(DB::query($query))) return true;
        return false;
    }

    public function getDubleEmail($email){
        $query = 'SELECT * FROM `users` WHERE `email` = "'.DB::escape($email).'"';
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

        $query = 'INSERT INTO `users` (`id`, `name`, `email`) VALUES ';
        $query .= '(NULL, "'.DB::escape($data['name']).'", "'.DB::escape($data['email']).'")';
        DB::query($query);
        $user_id = DB::insert_id();
        if($data['manager']){
            $query = 'INSERT INTO `managers` (`user_id`, `login`, `password`) VALUES ';
            $query .= '('.intval($user_id).', "'.DB::escape($data['login']).'", "'.md5($data['password']).'")';
            DB::query($query);
        }
        if($user_id){
            return true;
        }
        return false;
    }

    public function delete($id, $table = 'users'){
        parent::delete($id, $table);
    }

    public static function instance(){
        self::$object = parent::_instance(__CLASS__);
        return self::$object;
    }

}
?>