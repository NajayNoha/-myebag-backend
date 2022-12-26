<?php

namespace App\Models;
use PDOException;
use Src\Support\Arr;

date_default_timezone_set('Africa/Casablanca'); 

class FeaturedProduct extends ConnectToDb
{

    // featured_id / product_id / category_id
    public static function all(){
        $query = "SELECT * FROM featured_products f JOIN product p ON p.id = f.product_id";
        $result = self::connect()->query($query)->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }


    public static function read($id) {
    }


    public static function create($data) {
    }


    public static function search($term) {

    }


    public static function update($id, $data) {


    }


    public static function delete($id) {

    }


}

