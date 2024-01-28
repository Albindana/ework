<?php
// if (isset($_POST['submit']) && isset($_FILES['cv_pImage'])) {
//     require_once "dbh.classes.php";

//     // Fetch all the data from the form
//     $userId = $_SESSION["userid"];
//     $motivationalLetter = filter_input(INPUT_POST, 'cv_motivationalLetter', FILTER_SANITIZE_STRING);
//     $skills = filter_input(INPUT_POST, 'cv_skills', FILTER_SANITIZE_STRING);
//     $address = filter_input(INPUT_POST, 'cv_address', FILTER_SANITIZE_STRING);
//     $phoneNumber = filter_input(INPUT_POST, 'cv_phoneNumber', FILTER_SANITIZE_STRING);
//     $country = filter_input(INPUT_POST, 'cv_country', FILTER_SANITIZE_STRING);
//     $city = filter_input(INPUT_POST, 'cv_city', FILTER_SANITIZE_STRING);
//     $degree = filter_input(INPUT_POST, 'cv_degree', FILTER_SANITIZE_STRING);

//     // Read the file contents
//     $pImage = file_get_contents($_FILES['cv_pImage']['tmp_name']);

//     // Prepare the insert query
//     $sql = "INSERT INTO cv (users_id, cv_motivationalLetter, cv_skills, cv_address, cv_phoneNumber, cv_country, cv_city, cv_degree, cv_pImage) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
//     $stmt = $pdo->prepare($sql);

//     // Try to execute the query
//     try {
//         // Bind the parameters
//         $stmt->bindParam(1, $userId);
//         $stmt->bindParam(2, $motivationalLetter);
//         $stmt->bindParam(3, $skills);
//         $stmt->bindParam(4, $address);
//         $stmt->bindParam(5, $phoneNumber);
//         $stmt->bindParam(6, $country);
//         $stmt->bindParam(7, $city);
//         $stmt->bindParam(8, $degree);
//         $stmt->bindParam(9, $pImage, PDO::PARAM_LOB); // Bind the image data as a BLOB

//         // Execute the query
//         $stmt->execute();

//         // Redirect the user to the view page
//         header("Location: ../index.php");
//     } catch (Exception $e) {
//         // Display the error message
//         echo 'An error occurred while inserting the CV data: ' . $e->getMessage();
//         header("Location: ../cv.php");
//     }
// } else {
//     // Redirect the user to the index page
//     header("Location: ../index.php");
// }

session_start();
include_once '../classes/dbh.classes.php';
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

    try {
        $cv = new Cv($userId, $motivationalLetter, $skills, $address, $phoneNumber, $country, $city, $degree, $pImage);
        $cv->insertCv();
        echo 'The CV has been created successfully.';
    } catch (Exception $e) {
        echo 'An error occurred while creating the CV: ' . $e->getMessage();
    }
    
} else{
    echo 'error occured';
}
?>
