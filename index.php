<?php
    session_start();
    include 'classes/job.classes.php';
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
    <link rel="stylesheet" href="index.css"/>
    <title>Document</title>
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

    <section>
        <div class="sectionText">
            <h1>WORK</h1>
            <h1>WITH</h1>
            <h1>US</h1>
        </div>
    </section>
    <article>
        <div class="welcome-text">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates sequi facere rem neque, asperiores voluptate ea veritatis doloremque quo ab tempora esse obcaecati aut excepturi. Itaque cupiditate labore suscipit deserunt.</p>
            <div class="welcome-buttons">
                <button class="contact">CONTACT US</button>
                <button class="more-info">MORE INFO</button>
            </div>
        </div>
    </article>
    <div class="articleTwo">
        <div class="first-at">
            <h3>Who is eligible?</h3>
        </div>
        <div class="second-at">
            <div class="motto">
                <h1>Anyone</h1>
                <h1>Anything</h1>
                <h1>Anytime</h1>
            </div>
            <div class="ppic">
                <div class="pic">
                    <img src="images/half-body-portrait-of-a-construction-worker-in-safety-clothing-isolated-on-transparent-background-generative-ai-png.png">
                </div>
                <div class="infop">
                    <h1>• Greg</h1>
                    <h1>• Construction Worker</h1>
                    <h1>• 12,000+ Work Experience</h1>
                </div>
            </div>
        </div>
        <div class="third-at">
            <p>So if you are capable of working, eWork is for you. Join now and be discovered!</p>
            <button class="contact">JOIN NOW</button>
        </div>
    </div>
    <div class="articleThree">
        <div class="enter">
            <h1>WHY CHOOSE US?</h1>
        </div>
        <div class="icon-holder">
            <div class="easytouse">
                <img src="images/snap_3798326.png">
                <h3>Easy To Use</h3>
            </div>
            <div class="quick">
                <img src="images/quick-response_3856539.png">
                <h3>Speedy Recognition</h3>
            </div>
            <div class="security">
                <img src="images/shield_508281.png">
                <h3>Data Always Secure</h3>
            </div>
            <div class="achievment">
                <img src="images/trophy_2618179.png">
                <h3>Service Award</h3>
            </div>
            <div class="guarantee">
                <img src="images/guarantee-certificate_3734879.png">
                <h3>Satisfaction Guaranteed</h3>
            </div>
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