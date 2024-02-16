<?php
// cv.inc.php
session_start();
include_once '../classes/dbh.classes.php';
require_once '../classes/cv.classes.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the necessary variables are set
    if (!isset($_SESSION["userid"])) {
        echo 'Error: Necessary variables are not set.';
        exit();
    }

    // Fetch all the data from the form
    $userId = $_SESSION["userid"];
    $motivationalLetter = $_POST['cv_motivationalLetter'];
    $skills = $_POST['cv_skills'];
    $address = $_POST['cv_address'];
    $phoneNumber = $_POST['cv_phoneNumber'];
    $country = $_POST['cv_country'];
    $city = $_POST['cv_city'];
    $degree = $_POST['cv_degree'];
    $pImage = $_FILES['cv_pImage']; // Use $_FILES for file uploads

    // Handle the file upload
    $imageName = $pImage['name'];
    $imageTmpName = $pImage['tmp_name'];
    $imageSize = $pImage['size'];
    $imageError = $pImage['error'];
    $imageType = $pImage['type'];

    // Get the image extension
    $imageExt = explode('.', $imageName);
    $imageActualExt = strtolower(end($imageExt));

    // Check if the image upload was successful
    if ($imageError !== 0) {
        echo 'Error: File upload failed with error code ' . $imageError;
        exit();
    }

    // You may also want to check if the file is an image and restrict the file size

    // Generate a new name for the image to avoid overwriting existing images
    $imageNameNew = uniqid('', true) . "." . $imageActualExt;

    // Define the path where you want to save the image
    $imageDestination = 'uploads/' . $imageNameNew;

    // Move the uploaded image to the destination
    move_uploaded_file($imageTmpName, '../' . $imageDestination);

    try {
        $cv = new Cv($userId, $motivationalLetter, $skills, $address, $phoneNumber, $country, $city, $degree, $imageDestination);
        $cv->insertCv();
        echo 'The CV has been created successfully.';
    } catch (Exception $e) {
        echo 'An error occurred while creating the CV: ' . $e->getMessage();
    }
} else {
    echo 'Error: The form was not submitted correctly.';
}

