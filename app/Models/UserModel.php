<?php

namespace App\Models;
use Kernel\DB;
use Kernel\Model;

class UserModel extends Model
{
    private static $roles = [
        '2' => ['edit', 'delete', 'create'],
        '1' => ['edit'],
        '0' => []
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllow($allow, $role){
        if(in_array($allow, self::$roles[$role])) return true;
        else return false;
    }

    private function prepare($login){
        return str_replace(' ', '', $login);
    }

    public function getAuth($login, $password){
        $login = $this->prepare($login);
        if($login) {
            $select = parent::$queryFactory->newSelect();
            $select->cols(['*'])->from('managers')
                ->where('login = :login')->where('password = :password')
                ->bindValues(['login' => $login, 'password' => md5($password)]);
            $sth = DB::execute($select);
            return $sth->fetch(\PDO::FETCH_ASSOC);
        }
        return false;
    }

    public function getDubleLogin($login, $id){

        $select = parent::$queryFactory->newSelect();
        $select->cols(['*'])->from('managers')->where('login = :login');
        $binds = ['login' => $login];
        if($id){
            $select->where('user_id<>:user_id');
            $binds['user_id'] = $id;
        }
        $select->bindValues($binds);
        $sth = DB::execute($select);
        return $sth->fetch(\PDO::FETCH_ASSOC);
    }

    public function getDubleEmail($email, $id){

        $select = parent::$queryFactory->newSelect();
        $select->cols(['*'])->from('users')->where('email = :email');
        $binds = ['email' => $email];
        if($id){
            $select->where('id<>:id');
            $binds['id'] = $id;
        }
        $select->bindValues($binds);
        $sth = DB::execute($select);
        return $sth->fetch(\PDO::FETCH_ASSOC);
    }

    public static function getTotal($table = 'users'){
        return parent::getTotal($table);
    }

    public function getAll($table = 'users'){
        return parent::getAll($table);
    }

    public function getList($list_start = 0, $sort = false, $curr_list_opt = 3){

        $select = parent::$queryFactory->newSelect();
        $select->cols(['u.*','u.id AS uid','m.login'])->from('users AS u')->join('LEFT','managers AS m','m.user_id = u.id');
        $select->limit($curr_list_opt)->offset($list_start);

        $this->buidSort($select, $sort, 'u.id');

        $sth = DB::execute($select);
        return $this->get_list($sth);
    }

    public function save($data){
        if(!$data['user_id']) {
            $insert = parent::$queryFactory->newInsert();
            $insert->into('users')->cols(['id','name','email'])->bindValues(['id' => NULL,'name' => $data['name'],'email' => $data['email']]);
            DB::execute($insert);
            $user_id = DB::get_insert_id();

            if ($data['manager']) {
                $insert = parent::$queryFactory->newInsert();
                $insert->into('managers')->cols(['user_id','login','password'])->bindValues(['user_id' => $user_id,'login' => $data['login'],'password' =>$data['password']]);
                DB::execute($insert);
            }
            if ($user_id) {
                return true;
            }

        } else {

            $update = parent::$queryFactory->newUpdate();
            $cols = ['name', 'email'];
            $binds = ['name' => $data['name'], 'email' => $data['email']];
            $update->table('users')->cols($cols)->where('id='.$data['user_id']);
            $update->bindValues($binds);
            DB::execute($update);

            if($data['manager']){

                $select = parent::$queryFactory->newSelect();
                $select->cols(['*'])->from('managers')->where('user_id = :user_id')->bindValues(['user_id' => $data['user_id']]);
                $sth = DB::execute($select);
                if($sth->fetch(\PDO::FETCH_ASSOC)){

                    $update = parent::$queryFactory->newUpdate();
                    $cols = ['login'];
                    $binds = ['login' => $data['login']];
                    if($data['password']){
                        $cols[] = 'password';
                        $binds['password'] = $data['password'];
                    }
                    $update->table('managers')->cols($cols)->where('user_id='.$data['user_id']);
                    $update->bindValues($binds);
                    DB::execute($update);

                }
                else {

                    $insert = parent::$queryFactory->newInsert();
                    $cols = ['user_id','login'];
                    $binds = ['user_id' => $data['user_id'], 'login' => $data['login']];
                    if($data['password']){
                        $cols[] = 'password';
                        $binds['password'] = $data['password'];
                    }
                    $insert->into('managers')->cols($cols)->bindValues($binds);
                    DB::execute($insert);
                }
                return true;
            } else {
                $this->delete($data['user_id'], 'managers', 'user_id');
                return true;
            }
        }
        return false;
    }

    public function getUserData($id){
        if($id) {
            $select = parent::$queryFactory->newSelect();
            $select->cols(['u.*', 'u.id', 'm.*', 'IF(m.user_id IS NULL, 0, 1) AS manager']);
            $select->from('users AS u')->join('LEFT', 'managers AS m', 'u.id = m.user_id');
            $select->where('u.id=' . $id);
            $sth = DB::execute($select);
            return $sth->fetch(\PDO::FETCH_ASSOC);
        }
        return [];
    }

    public function delete($id, $table = 'users', $key = 'id'){
        parent::delete($id, $table, $key);
    }

    public static function instance($class = __CLASS__){
        return parent::instance($class);
    }

}
?>