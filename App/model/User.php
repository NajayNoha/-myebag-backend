<?php 
// namespace App\model;

// use App\model\ConnectToDb;
// require_once __DIR__ . "/../../vendor/autoload.php";
// class User extends ConnectToDb {
//     protected $username;
//     protected $password;
//     protected $first_name;
//     protected $last_name;
//     protected $email;
//     protected $telephone;
//     protected $user_type;
//     protected $user_jwt;
//     protected $last_login;
//     protected $created_at;
//     protected $modified_at;
//     protected $deleted_at;

//     private function generate_jwt(){ //----------------------- GENERATING THE JWT WITH SHFFLE ---------------
//         $return = false;
//         while($return === false){
//             $gen = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,rand(8,20));
//             // $gen = 'gdlzdleipez';
//             $query = "SELECT user_jwt FROM user WHERE user_jwt='$gen'";
//             $stmt = $this->connect()->query($query);
//             if($stmt->fetch()){
//                 $return = false;
//             }else{
//                 $this->user_jwt = $gen;
//                 $return = true;
//             }
//         }
//         return $return; 
//     }
//     private function generate_password(){ //-------------- HASHING THE PASSWORD -----------------------------
//         $old = $this->password;
//         if($new = password_hash($old, PASSWORD_DEFAULT)){
//             $this->password = $new;
//             return true;
//         }else {
//             return false; 
//         }
//     }
//     private function check_email_ex(){ //-------------------------------- CHECK IF THE EMAIL EXISTS --------------
//         $email = $this->email; 
//         $query = "SELECT * FROM user WHERE email= '$email'";
//         if($this->checkemail()===true){
//             $stmt = $this->connect()->query($query);
//             if($stmt->fetch()){
//                 return false;
//             }else return true ;
//         }
//     }
//     private function user_existance(){
//         // we run this to check the user existance in the database if it exists we return true if not it return false 
//         $user = $this->email;
//         $hpw = password_hash($this->password, PASSWORD_DEFAULT); // this stands for hashed password 
//         $query = "SELECT * from user WHERE user.email = '$user' AND password = '$hpw'";
//         $stmt = $this->connect()->prepare($query)->execute();
//         if($stmt->fecth()->rowCount()>0){
//             return true ;
//         }else {
//             return false ;
//         }
//     }
//     private function set_last_login(){ // updates the last login
//         $user = $this->email;
//         date_default_timezone_set('Africa/Casablanca'); // we st the time zone 
//         $time = date('Y-m-d H:i:s');
//         $query = "UPDATE user SET last_login= '$time' WHERE user.email = $user ";
//         $stmt = $this->connect()->prepare($query);
//         if($stmt->execute()){
//             $this->created_at=$time;
//             return true ;
//         }else {
//             return false ;
//         }
//     }
//     private static function log_user(){  // give the premission to the user to sign in 
//         $exist = $this->user_existance(); // check the user existance in db
//         if($exist===true){
//             $this->set_last_login();  // we update the last login 
//             $query = "SELECT user_jwt, username, email,first_name,last_name, telephone, user_type, last_login,  created_at FROM user WHERE user.email= $this->email";
//             $stmt = $this->connect()->prepare($query);
//             if ($stmt->execute()) {
//                 $row = $stmt->fetch();
//                 var_dump($row);
//             }
//         }
//     }
//     private function create_user(){  //  ------------------- CREATE USER ---------------------------- 
//         $jwt = $this->generate_jwt();
//         $pW = $this->generate_password();
//         $em = $this->check_email_ex();
//         $this->set_last_login(); 
//         if($jwt===true && $pW===true&& $em ===true ){
//             $c ="(username, password,first_name,last_name,email,telephone,user_type,last_login,created_at, user_jwt)";
//             $vals = "('$this->username', '$this->password','$this->first_name','$this->last_name','$this->email','$this->telephone',$this->user_type,'$this->created_at','$this->created_at', '$this->user_jwt')";
//             $query = "INSERT INTO user $c VALUES $vals";
//             $stmt = $this->connect()->prepare($query);
//             if($stmt->execute()){
//                 return true;
//             }else{
//                 return false;
//             }
//         }
//     }

//     public static function json_obj(){
//         if($this->create_user() ===true){
//             $query = "SELECT user_jwt, username, email,first_name,last_name ,telephone, user_type, last_login,  created_at FROM user WHERE user.email= '$this->email'";
//             $stmt = $this->connect()->prepare($query);
//             if ($stmt->execute()) {
//                 $row = $stmt->fetch();
//                 var_dump($row);
//             }
//         }
//     }
//     private static function register(array $data){
//         $this->username = $data["username"];
//         $this->password = $data["password"];
//         $this->first_name = $data["first_name"];
//         $this->last_name = $data["last_name"];
//         $this->email = $data["email"];
//         $this->telephone = $data["telephone"];
//         $this->user_type = $data["user_type"];
//         // $this->last_login = $data["username"];
//         // $this->created_at = $data["username"];
//         // $this->modified_at = $data["username"];
//         // $this->deleted_at = $data["username"];
//         self::json_obj()

//     }

//     public static function json_obj(){
//         if($this->create_user() ===true){
//             $query = "SELECT user_jwt, username, email,first_name,last_name ,telephone, user_type, last_login,  created_at FROM user WHERE user.email= '$this->email'";
//             $stmt = $this->connect()->prepare($query);
//             if ($stmt->execute()) {
//                 $row = $stmt->fetch();
//                 var_dump($row);
//             }
//         }
//     }
//     private static function login(array $data){
//         $this->email = $data["email"];
//         $this->password = $data["password"];
//         self::json_obj()
//     }
//     // private function 
// }


// $username='Nohanajy';
// $password='N0h4yl4n';
// $first_name = "nhayla";
// $last_name = 'najay';
// $email ='nohayla@gmail.com';
// $telephone = '+212777662903';
// $user_type= 1;
// $last_login='terkk';
// $created_at = 'hfcheh';
// $modified_at ="erjntgz";
// $deleted_at ="efhviorfe";
// $obj = new userLogin($username, $password,$first_name,$last_name,$email,$telephone,$user_type,$last_login,$created_at,$modified_at,$deleted_at);
// $obj->return();


$val = "iuooou, oyyoii, iuopppppo, yuuujkjj,";
$ex = explode("," ,$val);
var_dump($val);
$sub= rtrim($val, ',');
echo"<pre>";
// var_dump(end($ex));
var_dump($sub);
echo"</pre>";


// ?>


