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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="index.css" />
    <link rel="stylesheet" href="responsive.css" />
    <title>eWork - Find Your Dream Job | Professional Job Platform</title>
    <script src="toggle-script.js" defer></script>
</head>

<body>

    <header class="main-header">
        <div class="header-container">
            <div class="logo">
                <a href="index.php">
                    <h1>eWork</h1>
                </a>
            </div>
            <nav class="main-nav">
                <a href="index.php" class="nav-link current">Home</a>
                <?php
                if (isset($_SESSION["isEmployer"]) && $_SESSION["isEmployer"] == 1): ?>
                    <a href="post.php" class="nav-link">Post Job</a>
                <?php endif ?>
                <a href="find.php" class="nav-link">Find Job</a>
                <?php
                $job = new Job();
                if (isset($_SESSION["userid"]) && isset($_SESSION["isEmployer"]) && $_SESSION["isEmployer"] == 1 && $job->hasPostedJob($_SESSION["userid"])): ?>
                    <a href="applications.php" class="nav-link">Applications</a>
                <?php endif;
                if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1): ?>
                    <a href="adminPanel.php" class="nav-link">Admin Panel</a>
                <?php endif; ?>
            </nav>
            <div class="header-actions">
                <?php
                if (isset($_SESSION["useruname"])) {
                    ?>
                    <a href="cv.php" class="btn-secondary">My CV</a>
                    <a href="profile.php" class="btn-profile">
                        <?php echo htmlspecialchars(strtoupper($_SESSION["useruname"])); ?>
                    </a>
                    <a href="includes/logout.inc.php" class="btn-primary">Logout</a>
                    <?php
                } else {
                    ?>
                    <a href="login.php" class="btn-secondary">Log In</a>
                    <a href="signup.php" class="btn-primary">Sign Up</a>
                    <?php
                }
                ?>
                <div class="dnDiv">
                    <button class="dayNightBtn" id="dnBtn" onClick="toggleDayNight()" aria-label="Toggle dark mode">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-sun-fill" viewBox="0 0 16 16">
                            <path
                                d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8M8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0m0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13m8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5M3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8m10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0m-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0m9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707M4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708" />
                        </svg>
                    </button>
                    <button class="dayNightBtn" id="dnBtn" onClick="toggleDayNight()" style="display: none;" aria-label="Toggle light mode">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-moon-fill" viewBox="0 0 16 16">
                            <path
                                d="M6 .278a.77.77 0 0 1 .08.858 7.2 7.2 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277q.792-.001 1.533-.16a.79.79 0 0 1 .81.316.73.73 0 0 1-.031.893A8.35 8.35 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.75.75 0 0 1 6 .278" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <section class="hero-section">
        <div class="hero-overlay"></div>
        <!-- Enhanced SVG Decorations for Hero Section -->
        <svg class="hero-svg hero-svg-1" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <circle cx="100" cy="100" r="80" fill="none" stroke="rgba(255,255,255,0.25)" stroke-width="2.5"/>
            <circle cx="100" cy="100" r="50" fill="none" stroke="rgba(255,255,255,0.2)" stroke-width="2"/>
            <circle cx="100" cy="100" r="30" fill="none" stroke="rgba(255,255,255,0.15)" stroke-width="1.5"/>
        </svg>
        <svg class="hero-svg hero-svg-2" viewBox="0 0 150 150" xmlns="http://www.w3.org/2000/svg">
            <polygon points="75,10 140,140 10,140" fill="none" stroke="rgba(255,255,255,0.25)" stroke-width="2.5"/>
            <polygon points="75,30 120,120 30,120" fill="none" stroke="rgba(255,255,255,0.2)" stroke-width="2"/>
        </svg>
        <svg class="hero-svg hero-svg-3" viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg">
            <rect x="10" y="10" width="100" height="100" fill="none" stroke="rgba(255,255,255,0.25)" stroke-width="2.5" rx="10"/>
            <rect x="20" y="20" width="80" height="80" fill="none" stroke="rgba(255,255,255,0.2)" stroke-width="2" rx="8"/>
        </svg>
        <svg class="hero-svg hero-svg-4" viewBox="0 0 180 180" xmlns="http://www.w3.org/2000/svg">
            <path d="M90,20 Q160,90 90,160 Q20,90 90,20" fill="none" stroke="rgba(255,255,255,0.22)" stroke-width="2.5"/>
            <path d="M90,40 Q140,90 90,140 Q40,90 90,40" fill="none" stroke="rgba(255,255,255,0.18)" stroke-width="2"/>
        </svg>
        <svg class="hero-svg hero-svg-5" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
            <polygon points="50,5 95,50 50,95 5,50" fill="none" stroke="rgba(255,255,255,0.25)" stroke-width="2.5"/>
            <polygon points="50,15 85,50 50,85 15,50" fill="none" stroke="rgba(255,255,255,0.2)" stroke-width="2"/>
        </svg>
        <svg class="hero-svg hero-svg-6" viewBox="0 0 140 140" xmlns="http://www.w3.org/2000/svg">
            <circle cx="70" cy="70" r="60" fill="none" stroke="rgba(255,255,255,0.2)" stroke-width="2"/>
            <path d="M70,10 L70,130 M10,70 L130,70" stroke="rgba(255,255,255,0.18)" stroke-width="2"/>
            <circle cx="70" cy="70" r="40" fill="none" stroke="rgba(255,255,255,0.15)" stroke-width="1.5"/>
        </svg>
        <svg class="hero-svg hero-svg-7" viewBox="0 0 160 160" xmlns="http://www.w3.org/2000/svg">
            <path d="M80,20 L140,80 L80,140 L20,80 Z" fill="none" stroke="rgba(255,255,255,0.22)" stroke-width="2.5"/>
            <path d="M80,35 L125,80 L80,125 L35,80 Z" fill="none" stroke="rgba(255,255,255,0.18)" stroke-width="2"/>
        </svg>
        <svg class="hero-svg hero-svg-8" viewBox="0 0 110 110" xmlns="http://www.w3.org/2000/svg">
            <ellipse cx="55" cy="55" rx="45" ry="30" fill="none" stroke="rgba(255,255,255,0.25)" stroke-width="2.5"/>
            <ellipse cx="55" cy="55" rx="30" ry="20" fill="none" stroke="rgba(255,255,255,0.2)" stroke-width="2"/>
        </svg>
        <div class="hero-content">
            <h1 class="hero-title">Find Your Dream Job</h1>
            <p class="hero-subtitle">Connect with top employers and discover opportunities that match your skills</p>
            <div class="hero-cta">
                <a href="signup.php" class="btn-hero-primary">Get Started</a>
                <a href="find.php" class="btn-hero-secondary">Browse Jobs</a>
            </div>
        </div>
    </section>

    <section class="features-section">
        <!-- Background Pattern SVG -->
        <svg class="features-bg-pattern" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <defs>
                <pattern id="grid" width="20" height="20" patternUnits="userSpaceOnUse">
                    <path d="M 20 0 L 0 0 0 20" fill="none" stroke="rgba(20,168,0,0.03)" stroke-width="1"/>
                </pattern>
            </defs>
            <rect width="100" height="100" fill="url(#grid)"/>
        </svg>
        <div class="container">
            <div class="section-header">
                <svg class="section-header-icon" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="30" cy="30" r="25" fill="none" stroke="rgba(20,168,0,0.1)" stroke-width="2"/>
                    <path d="M20 30 L27 37 L40 24" fill="none" stroke="rgba(20,168,0,0.2)" stroke-width="2.5" stroke-linecap="round"/>
                </svg>
                <h2 class="section-title">Why Choose eWork?</h2>
                <p class="section-description">Join thousands of professionals who trust eWork for their career growth</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <svg class="feature-card-decoration" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="50" cy="50" r="40" fill="none" stroke="rgba(20,168,0,0.08)" stroke-width="1.5"/>
                    </svg>
                    <div class="feature-icon">
                        <img src="images/snap_3798326.png" alt="Easy to Use">
                    </div>
                    <h3 class="feature-title">Easy To Use</h3>
                    <p class="feature-description">Intuitive interface designed for seamless job searching and application</p>
                </div>
                <div class="feature-card">
                    <svg class="feature-card-decoration" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <polygon points="50,10 90,90 10,90" fill="none" stroke="rgba(20,168,0,0.08)" stroke-width="1.5"/>
                    </svg>
                    <div class="feature-icon">
                        <img src="images/quick-response_3856539.png" alt="Speedy Recognition">
                    </div>
                    <h3 class="feature-title">Speedy Recognition</h3>
                    <p class="feature-description">Get noticed by employers quickly with our optimized matching system</p>
                </div>
                <div class="feature-card">
                    <svg class="feature-card-decoration" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <rect x="20" y="20" width="60" height="60" fill="none" stroke="rgba(20,168,0,0.08)" stroke-width="1.5" rx="5"/>
                    </svg>
                    <div class="feature-icon">
                        <img src="images/shield_508281.png" alt="Data Security">
                    </div>
                    <h3 class="feature-title">Data Always Secure</h3>
                    <p class="feature-description">Your information is protected with industry-leading security measures</p>
                </div>
                <div class="feature-card">
                    <svg class="feature-card-decoration" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <path d="M50,20 Q70,40 50,60 Q30,40 50,20" fill="none" stroke="rgba(20,168,0,0.08)" stroke-width="1.5"/>
                    </svg>
                    <div class="feature-icon">
                        <img src="images/trophy_2618179.png" alt="Service Award">
                    </div>
                    <h3 class="feature-title">Service Award</h3>
                    <p class="feature-description">Recognized for excellence in connecting talent with opportunity</p>
                </div>
            </div>
        </div>
    </section>

    <section class="eligibility-section">
        <!-- Decorative SVG Elements -->
        <svg class="eligibility-svg eligibility-svg-left" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path d="M100,20 Q180,100 100,180 Q20,100 100,20" fill="none" stroke="rgba(20,168,0,0.06)" stroke-width="2"/>
            <circle cx="100" cy="100" r="60" fill="none" stroke="rgba(20,168,0,0.04)" stroke-width="1.5"/>
        </svg>
        <svg class="eligibility-svg eligibility-svg-right" viewBox="0 0 150 150" xmlns="http://www.w3.org/2000/svg">
            <polygon points="75,10 140,75 75,140 10,75" fill="none" stroke="rgba(20,168,0,0.06)" stroke-width="2"/>
        </svg>
        <div class="container">
            <div class="eligibility-content">
                <div class="eligibility-text">
                    <svg class="eligibility-title-icon" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="20" cy="20" r="18" fill="none" stroke="rgba(20,168,0,0.15)" stroke-width="2"/>
                        <path d="M12,20 L18,26 L28,14" fill="none" stroke="rgba(20,168,0,0.3)" stroke-width="2.5" stroke-linecap="round"/>
                    </svg>
                    <h2 class="eligibility-title">Who Can Join?</h2>
                    <div class="motto-grid">
                        <div class="motto-item">
                            <svg class="motto-icon" viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="15" cy="15" r="12" fill="none" stroke="rgba(20,168,0,0.2)" stroke-width="2"/>
                            </svg>
                            <h3>Anyone</h3>
                            <p>Open to all professionals</p>
                        </div>
                        <div class="motto-item">
                            <svg class="motto-icon" viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg">
                                <rect x="5" y="5" width="20" height="20" fill="none" stroke="rgba(20,168,0,0.2)" stroke-width="2" rx="3"/>
                            </svg>
                            <h3>Anything</h3>
                            <p>All industries welcome</p>
                        </div>
                        <div class="motto-item">
                            <svg class="motto-icon" viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg">
                                <polygon points="15,5 25,25 5,25" fill="none" stroke="rgba(20,168,0,0.2)" stroke-width="2"/>
                            </svg>
                            <h3>Anytime</h3>
                            <p>24/7 access to opportunities</p>
                        </div>
                    </div>
                    <p class="eligibility-description">If you're capable of working, eWork is for you. Join now and be discovered by top employers!</p>
                    <a href="signup.php" class="btn-primary-large">Join Now</a>
                </div>
                <div class="eligibility-visual">
                    <div class="testimonial-card">
                        <div class="testimonial-image">
                            <img src="images/half-body-portrait-of-a-construction-worker-in-safety-clothing-isolated-on-transparent-background-generative-ai-png.png" alt="Greg - Construction Worker">
                        </div>
                        <div class="testimonial-info">
                            <h4>Greg</h4>
                            <p class="testimonial-role">Construction Worker</p>
                            <p class="testimonial-experience">12,000+ Hours Experience</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="stats-section">
        <!-- Background Pattern -->
        <svg class="stats-bg-pattern" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <defs>
                <pattern id="dots" width="40" height="40" patternUnits="userSpaceOnUse">
                    <circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.1)"/>
                </pattern>
            </defs>
            <rect width="200" height="200" fill="url(#dots)"/>
        </svg>
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <svg class="stat-icon" viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="25" cy="25" r="20" fill="none" stroke="rgba(255,255,255,0.2)" stroke-width="2"/>
                        <path d="M15,25 L22,32 L35,18" fill="none" stroke="rgba(255,255,255,0.3)" stroke-width="2.5" stroke-linecap="round"/>
                    </svg>
                    <h3 class="stat-number">10,000+</h3>
                    <p class="stat-label">Active Jobs</p>
                </div>
                <div class="stat-item">
                    <svg class="stat-icon" viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg">
                        <rect x="10" y="10" width="30" height="30" fill="none" stroke="rgba(255,255,255,0.2)" stroke-width="2" rx="5"/>
                        <circle cx="25" cy="25" r="8" fill="rgba(255,255,255,0.15)"/>
                    </svg>
                    <h3 class="stat-number">50,000+</h3>
                    <p class="stat-label">Registered Users</p>
                </div>
                <div class="stat-item">
                    <svg class="stat-icon" viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg">
                        <polygon points="25,10 40,40 10,40" fill="none" stroke="rgba(255,255,255,0.2)" stroke-width="2"/>
                        <circle cx="25" cy="30" r="5" fill="rgba(255,255,255,0.15)"/>
                    </svg>
                    <h3 class="stat-number">5,000+</h3>
                    <p class="stat-label">Companies</p>
                </div>
                <div class="stat-item">
                    <svg class="stat-icon" viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg">
                        <path d="M25,10 Q35,20 25,30 Q15,20 25,10" fill="none" stroke="rgba(255,255,255,0.2)" stroke-width="2"/>
                        <circle cx="25" cy="20" r="6" fill="rgba(255,255,255,0.15)"/>
                    </svg>
                    <h3 class="stat-number">95%</h3>
                    <p class="stat-label">Success Rate</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="main-footer">
        <!-- Footer Decorative SVG -->
        <svg class="footer-decoration" viewBox="0 0 300 100" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0,50 Q75,20 150,50 T300,50" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="2"/>
            <path d="M0,60 Q75,30 150,60 T300,60" fill="none" stroke="rgba(255,255,255,0.03)" stroke-width="1.5"/>
        </svg>
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <svg class="footer-logo-icon" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="20" cy="20" r="18" fill="none" stroke="rgba(20,168,0,0.3)" stroke-width="2"/>
                        <path d="M12,20 L18,26 L28,14" fill="none" stroke="rgba(20,168,0,0.4)" stroke-width="2.5" stroke-linecap="round"/>
                    </svg>
                    <h3 class="footer-logo">eWork</h3>
                    <p class="footer-description">Connecting talent with opportunity. Your career journey starts here.</p>
                </div>
                <div class="footer-section">
                    <h4 class="footer-title">Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="find.php">Find Job</a></li>
                        <li><a href="post.php">Post Job</a></li>
                        <li><a href="login.php">Login</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4 class="footer-title">About</h4>
                    <ul class="footer-links">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Service</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4 class="footer-title">Project Info</h4>
                    <p class="footer-info">Ky projekt u punua per lenden "Inxhinieri e Kerkesave Softuerike"</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 eWork. All rights reserved. | Albin Dana, Semi Zhuri, Andi Morina</p>
            </div>
        </div>
    </footer>

</body>

</html>