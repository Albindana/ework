<?php
    
    session_start();
    var_dump($_POST);

    
    include '../classes/changeprofile-controller.classes.php';
    $controller = new ChangeProfileController($_POST["new_username"], $_POST["old_password"], $_POST["new_password"]);
    $controller->changeProfile();

    if (!isset($_SESSION["userid"])) {
        header("location: login.php");
        exit();
    }

    // Include your database connection file here
    include '../classes/dbh.classes.php';

    // Create an instance of the Dbh class
    $dbh = new Dbh();

    // Check if new_username or new_password is set and not empty
    if (isset($_POST["new_username"]) && !empty($_POST["new_username"])) {
        $new_username = $_POST["new_username"];
        echo "New Username: " . $new_username; // Echo new_username
        $stmt = $dbh->connect()->prepare('UPDATE users SET users_uname = ? WHERE users_id = ?;');
        $stmt->execute(array($new_username, $_SESSION["userid"]));
    
        // Re-fetch the user's information from the database
        $stmt = $dbh->connect()->prepare('SELECT * FROM users WHERE users_id = ?;');
        $stmt->execute(array($_SESSION["userid"]));
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Update the username in the session
        $_SESSION["useruname"] = $user["users_uname"];
    }
    

    if (isset($_POST["new_password"]) && !empty($_POST["new_password"])) {
        $new_password = password_hash($_POST["new_password"], PASSWORD_DEFAULT);
        echo "New Password: " . $new_password; // Echo new_password
        $stmt = $dbh->connect()->prepare('UPDATE users SET users_password = ? WHERE users_id = ?;');
        $stmt->execute(array($new_password, $_SESSION["userid"]));
    }
        $_SESSION["useruname"] = $new_username;
        header("location: ../profile.php?success=profileupdated");
?>