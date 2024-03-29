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
    <link rel="stylesheet" href="responsive.css" />
    <title>Post Jobs</title>
    <script src="toggle-script.js" defer></script>
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
                if (isset($_SESSION["userid"]) && $job->hasPostedJob($_SESSION["userid"] && isset($_SESSION["isEmployer"]) && $_SESSION["isEmployer"] == 1)): ?>
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

        <!-- Day or Night button -->

        <!-- add 30px padding each header class plz -->
        <div class="dnDiv">
            <button class="dayNightBtn" id="dnBtn" onClick="toggleDayNight()">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-sun-fill" viewBox="0 0 16 16">
                    <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8M8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0m0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13m8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5M3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8m10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0m-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0m9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707M4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708"/>
                </svg>
            </button>
            <button class="dayNightBtn" id="dnBtn" onClick="toggleDayNight()" style="display: none;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-moon-fill" viewBox="0 0 16 16">
                    <path d="M6 .278a.77.77 0 0 1 .08.858 7.2 7.2 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277q.792-.001 1.533-.16a.79.79 0 0 1 .81.316.73.73 0 0 1-.031.893A8.35 8.35 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.75.75 0 0 1 6 .278"/>
                </svg>
            </button>
        </div>
        <!-- Day or Night button -->
    </header>

    <div class="formmaster" id="formmasterDiv">
    <h1>CREATE YOUR JOB LISTING</h1>
    <form action="includes/insert_job.inc.php" method="post">
        <div class="formHolder">
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
                <p><strong>Description:</strong> <?php echo htmlspecialchars(mb_strimwidth($job['job_description'], 0, 80, "...")); ?></p>
                <p><strong>Company Name:</strong> <?php echo htmlspecialchars($job['job_compname']); ?></p>
                <p><strong>Skills:</strong> <?php echo htmlspecialchars(mb_strimwidth($job['job_skills'], 0, 80, "...")); ?></p>
                <p><strong>Pay/Income:</strong> <?php echo htmlspecialchars($job['job_income']); ?></p>             
            </div>
           <form action="includes/delete_job.inc.php" method="post">
                <input type="hidden" name="job_id" value="<?php echo $job['job_id']; ?>">
                <button type="submit" onclick="alert('Are you sure that you want to delete this job?')" class="deleteBtn">DELETE</button>
            </form>
        </div>
        <?php } ?>
    </div>
        <script>
            window.addEventListener('DOMContentLoaded', (event) => {
                document.querySelectorAll('textarea').forEach(function(textarea) {
                    textarea.addEventListener('input', autoResize, false);
                });

                function autoResize() {
                    this.style.height = 'auto';
                    this.style.height = this.scrollHeight + 'px';
                }
            });
        </script>

    <script src="post.js"></script>
    
</body>
</html>

