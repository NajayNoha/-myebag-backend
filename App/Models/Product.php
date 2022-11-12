<?php

namespace App\Models;
// use App\Models\Db;
use Src\Support\Arr;

class Product extends ConnectToDb
{

    public static function all(){
        $query = "SELECT * FROM product";
        $result = self::connect()->query($query)->fetchAll();

        return $result;
    }


    public static function read($id) {
        $query = "SELECT * FROM product WhERE id = :id";
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
        $attributes_arr = ['name', 'desc', 'SKU', 'category_id', 'inventory_id', 'price','discount_id', 'created_at'];

        $data['created_at'] = '2022-11-2';

        $attributes = mysql_spread($attributes_arr);
        $data_values = mysql_spread(Arr::only($data, $attributes_arr));

        $query = "INSERT INTO product " . $attributes . " VALUES " . $data_values;

        return $query;
    }


    public static function search($term) {
        $query = "SELECT * FROM product WHERE product.name LIKE :term";
        $term = "%".$term."%";
        $stmt = self::connect()->prepare($query);
        $stmt->bindParam(':term', $term);

        if($stmt->execute()) {
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } else {
            return false;
        }


    }


    public static function update($id, $data) {
        $query = "";
    }


    public static function delete($id) {

    }


}

