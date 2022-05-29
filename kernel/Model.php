<?php

namespace Kernel;

use Kernel\DB;
use Kernel\Objects;

class Model extends Objects {

    protected static $queryFactory;

    public function __construct()
    {
        self::$queryFactory = DB::createFactory();
    }

    public static function instance($class){
        return parent::instance($class);
    }

    public static function getTotal($table){
        self::$queryFactory = DB::createFactory();
        $select = self::$queryFactory->newSelect();
        $select->cols(['COUNT(*) AS cnt'])->from($table);
        $sth = DB::execute($select);
        $result = $sth->fetch(\PDO::FETCH_ASSOC);
        return $result['cnt'];
    }

    public function get_list($sth){
        $list = [];
        while($result = $sth->fetch(\PDO::FETCH_ASSOC)){
            $list[] = $result;
        }
        return $list;
    }

    public function delete($id, $table, $key = 'id'){
        $delete = self::$queryFactory->newDelete();
        $delete->from($table)->where($key.' = :'.$key)->bindValue($key, $id);
        DB::execute($delete);
    }
}