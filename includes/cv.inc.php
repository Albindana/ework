<?php
session_start();
include '../classes/dbh.classes.php';
require_once '../classes/cv.classes.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch all the data from the form
    $userId = $_SESSION["userid"];
    $motivationalLetter = $_POST['cv_motivationalLetter'];
    $skills = $_POST['cv_skills'];
    $address = $_POST['cv_address'];
    $phoneNumber = $_POST['cv_phoneNumber'];
    $country = $_POST['cv_country'];
    $city = $_POST['cv_city'];
    $degree = $_POST['cv_degree'];
    $pImage = $_POST['cv_pImage']; // Make sure to handle the file upload correctly

    $cv = new Cv($userId, $motivationalLetter, $skills, $address, $phoneNumber, $country, $city, $degree, $pImage);
    $cv->insertCv();
} else{
    echo 'error occured';
}
?>
