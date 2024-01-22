<?php
session_start();
include '../classes/dbh.classes.php';
include '../classes/job.classes.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jobId = $_POST['job_id'];
    $userId = $_SESSION["userid"];

    $job = new Job();
    $job->deleteJob($userId, $jobId);

<<<<<<< HEAD
    header("Location: ../find.php"); // Redirect to the post page after deleting the job
} else {
    echo "Form was not submitted correctly.";
}
=======
    // Redirect to the appropriate page based on the user's admin status
    if ($_SESSION['isAdmin'] == 1) {
        header("Location: ../adminPanel.php");
    } else {
        header("Location: ../find.php");
    }
    exit();
} else {
    echo "Form was not submitted correctly.";
}
?>
>>>>>>> semi-branch
