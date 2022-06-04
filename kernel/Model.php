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

    protected function buidSort($select, $sort, $field_def){
        if($sort) list($sort_dir, $sort_by) = explode(':', $sort);
        if(!$sort_dir) $sort_dir = 'asc';
        if(!$sort_by) $sort_by = $field_def;

        if($sort_dir == 'asc' || $sort_dir == 'desc'){
            $order = [$sort_by.' '.strtoupper($sort_dir)];
            if($sort_by != $field_def) $order[] = $field_def.' ASC';
            $select->orderBy($order);
        }
        else {
            $select->orderBy([$field_def.' ASC']);
        }
    }

    public function getFiedListByIds($ids, $table, $field, $key = 'id'){
        $select = self::$queryFactory->newSelect();
        $select->cols([$key, $field])->from($table);
        $select->where($key.' IN ('.implode(',', $ids).')');
        $sth = DB::execute($select);
        $list = $this->get_list($sth);
        $result = [];
        foreach($list as $item){
            $result[$item[$key]] = $item[$field];
        }
        return $result;
    }

    public function delete($id, $table, $key = 'id'){
        $delete = self::$queryFactory->newDelete();
        $delete->from($table)->where($key.' = :'.$key)->bindValue($key, $id);
        DB::execute($delete);
    }

    public function getOne($id, $table){
        $select = self::$queryFactory->newSelect();
        $select->cols(['*'])->from($table)->where('id = :id');
        $select->bindValues(['id'=>$id]);
        $sth = DB::execute($select);
        return $sth->fetch(\PDO::FETCH_ASSOC);
    }
}