<?php

namespace App\Controllers;

class UploadController
{
    public function save() 
    {

        // Count total files
        $countFiles = count($_FILES['files']['name']);

        // mkdir(base_path() . 'images/products/');
        // Upload location
        $location = base_path() . 'images/products/';

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
                    $path = $location.$filename;

                    // Upload file
                    if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $path)) {
                        $files_arr[] = $path; 
                    }
                }
            }
        }
        print_r($_POST);
        print_r(json_encode($files_arr));
    }
}