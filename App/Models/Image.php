<?php

namespace App\Models;
// use App\Models\Db;
use Src\Support\Arr;

class Image extends ConnectToDb
{

    public static function all(){
        $query = "SELECT * FROM product";
        $result = self::connect()->query($query)->fetchAll();

        return $result;
    }


    // returns all images related to a product passed in parametre
    public static function product($id) {
        $query = "SELECT *  FROM images WHERE id_product = :id GROUP BY order_image";
        $stmt = self::connect()->prepare($query);
        $stmt->bindParam(':id', $id);


        if($stmt->execute()) {
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

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

