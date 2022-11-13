<?php

namespace App\Models;
use PDOException;
use Src\Support\Arr;

date_default_timezone_set('Africa/Casablanca'); 

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
        $attributes_arr = ['name', 'desc', 'SKU', 'category_id', 'price','discount_id', 'created_at'];

        $data['created_at'] = date('Y-m-d H:i:s');

        $attributes = mysql_spread($attributes_arr);

        $query = "INSERT INTO product " . $attributes . " VALUES (:name, :desc, :SKU, :category_id, :price, :discount_id, :created_at)";
        $stmt = self::connect()->prepare($query);

        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':desc', $data['desc']);
        $stmt->bindParam(':SKU', $data['SKU']);
        $stmt->bindParam(':category_id', $data['category_id']);
        $stmt->bindParam(':price', $data['price']);
        $stmt->bindParam(':discount_id', $data['discount_id']);
        $stmt->bindParam(':created_at', $data['created_at']);

        try {

            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
            
            return $query;
        } catch (PDOException $e) {
            return false;
        }
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

        $data['modified_at'] = date('Y-m-d H:i:s');

        // $attributes = mysql_spread($attributes_arr);

        $q = [];

        foreach ($data as $key => $value) {
            $str = "" . $key . " = '" . $value . "'";
            array_push($q, $str);
        }

        $query_data = implode(' AND ', $q);

        $query = "UPDATE product  SET " . $query_data . " WHERE id = :id";
        $stmt = self::connect()->prepare($query);

        $stmt->bindParam(':id', $id);

        try {
            if($stmt->execute()) {
                return $query . $id;
            } else {
                return false;
            }
            
            return $query;
        } catch (PDOException $e) {
            return false;
        }

    }


    public static function delete($id) {

    }


}

