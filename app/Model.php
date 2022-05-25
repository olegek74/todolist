<?php

namespace App;

use App\DB;
use App\Objects;

class Model extends Objects {

    public function __construct()
    {
        DB::instance();
    }

    public static function instance($class){
        return parent::instance($class);
    }

    public static function getTotal($table){
        $query = 'SELECT COUNT(*) AS cnt FROM `'.$table.'`';
        $res = DB::query($query);
        $result = mysqli_fetch_assoc($res);
        return $result['cnt'];
    }

    public function _getList($select){
        $res = DB::query($select);
        $list = [];
        while($row = $res->fetch_assoc()){
            $list[] = $row;
        }
        return $list;
    }

    public function delete($id, $table){
        $query = 'DELETE FROM `'.$table.'` WHERE `id` = '.$id.'';
        $res = DB::query($query);
    }
}