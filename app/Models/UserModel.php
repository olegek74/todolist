<?php

namespace App\Models;
use App\DB;
use App\Objects;

class UserModel extends Objects
{

    protected static $object;

    public function __construct()
    {
        DB::instance();
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


    public function getList(){
        $list = [];
        $query = 'SELECT u.id AS uid, u.*, m.* FROM `users` AS u LEFT JOIN `managers` AS m ON (u.`id` = m.`user_id`)';
        $res = DB::query($query);
        while($row = mysqli_fetch_assoc($res)){
            $list[] = $row;
        }
        return $list;
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

    public static function instance(){
        self::$object = parent::_instance(__CLASS__);
        return self::$object;
    }

}
?>