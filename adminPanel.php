<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="adminPanel.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
  </head>
    <title>Admin Panel</title>
</head>
<body>
    <?php
    session_start();
    
    include 'classes/dbh.classes.php';
    include_once 'classes/job.classes.php';
    if (!isset($_SESSION["userid"])) {
        header("location: login.php");
        exit();
    }
    if ($_SESSION['isAdmin'] != 1) {
        header("location: index.php");
        exit();
    }

    $dbh = new Dbh();
    $db = $dbh->connect();
    ?> 
    <header>
    <div class="header-main">
        <div class="logo"><h1>eWork</h1></div>
        <nav>
            <h3><a class="current" href="index.php">HOME</a></h3>
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
    <div class="users">
        <h1>User List</h1>
        <?php
        $stmt = $db->prepare('SELECT * FROM users');
        $stmt->execute();
        ?>
        <div class="user-table">
            <table>
                <tr><th>ID</th><th>Username</th><th>Password</th><th>Email</th><th>Admin</th><th>Employer</th><th>Action</th></tr>
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['users_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['users_uname']); ?></td>
                        <?php $password = htmlspecialchars($row['users_password']);
                        $truncatedPassword = mb_strimwidth($password, 0, 102, "...");
                        echo "<td>" . $truncatedPassword . "</td>"; ?>
                        <?php $email = htmlspecialchars($row['users_email']); 
                        $truncatedEmail = mb_strimwidth($email, 0, 25, "..."); 
                        echo "<td>" . $truncatedEmail . "</td>";?>
                        <td><?php echo ($row['isAdmin'] == 1 ? "Yes" : "No"); ?></td>
                        <td><?php echo ($row['isEmployer'] == 1 ? "Yes" : "No"); ?></td>
                        <td>
                            <form action='includes/make_admin.inc.php' method='post'>
                                <input type='hidden' name='userId' value='<?php echo htmlspecialchars($row['users_id']); ?>'>
                                <?php if ($row['isAdmin'] == 0) { ?>
                                    <button type='submit' class='admin'>Make Admin</button>
                                <?php } ?>
                            </form>
                            <form action='includes/delete_user.inc.php' method='post'>
                                <input type='hidden' name='userId' value='<?php echo htmlspecialchars($row['users_id']); ?>'>
                                <?php if ($row['isAdmin'] == 0) { ?>
                                    <button type='submit' class='delete'>Delete User</button>
                                <?php } ?>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
    <div class="jobs">
        <h1>Job List</h1>
        <?php
        $stmt = $db->prepare('SELECT * FROM jobs');
        $stmt->execute();
        ?>
        <div class="job-table">
            <table>
                <tr><th>ID</th><th>User ID</th><th>Title</th><th>Description</th><th>Skills</th><th>Income</th><th>Company Name</th><th>Action</th></tr>
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['job_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['users_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['job_title']); ?></td>
                        <?php $description = htmlspecialchars($row['job_description']); 
                        $truncatedDescription = mb_strimwidth($description, 0, 45, "..."); 
                        echo "<td>" . $truncatedDescription . "</td>";?>
                        <?php $skills = htmlspecialchars($row['job_skills']);
                        $truncatedSkills = mb_strimwidth($skills, 0, 20, "...");
                        echo "<td>" . $truncatedSkills . "</td>"; ?>

                        <td><?php echo htmlspecialchars($row['job_income']); ?></td>
                        <td><?php echo htmlspecialchars($row['job_compname']); ?></td>
                        <td>
                            <form action='includes/delete_job.inc.php' method='post'>
                                <input type='hidden' name='job_id' value='<?php echo htmlspecialchars($row['job_id']); ?>'>
                                <button type='submit' class='delete'>Delete Job</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</body>
</html>
