<?php
session_start();
include '../classes/dbh.classes.php';
include '../classes/job.classes.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jobId = $_POST['job_id'];
    $userId = $_SESSION["userid"];

    $job = new Job();
    $job->deleteJob($userId, $jobId);

    header("Location: ../find.php"); // Redirect to the post page after deleting the job
} else {
    echo "Form was not submitted correctly.";
}
