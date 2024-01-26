<?php
    session_start();
    if (!isset($_SESSION["userid"])) {
        header("location: login.php");
        exit();

        include 'classes/dbh.classes.php';

    }
    if ($_SESSION['isEmployer'] != 1) {
        header("location: index.php");
        exit();
    }
    if (isset($_SESSION["error"])) {
        $error_message = $_SESSION["error"];
        unset($_SESSION["error"]);
    }
    if (isset($_SESSION["success"])) {
        $success_message = $_SESSION["success"];
        unset($_SESSION["success"]);
    }
    include_once 'classes/job.classes.php';
    $userid = $_SESSION['userid'];
$db = new Dbh();
$pdo = $db->connect();
$sql = "SELECT * FROM jobs WHERE users_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$userid]);
$jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);





?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="post.css"/>
    <title>Document</title>
</head>
<body>
    <header>
        <div class="header-main">
            <div class="logo"><h1>eWork</h1></div>
            <nav>
                <h3><a href="index.php">HOME</a></h3>
                <h3><a class="current" href="post.php">POST JOB</a></h3>
                <h3><a href="find.php">FIND JOB</a></h3>
                <?php
                $job = new Job();
                if (isset($_SESSION["userid"]) && $job->hasPostedJob($_SESSION["userid"])): ?>
                    <h3><a href="applications.php">VIEW APPLICATIONS</a></h3>
                <?php endif;
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

    <div class="formmaster" id="formmasterDiv">
    <h1>CREATE YOUR JOB LISTING</h1>
    <form action="includes/insert_job.inc.php" method="post">
        <div class="formHolder">
            <div class="formleft">
                    <?php if (isset($error_message)): ?>
                    <div class="error-message">
                        <?php echo $error_message; ?>
                    </div>
                    <?php endif; ?>
                <input type="text" name="job_title" class="leftinput" placeholder="Job Title"> 
                <input type="text" name="job_compname" class="leftinput" placeholder="Company Name"> 
                <textarea name="job_description" class="leftinput" placeholder="Job Description"></textarea>
                <textarea name="job_skills" class="leftinput" placeholder="Job Skills"></textarea>
                <input type="number" name="job_income" class="leftinput" placeholder="Salary Range">
            </div>
            <div class="formRight">
                <div class="formRO">
                    <input type="file">
                </div>
            </div>
        </div> 
        <button type="submit" class="submitBtn">POST JOB</button>
    </form>
</div>

 <!-- ================  list of jobs posted  ====================== -->
    <hr style="width: 100%; margin: auto;">
    <h1 id="p-jobs"><b>MY JOBS</b></h1>
    <div class="job-container">
        <?php foreach($jobs as $job){ ?>
        <div class="job-card">
            <div class="p-info">
                <h3><?php echo $job['job_title'] ?></h3>
                <p><strong>Description:</strong> <?php echo htmlspecialchars($job['job_description']); ?></p>
                <p><strong>Company Name:</strong> <?php echo htmlspecialchars($job['job_compname']); ?></p>
                <p><strong>Skills:</strong> <?php echo htmlspecialchars($job['job_skills']); ?></p>
                <p><strong>Pay/Income:</strong> <?php echo htmlspecialchars($job['job_income']); ?></p>             
            </div>
           <form action="includes/delete_job.inc.php" method="post">
                <input type="hidden" name="job_id" value="<?php echo $job['job_id']; ?>">
                <button type="submit" onclick="alert('Are you sure that you want to delete this job?')" class="deleteBtn">DELETE</button>
            </form>
        </div>
        <?php } ?>
    </div>

    <script src="post.js"></script>
</body>
</html>