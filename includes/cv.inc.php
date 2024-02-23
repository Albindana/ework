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

    // Define the path where you want to save the image
    $imageDestination = 'uploads/';

    // Check if the user has uploaded a new image
    if ($imageError === 0) {
        // The user has uploaded a new image
        // Generate a new name for the image
        $imageNameNew = uniqid('', true) . "." . $imageActualExt;
        // Move the uploaded image to the destination
        move_uploaded_file($imageTmpName, '../' . $imageDestination . $imageNameNew);
        $imageDestination .= $imageNameNew;
    } else {
        // The user has not uploaded a new image
        // Fetch the existing image from the database
        $cv = new Cv($userId, $motivationalLetter, $skills, $address, $phoneNumber, $country, $city, $degree, $pImage);
        $existingCv = $cv->getCv();
        $imageDestination = $existingCv['cv_pImage'];
    }

    try {
        $cv = new Cv($userId, $motivationalLetter, $skills, $address, $phoneNumber, $country, $city, $degree, $imageDestination);
        $cv->insertCv();
        echo 'The CV has been updated successfully.';
    } catch (Exception $e) {
        echo 'An error occurred while updating the CV: ' . $e->getMessage();
    }
} else {
    echo 'Error: The form was not submitted correctly.';
}
