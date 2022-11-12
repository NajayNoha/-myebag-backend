<?php

namespace App\Models;
use App\Models\Db;
use Src\Support\Arr;

class Category extends ConnectToDb
{

    public static function all(){
        $query = "SELECT * FROM product_category";
        $result = self::connect()->query($query)->fetchAll();

        return $result;
    }


    public static function read($id) {
        $query = "SELECT *  FROM product_category WhERE id = :id";
        $stmt = self::connect()->prepare($query);
        $stmt->bindParam(':id', $id);

        if($stmt->execute()) {
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $result;
        } else {
            return false;
        }
    }


    public static function create(array $data) {
        $query = "";
        

    }

    public static function search($term) {


    }


    public static function update($id, $data) {
        $query = "";
    }


    public static function delete($id) {

    }


}

