<?php
session_start();
include '../classes/dbh.classes.php';
include '../classes/job.classes.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jobId = $_POST['job_id'];
    $userId = $_SESSION["userid"];

    $job = new Job();
    $job->deleteJob($userId, $jobId);

    // Redirect to the appropriate page based on the user's admin status
    if ($_SESSION['isAdmin'] == 1) {
        header("Location: ../find.php");
    } else {
        header("Location: ../find.php");
    }
    exit();
} else {
    echo "Form was not submitted correctly.";
}
?>
