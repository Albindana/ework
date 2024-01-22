<?php
session_start();
include 'classes/dbh.classes.php';
include 'classes/job.classes.php';

$userId = $_SESSION["userid"];

$db = new Dbh();
$pdo = $db->connect();
$sql = "SELECT applications.*, users.users_uname, users.users_email, jobs.job_title FROM applications JOIN users ON applications.user_id = users.users_id JOIN jobs ON applications.job_id = jobs.job_id WHERE jobs.users_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$userId]);
$applications = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<<<<<<< HEAD
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Applications</title>
</head>
<body>
    <h1>Job Applications</h1>
    <?php foreach ($applications as $application): ?>
        <div>
=======
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="applications.css"/>
    <title>Job Applications</title>

</head>
<body>
<header>
    <div class="header-main">
        <div class="logo"><h1>eWork</h1></div>
        <nav>
            <h3><a class="current">HOME</a></h3>
            <h3><a href="post.php">POST JOB</a></h3>
            <h3><a href="find.php">FIND JOB</a></h3>
            <?php
                $job = new Job();
                if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1): ?>
                    <h3><a href="adminPanel.php">ADMIN PANEL</a></h3>
            <?php endif; ?>
        </nav>
        <div class="profile">
            <?php 
                if(isset($_SESSION["useruname"]))
                {
            ?>
            <li><a href="profile.php"><button class="uname"><?php echo strtoupper($_SESSION["useruname"]); ?></button></a></li>
            <li><a href="includes/logout.inc.php"><button class="header-login-a">LOGOUT</button></a></li>
            
            <?php
                }
                else
                {
            ?>
                <a href="login.php"><button class="lg">LOG IN</button></a>
                <a href="signup.php"><button class="si">SIGN UP</button></a>
            <?php
                }
            ?>
        </div>
    </div>
</header>
    <h1>Job Applications</h1>
    <div class="applications-container">
    <?php foreach ($applications as $application): ?>
        <div class="application">
>>>>>>> semi-branch
            <h2><?php echo htmlspecialchars($application['job_title']); ?></h2>
            <p><strong>Applicant:</strong> <?php echo htmlspecialchars($application['users_uname']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($application['users_email']); ?></p>
            <p><strong>Applied At:</strong> <?php echo htmlspecialchars($application['application_date']); ?></p>
        </div>
    <?php endforeach; ?>
<<<<<<< HEAD
=======
</div>

>>>>>>> semi-branch
</body>
</html>
