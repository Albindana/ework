<?php
session_start();
include 'classes/dbh.classes.php';
include 'classes/job.classes.php';
require_once 'classes/cv.classes.php';
if (isset($_SESSION["userid"])) {

    $userId = $_SESSION["userid"];
}
$db = new Dbh();
$pdo = $db->connect();
$sql = "SELECT * FROM cv WHERE users_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$userId]);
$cv = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT users_email FROM users WHERE users_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$motivationalLetter = $cv[0]['cv_motivationalLetter'];
$skills = $cv[0]['cv_skills'];
$pImage = $cv[0]['cv_pImage'];
$address = $cv[0]['cv_address'];
$phoneNumber = $cv[0]['cv_phoneNumber'];
$degree = $cv[0]['cv_degree'];
$country = $cv[0]['cv_country'];
$city = $cv[0]['cv_city'];
$usersEmail = $user['users_email'];

if (isset($_SESSION["error"])) {
    $error_message = $_SESSION["error"];
    unset($_SESSION["error"]);
}
if (isset($_SESSION["success"])) {
    $success_message = $_SESSION["success"];
    unset($_SESSION["success"]);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>CV Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="cv.css" />
</head>

<body class="d-flex flex-column align-items-center justify-content-center vh-100">
    <div class="header">
        <a href="index.php">Return</a>
    </div> 

<header style="width:100%; text-align:center;" >
        <div class="header-main d-flex flex-row align-items-center justify-content-space-between" style="width:100%;text-align:center;" >
            <div class="logo">
                <h1>eWork</h1>
            </div>
            <nav>
                <h3><a class="current" href="index.php">HOME</a></h3>                               
            </div>
        </div>
</header>
    <div class="container">
        <div class="head">
            <?php if (isset($error_message)): ?>
                <div class="error-message">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
            <?php if (isset($success_message)): ?>
                <div class="success-message">
                    <?php echo $success_message; ?>
                </div>
            <?php endif; ?>

        </div>
        <form action="includes/cv.inc.php" method="post" enctype="multipart/form-data">
            <input type="text" name="cv_motivationalLetter" placeholder="Motivational Letter"
                value="<?php echo isset($motivationalLetter) ? $motivationalLetter : ''; ?>">
            <input type="text" name="cv_skills" placeholder="Skills"
                value="<?php echo isset($skills) ? $skills : ''; ?>">
            <input type="text" name="cv_address" placeholder="Address"
                value="<?php echo isset($address) ? $address : ''; ?>">
            <input type="number" name="cv_phoneNumber" placeholder="Phone Number"
                value="<?php echo isset($phoneNumber) ? $phoneNumber : ''; ?>">
            <input type="text" name="cv_country" placeholder="Country"
                value="<?php echo isset($country) ? $country : ''; ?>">
            <input type="text" name="cv_city" placeholder="City" value="<?php echo isset($city) ? $city : ''; ?>">
            <input type="text" name="cv_degree" placeholder="Degree"
                value="<?php echo isset($degree) ? $degree : ''; ?>">
            <input type="file" name="cv_pImage" placeholder="Profile Image">
            <input type="submit" name="submit">Submit</input>
        </form>

    </div>

    <div class="container mt-5 justify-content-center">

        <!-- Header Row -->
        <div class="row first justify-content-center">
            <div class="col-lg-3">
                <!-- Photo -->
                <img src="<?php echo $pImage ?>" alt="Your Photo" class="img-fluid rounded-circle">
            </div>

            <div class="col-lg-9">
                <!-- Name and Country -->
                <h1 class="display-4">
                    <?php echo ($_SESSION["useruname"]); ?>
                </h1>
                <p class="lead">Country:
                    <?php echo $country; ?>
                </p>
            </div>
        </div>

        <!-- Personal Information Row -->
        <div class="row second mt-4">
            <div class="col-lg-6">
                <!-- Additional Personal Information -->
                <p><strong>Address:</strong>
                    <?php echo $address; ?>
                </p>
                <p><strong>Phone Number:</strong>
                    <?php echo $phoneNumber; ?>
                </p>
                <p><strong>Email:</strong>
                    <?php echo $usersEmail; ?>
                </p>
            </div>
            <div class="col-lg-6">
                <!-- Education and Other Information -->
                <p><strong>Degree:</strong>
                    <?php echo $degree; ?>
                </p>
                <p><strong>Country:</strong>
                    <?php echo $country; ?>
                </p>
                <p><strong>City:</strong>
                    <?php echo $city; ?>
                </p>
            </div>
        </div>

        <!-- Additional CV Sections -->
        <div class="row third mt-4">
            <div class="col-lg-12">
                <!-- Motivational Letter -->
                <h2>Motivational Letter</h2>
                <p>
                    <?php echo $motivationalLetter; ?>
                </p>

                <!-- Skills -->
                <h2>Skills</h2>
                <p>
                    <?php echo $skills; ?>
                </p>

                <!-- Photo URL -->
                <h2>Photo URL</h2>
                <p>
                    <?php echo $pImage; ?>
                </p>
            </div>
        </div>

    </div>

    <!-- Bootstrap JS and Popper.js -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
</body>

</html>