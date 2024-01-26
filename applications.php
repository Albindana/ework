<?php
session_start();
include 'classes/dbh.classes.php';
include 'classes/job.classes.php';

$userId = $_SESSION["userid"];
if ($_SESSION['isEmployer'] != 1) {
    header("location: index.php");
    exit();
}

$db = new Dbh();
$pdo = $db->connect();
$sql = "SELECT * FROM jobs WHERE users_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$userId]);
$jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="applications.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
    <h1>Your Jobs</h1>
        <div class="jobs-container">
        <?php foreach ($jobs as $job): ?>
            <div class="job" data-id="<?php echo $job['job_id']; ?>" onclick="showApplicants(<?php echo $job['job_id']; ?>)">
                <h2><?php echo htmlspecialchars($job['job_title']); ?></h2>
            </div>
        <?php endforeach; ?>
    </div>
    <div id="applicants-container">
<script>
            
            let activeJob = null;
            function showApplicants(jobId) {
                
                if (activeJob) {
                    activeJob.classList.remove('active');
                }

                const clickedJob = document.querySelector(`.job[data-id="${jobId}"]`);
                clickedJob.classList.add('active');
                activeJob = clickedJob;

        
            $.ajax({
                url: 'includes/fetch_applicants.inc.php',  // The name of the PHP script
                type: 'POST',
                data: { jobId: jobId },
                success: function(data) {
                    $('#applicants-container').html(data);
                }
            });
       

    }
    </script>
    </div>
</body>
</html>
