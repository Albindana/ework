<?php
    session_start();
    if (!isset($_SESSION["userid"])) {
        header("location: login.php");
        exit();
    }
    if (isset($_SESSION["error"])) {
        $error_message = $_SESSION["error"];
        unset($_SESSION["error"]);
    }
    
    // Include your database connection file here
    include 'classes/dbh.classes.php';
   

    // Create an instance of the Dbh class
    $dbh = new Dbh();

    // Fetch the user's information from the database
    $stmt = $dbh->connect()->prepare('SELECT * FROM users WHERE users_id = ?;');
    $stmt->execute(array($_SESSION["userid"]));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $_SESSION["useruname"] = $user["users_uname"];
    include_once 'classes/job.classes.php'
?>


<!DOCTYPE html>
<html lang="en">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="profile.css"/>
    <link rel="stylesheet" href="responsive.css"/>
    <title>Your Profile</title>
    <script src="toggle-script.js" defer></script>
</head>
<body>
    <header>
        <div class="header-main">
            <div class="logo"><h1>eWork</h1></div>
            <nav>
                <h3><a href="index.php">HOME</a></h3>
                <?php 
            if (isset($_SESSION["isEmployer"]) && $_SESSION["isEmployer"] == 1): ?>
            <h3><a href="post.php">POST JOB</a></h3>
            <?php endif ?>
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
        </div>
    </header>
            
        <div class="container profile-container">
            <div class="form-container">
                    <h1>Profile</h1>
                    <form action="includes/change_role.inc.php" method="post">
                            <div class="toggle-container">
                                <h3>Employer Mode</h3>
                                <label class="switch">
                                <input type="checkbox" name="employerMode" onchange="this.form.submit()" <?php echo isset($_SESSION['isEmployer']) && $_SESSION['isEmployer'] == 1 ? 'checked' : ''; ?>>
                                    <span class="slider round"></span>
                                </label>
                                <input type="hidden" name="userId" value="<?php echo $_SESSION['userid']; ?>">
                            </div>
                    </form>

                    <h2>Your Information</h2>
                    
                    <h3 class="user-info" name="uname">Username: <?php echo $user["users_uname"]; ?></h3>
                    <h3 class="user-info" name="uemail">Email: <?php echo $user["users_email"]; ?></h3>


                    <h2>Change Username or Password</h2>
                        <?php if (isset($error_message)): ?>
                            <div class="error-message">
                                <?php echo $error_message; ?>
                            </div>
                        <?php endif; ?>
                    <form id="changeForm" action="includes/change_profile.inc.php" method="post">
                            <label id="oldPass" for="old_password">Your Password:</label>
                            <input type="password" id="old_password" name="old_password">
                            <label id="newName" for="new_username">New Username:</label>
                            <input type="text" id="new_username" name="new_username">
                            <label id="newPass" for="new_password">New Password:</label>
                            <input type="password" id="new_password" name="new_password">
                            <input type="submit" value="Submit">
                    </form>
            </div>
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
                <p>© Copyright - all rights reserved: Albin Dana, Semi Zhuri, Andi Morina</p>
            </div>
        </div>
    </footer>
    </body>

</html>