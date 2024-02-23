<?php
session_start();
include_once '../classes/dbh.classes.php';
require_once '../classes/cv.classes.php';
require_once '../classes/cv-controller.classes.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_SESSION["userid"])) {
        echo 'Error: Necessary variables are not set.';
        exit();
    }

    $userId = $_SESSION["userid"];
    $motivationalLetter = $_POST['cv_motivationalLetter'];
    $skills = $_POST['cv_skills'];
    $address = $_POST['cv_address'];
    $phoneNumber = $_POST['cv_phoneNumber'];
    $country = $_POST['cv_country'];
    $city = $_POST['cv_city'];
    $degree = $_POST['cv_degree'];
    $pImage = $_FILES['cv_pImage'];

    $imageName = $pImage['name'];
    $imageTmpName = $pImage['tmp_name'];
    $imageSize = $pImage['size'];
    $imageError = $pImage['error'];
    $imageType = $pImage['type'];

    $imageExt = explode('.', $imageName);
    $imageActualExt = strtolower(end($imageExt));

    $imageDestination = 'uploads/';

    if ($imageError === 0) {
        $imageNameNew = uniqid('', true) . "." . $imageActualExt;
        move_uploaded_file($imageTmpName, '../' . $imageDestination . $imageNameNew);
        $imageDestination .= $imageNameNew;
    } else {
        $cv = new Cv($userId, $motivationalLetter, $skills, $address, $phoneNumber, $country, $city, $degree, $pImage);
        $existingCv = $cv->getCv();
        $imageDestination = $existingCv['cv_pImage'];
    }

    try {
        $cv = new CvContr($userId, $motivationalLetter, $skills, $address, $phoneNumber, $country, $city, $degree, $imageDestination); // Use CvContr instead of Cv
        $cv->createOrUpdateCv(); // Use createOrUpdateCv instead of insertCv
        echo 'The CV has been updated successfully.';
    } catch (Exception $e) {
        echo 'An error occurred while updating the CV: ' . $e->getMessage();
    }
} else {
    echo 'Error: The form was not submitted correctly.';
}

header('location: ../cv.php');
