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


    public static function create($product_id,array $images) {
        $images_query = "";

        for($i = 0; $i < count($images); $i++) {
            $image = $images[$i];
            $array = [$product_id, $image, $i + 1];
            $images_query .= mysql_spread_values($array);
            if(count($images) !== $i + 1 ) {
                $images_query .= ",";
            }

        }
        

        $query = "INSERT INTO images(id_product, link_image, order_image) VALUES " . $images_query;

        $stmt = self::connect()->prepare($query);

        return $stmt->execute();
    }

    public static function search($term) {


    }


    public static function update($id, $data) {
        $query = "";
    }


    public static function delete($id) {

    }


}

