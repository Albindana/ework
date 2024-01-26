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
    <title>Document</title>
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
        </div>
    </header>
            <body>
            <div class="container">
                    <div class="form-container">
                <h1>Profile</h1>
                <form action="includes/change_role.inc.php" method="post">
                    <div class="toggle-container">
                        <p>Employer Mode</p>
                        <label class="switch">
                        <input type="checkbox" name="employerMode" onchange="this.form.submit()" <?php echo isset($_SESSION['isEmployer']) && $_SESSION['isEmployer'] == 1 ? 'checked' : ''; ?>>
                            <span class="slider round"></span>
                        </label>
                        <input type="hidden" name="userId" value="<?php echo $_SESSION['userid']; ?>">
                    </div>
                </form>



                <h2>Your Information</h2>
              
                <p class="user-info" name="uname">Username: <?php echo $user["users_uname"]; ?></p>
                <p class="user-info" name="uemail">Email: <?php echo $user["users_email"]; ?></p>


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
                
            </body>

</html>