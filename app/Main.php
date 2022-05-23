<?php
 namespace App;

 defined('ROOTPATH') or die('access denied');

 class Main
 {
     public function handle($array, $name){
         if(isset($array[$name])){
             $value = trim($array[$name]);
             if($value){
                 return $value;
             }
         }
         return false;
     }

     public function getInt($name, $default = 0){
         $value = $this->get($name, $default);
         if($value !== false) return intval($value);
         return $default;
     }

     public function get($name, $default = ''){
         if($value = $this->handle($_GET, $name)) return $value;
         return $default;
     }

     public function post($name, $default = ''){
         if($value = $this->handle($_POST, $name)) return $value;
         return $default;
     }

     public function __call($func, $values){
         if($func == 'getCookie'){
             $name = $values[0];
             $default = isset($values[1]) ? $values[1] : false;
             if($value = $this->handle($_COOKIE, $name)) return $value;
             return $default;
         }
         if($func == 'getSess'){
             $name = $values[0];
             $default = isset($values[1]) ? $values[1] : false;
             if(isset($_SESSION[$name])) return $_SESSION[$name];
             return $default;
         }
         if($func == 'setSess'){
             $name = $values[0];
             $value = $values[1];
             $_SESSION[$name] = $value;
         }
     }
 }
?>