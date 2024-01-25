<?php
session_start();
include 'classes/dbh.classes.php';
require_once 'classes/cv.classes.php';

$userId = $_SESSION["userid"];
$cv = new Cv($userId);
$cvData = $cv->getCv();
?>

<!DOCTYPE html>
<html>
<head>
    <title>CV Form</title>
</head>
<body>
    <form action="includes/cv.inc.php" method="post">
        <!-- Add fields for all the CV data -->
        <input type="text" name="cv_motivationalLetter" placeholder="Motivational Letter" >
        <input type="text" name="cv_skills" placeholder="Skills" >
        <input type="text" name="cv_address" placeholder="Address">
        <input type="text" name="cv_phoneNumber" placeholder="Phone Number">
        <input type="text" name="cv_country" placeholder="Country">
        <input type="text" name="cv_city" placeholder="City">
        <input type="text" name="cv_degree" placeholder="Degree">
        <input type="file" name="cv_pImage" placeholder="Profile Image" >
        <button type="submit" name="submit">Submit</button>
    </form>
</body>
</html>
