<?php

namespace App\Controllers;

use Directory;

class UploadController
{
    public static function save($category, $product_id, $limit = 3) 
    {

        // Count total files
        $countFiles = count($_FILES['files']['name']);

        if ($countFiles > $limit) return false;

        $path_check = '/images/products/' . $category . '/' . $product_id . '/';

        if(!is_dir($path_check)) {
            mkdir(base_path() . $path_check);
        } 
        // Upload location
        $location = base_path() . 'images/products/' . $category . '/' . $product_id . '/';

        // To store uploaded files path
        $files_arr = [];

        // Loop all files
        for ($i = 0; $i < $countFiles; $i++) {

            if (isset($_FILES['files']['name'][$i]) && $_FILES['files']['name'][$i] != '') {

                // File name
                $filename = $_FILES['files']['name'][$i];

                // Get extension
                $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                // Valid image extension
                $valid_ext = ['jpg', 'jpeg', 'png', 'webp'];

                // Check extension
                if (in_array($ext, $valid_ext)) {
                    // File path
                    $path = $location.($i + 1).'.'.$ext;
                    // Upload file
                    if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $path)) {
                        $files_arr[] = $path_check . ( $i + 1 ) . '.' . $ext; 
                    }
                }
            }
        }

        // return array with all images's path
        return $files_arr;
    }

    public static function count_uploads() {
        if(!isset($_FILES['files'])) {
            return 0;
        }
        return count($_FILES['files']['name']);
    }
}