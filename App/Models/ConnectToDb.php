<?php

namespace App\Models;

class ConnectToDb  {

    protected static function connect(){
        try{
            $host = "localhost";
            $user = "root";
            $pass = "";
            $dbname = "myebag";
            $dsn = "mysql:host=" . $host . ";dbname=" . $dbname . ";port=3306;charset=utf8";
            $db = new \PDO($dsn, $user, $pass);
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (\PDOException $err) {
            echo('ERREUR !!!!!! <br>' . $err->getMessage());
            die();
        }
    }
}