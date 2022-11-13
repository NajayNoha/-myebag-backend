<?php

namespace App\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Image;
use App\Models\User;
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


    // Create product
    public function create() {
        // Check if post array has all the data
        $check = Arr::has($_POST, ['name', 'desc', 'category_id', 'inventory_id', 'price', 'discount_id']);
            
        if ($check) {
            $data = [
                'name' => $_POST['name'],
                'desc' => $_POST['desc'],
                'category_id' => $_POST['category_id'],
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


    public function update() {
        $check = Arr::has($_POST, ['id', 'email', 'user_jwt']);
        $data = [];

        $response = [
            "message" => "invalid data !",
            "status" => "failed"
        ];
        
        if ($check && $_POST['id'] != '') {

            $email = $_POST['email'];
            $token = $_POST['user_jwt'];

            if (!User::check_is_admin($email, $token)) {
                $response = [
                    "message" => "You don't have access to this route",
                    "status"  => "failed"
                ];

            } else {

                $id = $_POST['id'];
                $response = [
                    "message" => "Modifications are done !",
                    "status"  => "success"
                ];


                // Grab all the changed data from post array
                isset($_POST['name']) ? array_push($data, 'name') : '';
                isset($_POST['desc']) ? array_push($data, 'desc') : '';
                isset($_POST['category_id']) ? array_push($data, 'category_id') : '';
                isset($_POST['price']) ? array_push($data, 'price') : '';
                isset($_POST['discount_id']) ? array_push($data, 'discount_id') : '';

                $response = Product::update($id, Arr::only($_POST, $data));



            }

        
        }


        print_r(json_encode($response));
        exit();
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