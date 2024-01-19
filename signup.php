<?php
    session_start();
    if (isset($_SESSION["userid"])) {
        header("location: index.php");
        exit();
    }
    if (isset($_SESSION["error"])) {
        $error_message = $_SESSION["error"];
        unset($_SESSION["error"]);
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
    <title>Document</title>
    <link rel="stylesheet" href="login.css"/>
</head>
<body>
    <header>
        <div class="header-main">
            <div class="logo"><h1>eWork</h1></div>
            <nav>
                <h3><a href="index.php">HOME</a></h3>
                <h3><a href="post.php">POST JOB</a></h3>
                <h3><a href="find.php">FIND JOB</a></h3>
            </nav>
            <div class="profile">
                <a href="index.php"><button class="lg">CONTINUE AS GUEST</button></a>
            </div>
        </div>
    </header>
    
    <div class="container">
        <div class="form-container">
            <h1>Sign Up</h1>
            <?php if (isset($error_message)): ?>
            <div class="error-message">
                <?php echo $error_message; ?>
            </div>
            <?php endif; ?>
            <form id="signupForm" action="includes/signup.inc.php" method="post">
                <input type="text" name="uname" placeholder="Username" required><br>
                <input type="email" name="email" placeholder="Email" required><br>
                <input type="password" name="password" placeholder="Password" required><br>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required><br>
                <input type="submit" name="submit" value="Sign Up">
                <p>Already have an account? <a href="login.php">Log in</a></p>
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

</html>


</body>
</html>