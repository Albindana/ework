<?php
if (isset($_POST['userId'])) {
    $userId = $_POST['userId'];

    // Connect to the database using your Dbh class
    include '../classes/dbh.classes.php';
    $dbh = new Dbh();
    $db = $dbh->connect();

    $stmt = $db->prepare('UPDATE users SET isAdmin = 1 WHERE users_id = ?');
    $stmt->execute([$userId]);

    header("Location: ../adminPanel.php");
    exit();
}
?>
