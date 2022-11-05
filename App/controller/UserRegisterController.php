<?php 
use App\model\Usermain;
namespace App\controller;
class UserRegisterController {
    private static function testEmail($em){
        if(filter_var($em, FILTER_VALIDATE_EMAIL)){
            return true;
        }else {
            return false ;
        }
    }
    private static function testName(array $d){
        if(preg_match( '/[0-9]/',$d["first_name"])&&preg_match( '/[0-9]/',$d["last_name"])){
            return false;
        }else {
            return true ;
        }
    }
    private static function testPW($password){
        if(preg_match( '/[0-9]/',$password)|| preg_match( '/[a-zA-Z]/',$password) && strlen($password)>8){
            return true;
        }else {
            return false ;
        }
    }
    private static function testTel($tel){
        if(preg_match( '/\+212[0-9]{9}/',$tel) || preg_match( '/0[0-9]{9}/',$tel)){
            return true;
        }else {
            return false ;
        }
    }
    public static function test_general(array $d){
        if(self::testPW($d["password"])===true && self::testName($d)===true  && self::testEmail($d["email"])===true&& self::testTel($d["telephone"])===true){//
            $register = Usermain::user_register($d);
            return $register
        }else {
            return false;
        }
    }
    public static function call(){
        $d=[];
        if(isset($_POST['username'])&&isset($_POST['email'])&&isset($_POST['first_name'])&&isset($_POST['last_name'])&&isset($_POST['password'])&&isset($_POST['telephone'])&&isset($_POST['user_type'])){
           $d["username"]=$_POST["username"];
           $d['email']=$_POST['email'];
           $d['first_name']=$_POST['first_name'];
           $d['last_name']=$_POST['last_name'];
           $d['password']=$_POST['password'];
           $d['telephone']=$_POST['telephone']
           $d['user_type']=$_POST['user_type']
        }
        $test = self::test_general($d);
        if($test!=false){
            return $test;
        }else {
            return false;
        }
    }
}

// $data =[
//     "username"=>"NNoha",
//     "email"=>"naja@gmail.com",
//     "first_name"=>"nohayla",
//     "last_name"=>"najay",
//     "password"=>"N0h4yl4",
//     "telephone"=>"+2127363533",
//     "user_type"=>1
// ]

