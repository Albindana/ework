<?php
session_start();
include 'classes/dbh.classes.php';
include 'classes/job.classes.php';

$db = new Dbh();
$pdo = $db->connect();
$sql = "SELECT jobs.*, users.users_uname FROM jobs JOIN users ON jobs.users_id = users.users_id";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="find.css"/>
    <title>Document</title>
</head>
<body>
    <hr>
    <header>
        <div class="header-main">
            <div class="logo"><h1>eWork</h1></div>
            <nav>
                <h3><a href="index.php">HOME</a></h3>
                <h3><a href="post.php">POST JOB</a></h3>
                <h3><a class="current">FIND JOB</a></h3>
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
                    
    <div class="wrap">
        <div class="search">
           <input type="text" class="searchTerm" placeholder="Looking for a specific job? Search here.">
           <button type="submit" class="searchButton">
             <p>SEARCH</p>
          </button>
          
        </div>
    </div>

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

    <div class="jobs">
        
    <?php foreach ($jobs as $job): ?>
        <div class="job-container">
            <div class="job-card">
                <div class="p-info">
                    <h3><?php echo htmlspecialchars($job['job_title']); ?></h3>
                    <p><strong>Description:</strong> <?php echo htmlspecialchars($job['job_description']); ?></p>
                    <p><strong>Company Name:</strong> <?php echo htmlspecialchars($job['job_compname']); ?></p>
                    <p><strong>Skills:</strong> <?php echo htmlspecialchars($job['job_skills']); ?></p>
                    <p><strong>Pay/Income:</strong> <?php echo htmlspecialchars($job['job_income']); ?></p>
                    <p><strong>Posted by:</strong> <?php echo htmlspecialchars($job['users_uname']); ?></p>
                </div>
                <div class="p-img">
                    <form action="includes/apply_job.inc.php" method="post">
                        <input type="hidden" name="job_id" value="<?php echo $job['job_id']; ?>">
                        <button type="submit" class="submitBtn">APPLY NOW!</button>
                    </form>
                    <?php
                    // Check if the current user is the one who posted the job
                    if (isset($_SESSION["userid"]) && $_SESSION["userid"] == $job['users_id']): ?>
                        <form action="includes/delete_job.inc.php" method="post">
                            <input type="hidden" name="job_id" value="<?php echo $job['job_id']; ?>">
                            <button type="submit" class="deleteBtn">DELETE</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
    <footer>
        <div class="content">
            <div class="ubt">
                <p>Ky projekt u punua per lenden "Inxhinieri e Kerkesave Softuerike"</p>
            </div>
            <div class="about">
                <a>About us</a>
            </div>
        </div>
        <div class="cp">
            <div class="copyright">
                <p>Â© Copyright - all rights reserved: Albin Dana, Semi Zhuri, Andi Morina</p>
            </div>
        </div>
    </footer>
</body>
</html>