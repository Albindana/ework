<?php
if (isset($_POST['userId'])) {
    $userId = $_POST['userId'];

    // Connect to the database using your Dbh class
    include '../classes/dbh.classes.php';
    $dbh = new Dbh();
    $db = $dbh->connect();

    // Start a transaction
    $db->beginTransaction();

    try {
        // Delete associated records in the applications table
        $stmt = $db->prepare('DELETE FROM applications WHERE user_id = ?');
        $stmt->execute([$userId]);

        // Delete the user
        $stmt = $db->prepare('DELETE FROM cv WHERE users_id = ?');
        $stmt->execute([$userId]);

        // Delete associated records in the jobs table
        $stmt = $db->prepare('DELETE FROM jobs WHERE users_id = ?');
        $stmt->execute([$userId]);

        // Delete the user
        $stmt = $db->prepare('DELETE FROM users WHERE users_id = ?');
        $stmt->execute([$userId]);

        // Commit the transaction
        $db->commit();

        header("Location: ../adminPanel.php");
        exit();
    } catch (PDOException $e) {
        // Roll back the transaction if something failed
        $db->rollBack();
        echo "Error: " . $e->getMessage();
    }
}
?>
