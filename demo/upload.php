<?php

error_reporting(E_ALL);
error_reporting(-1);
ini_set('error_reporting', E_ALL);

function response($data, $statusCode = 200)
{
    echo json_encode($data);
    http_response_code($statusCode);
    die();
}

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check === false) {
        response("File is not an image.", 500);
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    response("Sorry, file already exists.", 500);
    $uploadOk = 0;
}

// Check file size
if ($_FILES["file"]["size"] > 50000000) {
    response("Sorry, your file is too large.", 500);
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    response("Sorry, only JPG, JPEG, PNG & GIF files are allowed.", 500);
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    response("Sorry, your file was not uploaded.", 500);
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        response(basename( $_FILES["file"]["name"]), 201);
    } else {
        response("Sorry, there was an error uploading your file.", 500);
    }
}