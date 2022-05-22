<?php

namespace App\Models;
use App\DB;

class UserModel
{
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
        $query = 'SELECT u.id AS uid, u.*, m.* FROM `users` AS u LEFT JOIN `managers` AS m ON (u.`id` = m.`id`)';
        $res = DB::query($query);
        while($row = mysqli_fetch_assoc($res)){
            $list[] = $row;
        }
        return $list;
    }

}
?>