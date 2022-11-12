<?php

namespace App\Controllers;

use App\Models\User;
use Src\Support\Arr;

class SignupController
{
    private static function testEmail($em)
    {
        if (filter_var($em, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }


    private static function testName(array $d)
    {
        if (preg_match('/[0-9]/', $d["first_name"]) && preg_match('/[0-9]/', $d["last_name"])) {
            return false;
        } else {
            return true;
        }
    }


    private static function testPW($password)
    {
        if (preg_match('/[0-9]/', $password) || preg_match('/[a-zA-Z]/', $password) && strlen($password) > 8) {
            return true;
        } else {
            return false;
        }
    }

    
    private static function testTel($tel)
    {
        if (preg_match('/\+212[0-9]{9}/', $tel) || preg_match('/0[0-9]{9}/', $tel)) {
            return true;
        } else {
            return false;
        }
    }
    public static function test_general(array $d)
    {
        if (self::testName($d) === true  && self::testEmail($d["email"]) === true) { //
            return true;
        } else {
            return false;
        }
    }
    public static function signup()
    {
        $attributes = ['email', 'first_name', 'last_name', 'password'];
        $data = [];
        if (Arr::has($_POST, $attributes)) {
            // $data["username"] = $_POST["username"];
            $data['email'] = $_POST['email'];
            $data['first_name'] = $_POST['first_name'];
            $data['last_name'] = $_POST['last_name'];
            $data['password'] = $_POST['password'];
            // $data['telephone'] = $_POST['telephone'];
            // $data['user_type'] = $_POST['user_type'];
            $test = self::test_general($data);

            if ($test != false) {

                $result = User::register_user($data);

                if ($result == false) {
                    $message = [
                        "message" => "email already exists",
                        "status" => "failed" 
                    ];
        
                    print_r(json_encode($message));
                    die();
                } else {
                    $result['status'] = "success";
                    $result = json_encode($result);
        
                    print_r($result);
                    die();
                }

            } else {
                $message = [
                    "message" => "invalid informations",
                    "status" => "failed" 
                ];
    
                print_r(json_encode($message));
                die();
            }
        } else {
            $message = [
                "message" => "invalid informations",
                "status" => "failed"
            ];

            print_r(json_encode($message));
            die();
        }
    }
}
