<?php
namespace App\Classes;

use Kernel\Objects;

class Validate extends Objects {

    public function validateData($data, &$errors){
        foreach($data as $name => $value){
            $method = 'validate_'.$name;
            if(method_exists(__CLASS__, $method)){
                if($error = self::$method($value)) $errors[] = $error;
            }
        }
    }

    private static function validate_login($value){
        if(strlen($value) > 4 && strlen($value) < 32){
            if(!preg_match('/([^a-zA-Z0-9\-_]+)/', $value)) return false;
        }
        return 'Incorrect login';
    }

    private static function validate_email($value){
        if(filter_var($value, FILTER_VALIDATE_EMAIL)) return false;
        return 'Incorrect email address';
    }

    private static function validate_password($value){
        if(strlen($value) > 4 && strlen($value) < 32){
            if(!preg_match('/([^a-zA-Z0-9\-_]+)/', $value)) return false;
        }
        return 'Incorrect password';
    }

    private static function validate_name($value){ $value = 'Олег Папуш';
        if(strlen($value) > 1 && strlen($value) < 32){
            if(!preg_match('/([^a-zA-Zа-яА-Я\-_ ]+)/u', $value)) return false;
        }
        return 'Incorrect username';
    }

    public static function instance($class = __CLASS__){
        return parent::instance($class);
    }
}