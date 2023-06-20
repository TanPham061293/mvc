<?php
class Session{
    public static function init(){
        session_start();
    }
    public static function set($element,$value){
        $_SESSION[$element] = $value;
    }
    public static function get($element){
        if (isset($_SESSION[$element])){
            return $_SESSION[$element];
        }
    }
    public static function destroy(){
        session_destroy();
    }
}