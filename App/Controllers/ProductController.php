<?php

namespace App\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Image;
use Src\Support\Arr;


class ProductController
{
    // Output all the products
    public function all() 
    {
        // Grabbing all products with all attributes
        $products = Product::all();
        
        // Looping through each product to collect it's data
        $products = array_map(function ($arr) {
            
            // Declaring only attributes we need from db tables
            $product_attributes = ['id', 'name', 'price', 'SKU'];
            $category_attributes = ['id', 'name', 'desc'];


            // Grabbing category's id from product
            $category_id = $arr['category_id'];
            $category = Arr::only(Category::read($category_id), $category_attributes);

            // Grab only attributes we need from product
            $arr = Arr::only($arr, $product_attributes);

            // fetching product images
            $images = Image::product($arr['id']) ? Image::product($arr['id']) : [];

            // Ordering images by their order number
            $arr_images = [];
            for ($i=0; $i < count($images); $i++) { 
                $arr_images[$images[$i]['order_image']] = $images[$i]['link_image'];
            }

            // Group everything in result array 
            $arr['category'] = $category;
            $arr['images'] = $arr_images;

            return $arr;

        }, $products);


        // Output results
        \print_r(\json_encode($products));
        exit();
    }


    // Return one product's data
    public function one() 
    {
        $id = $_GET['id'] ?? false;

        if ($id == false) {
            print_r(\json_encode([
                'message' => 'id was not provided'
            ]));
            
        } else {

            $product = Product::read($id);
            
            if ($product == false) {

                print(\json_encode([
                    'message' => 'Product was not found !'
                ]));
            
            } else {
                \print_r(\json_encode($product));
            }
        }

        exit();
    }


    public function create() {
        $check = Arr::has($_POST, ['name', 'desc', 'SKU', 'category_id', 'inventory_id', 'price', 'discount_id']);
            
        if ($check) {
            $data = [
                'name' => $_POST['name'],
                'desc' => $_POST['desc'],
                'SKU' => $_POST['SKU'],
                'category_id' => $_POST['category_id'],
                'inventory_id' => $_POST['inventory_id'],
                'price' => $_POST['price'],
                'discount_id' => $_POST['discount_id']
            ];
            print_r(Product::create($data));
        } else {
            print_r(json_encode(
                [
                    'message' => 'informations not complete !'
                ]
            ));

        }
    }


    public function search() {
        $q = $_GET['q'] ?? false;

        if ($q == false) {
            print_r(\json_encode([
                'message' => 'there is no search term provided !'
            ]));
            
        } else {

            $products = Product::search($q);
            if ($products == false) {
                print(\json_encode([
                    'message' => 'no product was not found !'
                ]));
            } else {
                \print_r(\json_encode($products));
            }
        }
        
        exit();
    }

}