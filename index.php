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
    <link rel="stylesheet" href="index.css" />
    <link rel="stylesheet" href="responsive.css" />
    <title>eWork Home</title>
    <script src="toggle-script.js" defer></script>
</head>

<body>

    <header>
        <div class="header-main">
            <div class="logo">
                <h1>eWork</h1>
            </div>
            <nav>
                <h3><a class="current">HOME</a></h3>
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
                if (isset($_SESSION["useruname"])) {
                    ?>
                    <li><a href="cv.php"><button class="uname">My CV</button></a></li>
                    <li><a href="profile.php"><button class="uname">
                                <?php echo strtoupper($_SESSION["useruname"]); ?>
                            </button></a></li>
                    <li><a href="includes/logout.inc.php"><button class="header-login-a">LOGOUT</button></a></li>

                    <?php
                } else {
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
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                        class="bi bi-sun-fill" viewBox="0 0 16 16">
                        <path
                            d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8M8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0m0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13m8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5M3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8m10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0m-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0m9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707M4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708" />
                    </svg>
                </button>
                <button class="dayNightBtn" id="dnBtn" onClick="toggleDayNight()" style="display: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                        class="bi bi-moon-fill" viewBox="0 0 16 16">
                        <path
                            d="M6 .278a.77.77 0 0 1 .08.858 7.2 7.2 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277q.792-.001 1.533-.16a.79.79 0 0 1 .81.316.73.73 0 0 1-.031.893A8.35 8.35 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.75.75 0 0 1 6 .278" />
                    </svg>
                </button>
            </div>
            <!-- Day or Night button -->
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
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates sequi facere rem neque, asperiores
                voluptate ea veritatis doloremque quo ab tempora esse obcaecati aut excepturi. Itaque cupiditate labore
                suscipit deserunt.</p>
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
                    <img
                        src="images/half-body-portrait-of-a-construction-worker-in-safety-clothing-isolated-on-transparent-background-generative-ai-png.png">
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
            <button class="contact" href="signup.php"><a class="signupi" href="signup.php">JOIN NOW</a></button>
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