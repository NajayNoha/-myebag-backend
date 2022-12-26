<?php

namespace App\Controllers;
use App\Models\Product;
use App\Models\FeaturedProduct;
use App\Models\Category;
use App\Models\Image;
use App\Models\User;
use Src\Support\Arr;
use App\Controllers\UploadController;


class ProductController
{
    // Output all the products
    public function all() 
    {
        // Grabbing all products with all attributes
        $products = Product::all();
        
        // Looping through each product to collect it's data
        $products = array_map(function ($product) {
            
            // Declaring only attributes we need from db tables
            $product_attributes = ['id', 'desc', 'name', 'price', 'SKU', 'created_at'];

            $category_id = $product['category_id'];

            // Grab only attributes we need from product
            $product = Arr::only($product, $product_attributes);


            // Group everything in result array 
            $product['category'] = self::get_product_category($category_id);
            $product['images'] = self::get_product_images($product['id']);

            return $product;

        }, $products);

        $output = [
            'status' => 'success',
            'products' => $products
        ];

        // Output results
        \print_r(\json_encode($output));
        exit();
    }


    // Return one product's data
    public function one() 
    {
        $id = $_GET['id'] ?? false;

        if ($id == false) {

            print_r(\json_encode([
                'message' => 'id was not provided',
                'status' => 'failed'
            ]));
            
        } else {

            $product = Product::read($id);
            if ($product == false) {

                print(\json_encode([
                    'message' => 'Product not found !',
                    'status' => 'failed'
                ]));
            
            } else {

                // Declaring only attributes we need from db tables
                $product_attributes = ['id', 'desc', 'name', 'price', 'SKU', 'created_at'];
                $category_attributes = ['id', 'name', 'desc'];
                
                $category_id = $product['category_id'];
                $category = Arr::only(Category::read($category_id), $category_attributes);

                $product = Arr::only($product, $product_attributes);


                // Group everything in result array 
                $product['category'] = $category;
                $product['images'] = self::get_product_images($product['id']);

                $output = [
                    'status' => 'success',
                    'product' => $product
                ];

                \print_r(\json_encode($output));
            }
        }

        exit();
    }


    // Create product
    public function create() {
        // Check if post array has all the data
        $check = Arr::has($_POST, ['name', 'desc', 'category_id', 'price']);
        $check = Arr::has($_POST, ['product']);
        $uploaded_images = UploadController::count_uploads();
        if ($uploaded_images == 0 || $uploaded_images > 3) {
            print_r(json_encode(
                [
                    'message' => 'Product needs at least one image !',
                    'status' => 'failed'
                ]
                ));
                return false;
        }
            
        if ($check) {
            $product = json_decode($_POST['product'], true);
            $product['id'] = Product::last_id() + 1;
            $category = self::get_product_category($product['category_id']);
            $product_created = Product::create($product);
            if ($product_created) {
                $imgs = UploadController::save($category['name'], $product['id']);
            }

            $images_created = Image::create($product['id'], $imgs);

            if ($product_created && $images_created) {

                print_r(json_encode(
                    [
                        'message' => 'Product created !',
                        'status' => 'success'
                        ]
                    ));
                exit();
            } else {
                print_r(json_encode(
                    [
                        'message' => 'Product not created !',
                        'status' => 'failed'
                        ]
                    ));
                exit();
            }
            
        } else {
            print_r(json_encode(
                [
                    'message' => 'informations not complete !',
                    'status' => 'failed'
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
                'message' => 'there is no search term provided !',
                'status' => 'failed'
            ]));
            
        } else {

            $products = Product::search($q);
            if ($products == false) {
                print(\json_encode([
                    'message' => 'no product was not found !',
                    'status' => 'failed'
                ]));
            } else {

                $products = array_map(function ($product) {
            
                    // Declaring only attributes we need from db tables
                    $product_attributes = ['id', 'desc', 'name', 'price', 'SKU', 'created_at'];
        
                    $category_id = $product['category_id'];
        
                    // Grab only attributes we need from product
                    $product = Arr::only($product, $product_attributes);
        
        
                    // Group everything in result array 
                    $product['category'] = self::get_product_category($category_id);
                    $product['images'] = self::get_product_images($product['id']);
        
                    return $product;
        
                }, $products);

                $output = [
                    'status' => 'success',
                    'products' => $products
                ];

                \print_r(\json_encode($output));
            }
        }
        
        exit();
    }


    public function get_featured_products() {
        $products = FeaturedProduct::all();

        
        // Grab only attributes we need from product
        
        $products = array_map(function ($product) {

            $product_attributes = ['id', 'desc', 'name', 'price', 'SKU', 'created_at', 'featured_id', 'category', 'images'];

            $product['category'] = self::get_product_category($product['category_id']);
            $product['images']  = self::get_product_images($product['id']);
            $product = Arr::only($product, $product_attributes);
            
            return $product;
        }, $products);

        $hoodies = array_filter($products, function ($product) {
            return $product['category']['id'] == 2;
        });

        $shoes = array_filter($products, function ($product) {
            return $product['category']['id'] == 1;
        });


        $watches = array_filter($products, function ($product) {
            return $product['category']['id'] === '3';
        });

        $output = [];
        $output['status'] = 'success';
        $output['products']['shoes'] = array_values($shoes);
        $output['products']['hoodies'] = array_values($hoodies);
        $output['products']['watches'] = array_values($watches);

        echo json_encode($output);
    }


    public function filter_by_category_id($product, $id) {
        return $product['category_id'] == $id;
    }


    public function get_product_images($id) {

        $images = Image::product($id) ? Image::product($id) : [];

        $arr_images = [];
        for ($i=0; $i < count($images); $i++) { 
            $arr_images[$images[$i]['order_image']] = $images[$i]['link_image'];
        }

        return $arr_images;
    }


    public function get_product_category($id) {
        $category_attributes = ['id', 'name', 'desc'];

        // Grabbing category's id from product
        $category = Arr::only(Category::read($id), $category_attributes);

        return $category;
    }

}