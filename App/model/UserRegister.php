<?php


namespace App\model;
// use App\model\ConnectToDb;
use App\model\ConnectToDb;
require_once __DIR__ . "/../../vendor/autoload.php";


class UserRegister extends ConnectToDb {
    private $email ;
    private $password;
    public function __construct($email, $password){
        $this->email = $email;
        $this->passwerd = $password;
    }


    private function user_existance(){
        // we run this to check the user existance in the database if it exists we return true if not it return false 
        $user = $this->email;
        $hpw = password_hash($this->password, PASSWORD_DEFAULT); // this stands for hashed password 
        $query = "SELECT * from user WHERE user.email = $user password =$hpw";
        $stmt = $this->connect()->prepare($query)->execute();
        if($stmt->fecth()->rowCount()>0){
            return true ;
        }else {
            return false ;
        }
    }
    private function set_last_login(){ // updates the last login
        $user = $this->email;
        date_default_timezone_set('Africa/Casablanca'); // we st the time zone 
        $time = date('Y-m-d H:i:s');
        $query = "UPDATE user SET last_login= '$time' WHERE user.email = $user ";
        $stmt = $this->connect()->prepare($query);
        if($stmt->->execute()){
            return true ;
        }else {
            return false ;
        }
    }
    private static function allow(){  // give the premission to the user to sign in 
        $exist = $this->user_existance(); // check the user existance in db
        if($exist===true){
            $this->set_last_login();  // we update the last login 
            $query = "SELECT  user_jwt, username, email,first_name,last_name, telephone, user_type, last_login,  created_at FROM user WHERE user.email= $this->email";
            $stmt = $this->connect()->prepare($query);
            if ($stmt->execute()) {
                $row = $stmt->fetch();
                var_dump($row);
            }
        }

    }
    private static function update_user($jwt, array $newData){
        
    }
     
    private static function delete_user($jwt){
        // this doesnt make a sense bacauce we have a deleted_at row in user table so we gotta set it to the 
        // current time nd just make it denide for acces or smt like that  
        $query = "DELETE user WHERE user.user_jwt=$jwt";
        $stmt = $this->connect()->prepare($query);
        if($stmt->execute()){
            return true;
        }else return false;
    }
}


?>