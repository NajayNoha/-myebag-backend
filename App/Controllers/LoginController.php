<?php

namespace App\Controllers;
use App\Models\User;
use Src\Support\Arr;

class LoginController {


    public  function login(){
        $check = Arr::has($_POST, ['email', 'password']);

        if (!$check) {
            print_r(json_encode([
                "message" => "email and password are required."
            ]));
            die();
        } else {
            $email = $_POST['email'];
            $password = $_POST['password'];

            if (self::testEmail($email)) {

                $user = User::log_user( 
                    [
                        "email" => $email,
                        "password" => $password
                        ]
                    );

                if ($user == false) {
                    print_r(json_encode([
                        'message' => "Email or Password are incorrect.",
                        "status" => "failed"
                    ]));
                    die();
                } else {

                    $output['user'] = $user; 

                    $output['status'] = "success";
                    print_r(json_encode($output));
                    die();
                }

            } else {
                print_r(json_encode([
                    'message' => "Email or Password are invalid.",
                    'status'  => "failed"
                ]));
                die();
            }
        }
    }


    public function check_email() {
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
            $result = false;
            if (self::testEmail($email)) {
                $result = User::check_email_ex($email);
            }

            $result = $result ? "exist" : "not exist";

            print_r(json_encode([
                "message" => $result
            ]));
        } else {
            print_r(json_encode([
                "message" => "email is not set"
            ]));
        }
    }


    public static function is_admin() {
        $email = 'yassine@gmail.com';
        $jwt = 'CPZ9TXFIW6Y07JL5D';
        $check = User::check_is_admin($email, $jwt);

        echo $check ? "you got access" : "you dont have access";
    }


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
            return User::log_user($d);
        }
    }

}