<?php 
use App\model\Usermain;
namespace App\controller;


class UserLoginController {
    private static function testEmail($email){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }else {
            return false ;
        }
    }

    private static function testPW($password){
        if(preg_match( '/[0-9]/',$password)&& preg_match( '/[a-zA-Z]/',$password) && strlen($password)>8){
            return true;
        }else {
            return false ;
        }
    }
    public static function test_values(array $d){
        if(self::testEmail($d["email"])===true && self::testPW($d["password"])==true){
            return Usermain::log_user($d);
        }
    }
    public  function home(){
        echo "login !!!  ";
    }

}


echo "login !!!  ";

