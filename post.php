<?php
    session_start();
    if (!isset($_SESSION["userid"])) {
        header("location: login.php");
        exit();

        include 'classes/dbh.classes.php';
    }
    include_once 'classes/job.classes.php';
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
    <section id="visibleSection">
        <div class="main">
            <div class="first">
                <h1>POST A JOB</h1>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sequi maxime, amet aliquam quidem incidunt a blanditiis error delectus magni. Quidem odio possimus natus officia optio ducimus voluptas, dolor atque labore.</p>
            </div>
            <div class="second">
                <div class="checkmarks">
                    <h2>Title</h2>
                    <h2>Description</h2>
                    <h2>Requirements</h2>
                    <h2>Location</h2>
                    <h2>Pay/Income</h2>
                </div>
            </div>
        </div>
        <div class="buttona">
            <p>By clicking "ACCEPT & AGREE" you also accept our <a href="terms.html">terms and conditions</a>. </p>
            <button class="aabtn" onclick="toggleVisibility()">ACCEPT & AGREE</button>
        </div>
    </section>

    <div class="formmaster" id="formmasterDiv">
    <h1>CREATE YOUR JOB LISTING</h1>
    <form action="includes/insert_job.inc.php" method="post">
        <div class="formHolder">
            <div class="formleft">
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
    <h1 id="p-jobs"><b>Posted Jobs</b></h1>
    <div class="job-container">
        <div class="job-card">
            <div class="p-info">
                <h3>Job Title 1</h3>
                <p><strong>Description:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <p><strong>Company Name:</strong> ubt</p>
                <p><strong>Location:</strong> City, Country</p>
                <p><strong>Pay/Income:</strong> $50,000 per year</p>
                <p><strong>Work Experience:</strong> 200+ hours</p>
                <p><strong>Academic Requirements:</strong> Bachelor's</p>
            </div>
            <div class="p-img">
                <img src="images/Church_of_light.jpg"/>
                <button>Remove listing</button>
            </div>
            
        </div>

    <script src="post.js"></script>
</body>
</html>