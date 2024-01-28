<?php
session_start();
include 'classes/dbh.classes.php';
require_once 'classes/cv.classes.php';
if(isset($_SESSION["userid"])){
    
    $userId = $_SESSION["userid"];
    // $cv = new Cv($userId);
    // $cvData = $userId->getCv();
}
$db = new Dbh();
$pdo = $db->connect();
$sql = "SELECT * FROM cv WHERE users_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$userId]);
$cv = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>CV Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="cv.css"/>
</head>
<body class="d-flex flex-column align-items-center justify-content-center vh-100">
    
    <div class="container">
        <div class="head">
            <img>
            <p> <?php if (isset($_SESSION['cv_city'])) {
                        echo $_SESSION['cv_city'];
                    } else {
                    echo 'City not set';
                    }    ?>
            </p>
                
        </div>
        <form action="includes/cv.inc.php" method="post">
           
            <input type="text" name="cv_motivationalLetter" placeholder="Motivational Letter" >
            <input type="text" name="cv_skills" placeholder="Skills" >
            <input type="text" name="cv_address" placeholder="Address">
            <input type="number" name="cv_phoneNumber" placeholder="Phone Number">
            <input type="text" name="cv_country" placeholder="Country">
            <input type="text" name="cv_city" placeholder="City">
            <input type="text" name="cv_degree" placeholder="Degree">
            <input type="file" name="cv_pImage" placeholder="Profile Image" >
            <input type="submit" name="submit">Submit</input>
        </form>
    </div>

    <div class="container mt-5 justify-content-center">

        <!-- Header Row -->
        <div class="row first justify-content-center">
            <div class="col-lg-3">
                <!-- Photo -->
                <img src="your_photo.jpg" alt="Your Photo" class="img-fluid rounded-circle">
            </div>
            <div class="col-lg-9">
                <!-- Name and Country -->
                <h1 class="display-4">Your Name</h1>
                <p class="lead">Country: Your Country</p>
            </div>
        </div>

        <!-- Personal Information Row -->
        <div class="row second mt-4">
            <div class="col-lg-6">
                <!-- Additional Personal Information -->
                <p><strong>Address:</strong> Your Address</p>
                <p><strong>Phone Number:</strong> Your Phone Number</p>
                <p><strong>Email:</strong> your@email.com</p>
            </div>
            <div class="col-lg-6">
                <!-- Education and Other Information -->
                <p><strong>Degree:</strong> Your Degree</p>
                <p><strong>Country:</strong> Your Country</p>
                <p><strong>City:</strong> Your City</p>
            </div>
        </div>

        <!-- Additional CV Sections -->
        <div class="row third mt-4">
            <div class="col-lg-12">
                <!-- Motivational Letter -->
                <h2>Motivational Letter</h2>
                <p><?php echo $motivationalLetter; ?></p>

                <!-- Skills -->
                <h2>Skills</h2>
                <p><?php echo $skills; ?></p>

                <!-- Photo URL -->
                <h2>Photo URL</h2>
                <p><?php echo $pImage; ?></p>
            </div>
        </div>

    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
