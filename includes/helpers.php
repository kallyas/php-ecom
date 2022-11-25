<?php

// helper functions

// upload image and return the image path
function uploadImage($data) {
    error_log('uploadImage');
    $target_dir = "uploads/";
    // check if target directory exists, if not create it
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $target_file = $target_dir . basename($data["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    $check = getimagesize($data["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        $uploadOk = 0;
    }
    // Check file size
    if ($data["size"] > 500000) {
        $uploadOk = 0;
    }
    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        return false;
    } else {
        if (move_uploaded_file($data["tmp_name"], $target_file)) {
            return $target_file;
        } else {
            return false;
        }
    }
}

function base_url($path) {
    $base_url = "http://localhost:8080/";
    return $base_url . $path;
}

function deleteImage($path) {
    if (file_exists($path)) {
        unlink($path);
    }
}