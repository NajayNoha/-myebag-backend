<?php

namespace App\Models;

date_default_timezone_set('Africa/Casablanca'); 

class User extends ConnectToDb {

    // this class will be resposible for all user moves nd interaction with the database 

    // there will be two parts the register part and the login part 


    // --------------- Register -----------------------------------------------
    private static function generate_jwt(){ 
        //-GENERATING THE JWT WITH SHUFFLE 
        $result = false;
        while($result === false){
            $gen = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,rand(8,20));
            $query = "SELECT user_jwt FROM user WHERE user_jwt='$gen'";
            $stmt = self::connect()->query($query);
            if(!$stmt->fetch()){
                $result = $gen;
            }
        }
        return $result; 
    }
    
    private static function generate_password($old){ 
        //-------------- HASHING THE PASSWORD -----------------------------
        if($new = password_hash($old, PASSWORD_DEFAULT)){
            return $new;
        }else {
            return false; 
        }
    }

    public static function check_email_ex($email){ 
        //-------------------------------- CHECK IF THE EMAIL EXISTS -------------- 
        $query = "SELECT * FROM user WHERE email= '$email'";
        $stmt = self::connect()->query($query);
        if(!empty($stmt->fetchAll())){
                return true;
        }else return false ;
        
    }
    private static function create_user(array $data){  
        //  ------------------- CREATE USER ---------------------------- 
        // we set the time zone 
        $timeN = date('Y-m-d H:i:s');
        $username = 'null';
        $password = $data["password"];
        $first_name = $data["first_name"];
        $last_name = $data["last_name"];
        $email = $data["email"];
        $telephone = 'null';
        $user_type = 2;
        $jwt = self::generate_jwt();
        $pW = self::generate_password($password);
        $em = self::check_email_ex($email);

        if($em===false){
            $c ="(username, password,first_name,last_name,email,telephone,user_type,last_login,created_at, user_jwt)";
            $query = "INSERT INTO user $c VALUES ('$username', '$pW', '$first_name', '$last_name', '$email', '$telephone', '$user_type', '$timeN', '$timeN','$jwt')";
            $stmt = self::connect()->prepare($query);
            if($stmt->execute()){
                return $email;
            }else{
                return false;
            }
        } 
    }
    public static function register_user(array $data){
        $email = self::create_user($data);

        if($email!=false){
            $query = "SELECT user_jwt, username, user_avatar, email,first_name,last_name ,telephone, user_type, last_login,  created_at FROM user WHERE user.email= '$email'";
            $stmt = self::connect()->prepare($query);
            if ($stmt->execute()) {
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                return $row;
            }
        }else {
            return false;
        }
    }

    // -------------------------------------------------------------------------

    // --------------- Login     -----------------------------------------------
    private static function select_user($email){
        $query = "SELECT user_avatar, user_jwt, username, email,first_name,last_name, telephone, user_type, last_login, created_at FROM user WHERE user.email= '$email'";
        $stmt = self::connect()->query($query);
        if ($stmt->execute()) {
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            self::set_last_login($email);  // we update the last login 
            return $row;
        }
    }
    private static function user_existance(array $aut){
        // we run this to check the user existance in the database if it exists we return true if not it return false 
        $user = $aut["email"];
        $psd = $aut['password'];
        // $hpw = password_hash($aut["password"], PASSWORD_DEFAULT); // this stands for hashed password 

        $query = "SELECT password from user WHERE user.email = '$user'";
        $stmt = self::connect()->query($query);
        if(!empty($row = $stmt->fetch())){
            if (password_verify($psd, $row['password'])) {
                return true ;
            }
            else  {
                return false;
            }
        }else {
            return false ;
        }
    }

    
    public static function log_user(array $data){  // give the premission to the user to sign in 
                $exist = self::user_existance($data); // check the user existance in db
                if($exist===true){
                    $user = self::select_user($data['email']);
                    return $user;
                }else return false;
            }


    public static function set_last_login($email){ // updates the last login
        $time = date('Y-m-d H:i:s');
        $query = "UPDATE user SET last_login= '$time' WHERE user.email = '$email' ";
        $stmt = self::connect()->prepare($query);
        if($stmt->execute()){
            return true ;
        }else {
            return false ;
        }
    }

    public static function update_user($jwt, array $newData){
        foreach ($newData as $key => $value) {
            if($key=="password"){
                $pass = password_hash($value, PASSWORD_DEFAULT);
                $query="UPDATE user SET $key='$pass' WHERE user_jwt='$jwt' ";
            }else {
                $query="UPDATE user SET $key='$value' WHERE user_jwt='$jwt' ";
            }
            $stmt = self::connect()->prepare($query);
            if(!$stmt->execute()){
                return json_encode(["status"=>"failde", "data"=>""]);
            }
        }
        $user = self::select_user($newData['email']);
        return $user;
        
    }

    public static function delete_user($email){ 
        $t = date('Y-m-d H:i:s');
        $query = "UPDATE user SET deleted_at='$t' WHERE user.email='$email'";
        $stmt = self::connect()->prepare($query);
        if($stmt->execute()){
            return true;
        }else return false;
    }



    public static function check_is_admin($email, $jwt) {
        $query = "SELECT * FROM user WHERE email= :email AND user_jwt = :jwt AND user_type = 1";
        $stmt = self::connect()->prepare($query);

        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':jwt', $jwt);

        $stmt->execute();

        if(!empty($stmt->fetchAll())){ 
                return true;
                
        } else {
            return false ;
        }
    }
    // -------------------------------------------------------------------------


    // public static function user_register(array $data) {

    // }

    // public function create_user(array $data){
    //     $jwt = $this->generate_jwt();
    //     $pW = $this->generate_password($data['password']);
    //     $em = $this->check_email_ex($data['email']);

    //     if($jwt===true && $pW===true&& $em ===true ){
    //         $c ="(username, password,first_name,last_name,email,telephone,user_type,last_login,created_at, user_jwt)";
    //         $vals = "('$this->username', '$this->password','$this->first_name','$this->last_name','$this->email','$this->telephone',$this->user_type,'$this->created_at','$this->created_at', '$this->user_jwt')";
    //         $query = "INSERT INTO user $c VALUES $vals";
    //         $stmt = $this->connect()->prepare($query);
    //         if($stmt->execute()){
    //             return true;
    //         }else{
    //             return false;
    //         }
    //     }
    // }


}