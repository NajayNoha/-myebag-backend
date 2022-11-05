<?php 
// namespace App\model;

use App\model\ConnectToDb;
require_once __DIR__ . "/../../vendor/autoload.php";
class UserLogin extends ConnectToDb {
    protected $username;
    protected $password;
    protected $first_name;
    protected $last_name;
    protected $email;
    protected $telephone;
    protected $user_type;
    protected $user_jwt;
    protected $last_login;
    protected $created_at;
    protected $modified_at;
    protected $deleted_at;
    public function __construct($username, $password,$first_name,$last_name,$email,$telephone,$user_type,$last_login,$created_at,$modified_at,$deleted_at) {
        $this->username = $username;
        $this->password = $password;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->user_type = $user_type;
        $this->last_login = $last_login;
        $this->created_at = $created_at;
        $this->modified_at = $modified_at;
        $this->deleted_at = $deleted_at;
    }

    private static function create(array $data){
        $this->username = $data["username"];
        $this->password = $data["password"];
        $this->first_name = $data["first_name"];
        $this->last_name = $data["last_name"];
        $this->email = $data["email"];
        $this->telephone = $data["telephone"];
        $this->user_type = $data["user_type"];
        // $this->last_login = $data["username"];
        // $this->created_at = $data["username"];
        // $this->modified_at = $data["username"];
        // $this->deleted_at = $data["username"];
        self::return()

    }

    private function generateJwt(){
        $return = false;
        while($return === false){
            $gen = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,rand(8,20));
            // $gen = 'gdlzdleipez';
            $query = "SELECT user_jwt FROM user WHERE user_jwt='$gen'";
            $stmt = $this->connect()->query($query);
            if($stmt->fetch()){
                $return = false;
            }
            else{
                $this->user_jwt = $gen;
                $return = true;
            }
        }
        return $return; 
        
    }
    private function generatePW(){
        $old = $this->password;
        if($new = password_hash($old, PASSWORD_DEFAULT)){
            $this->password = $new;
            return true;
        }
        else {
            return false; 
        }
        
    }

    private function checkemail(){
        $email = $this->email; // check if its a real email 
        if((filter_var($this->email, FILTER_VALIDATE_EMAIL))){
            return true;
        }else return false;
    }

    private function checkemailEx(){
        $email = $this->email; 
        $query = "SELECT * FROM user WHERE email= '$email'";
        if($this->checkemail()===true){
            $stmt = $this->connect()->query($query);
            if($stmt->fetch()){
                return false;
            }else return true ;
        }
    }
    private function set_last_login(){ // updates the last login
        $user = $this->email;
        date_default_timezone_set('Africa/Casablanca'); // we st the time zone 
        $time = date('Y-m-d H:i:s');
        if($stmt->->execute()){
            $this->created_at=$time;
            return true ;
        }else {
            return false ;
        }
    }
    private function createUser(){
        $jwt = $this->generateJwt();
        $pW = $this->generatePW();
        $em = $this->checkemailEx();
        if($jwt===true && $pW===true&& $em ===true ){
            $c ="(username, password,first_name,last_name,email,telephone,user_type,last_login,created_at, user_jwt)";
            $vals = "('$this->username', '$this->password','$this->first_name','$this->last_name','$this->email','$this->telephone',$this->user_type,'$this->created_at','$this->created_at', '$this->user_jwt')";
            $query = "INSERT INTO user $c VALUES $vals";
            $stmt = $this->connect()->prepare($query);
            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
        }
    }

    public function return(){
        if($this->createUser() ===true){
            $query = "SELECT user_jwt, username, email,first_name,last_name ,telephone, user_type, last_login,  created_at FROM user WHERE user.email= '$this->email'";
            $stmt = $this->connect()->prepare($query);
            if ($stmt->execute()) {
                $row = $stmt->fetch();
                var_dump($row);
            }
        }
    }
    // private function 
}


$username='Nohanajy';
$password='N0h4yl4n';
$first_name = "nhayla";
$last_name = 'najay';
$email ='nohayla@gmail.com';
$telephone = '+212777662903';
$user_type= 1;
$last_login='terkk';
$created_at = 'hfcheh';
$modified_at ="erjntgz";
$deleted_at ="efhviorfe";
$obj = new userLogin($username, $password,$first_name,$last_name,$email,$telephone,$user_type,$last_login,$created_at,$modified_at,$deleted_at);
$obj->return();
?>


