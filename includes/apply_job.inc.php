<?php
session_start();
include '../classes/dbh.classes.php';
include '../classes/job.classes.php';
include '../classes/application.classes.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jobId = $_POST['job_id'];
    $userId = $_SESSION["userid"];

    $application = new Application();
    $cv_id = $application->hasCv($userId);

    $message = $application->applyForJob($userId, $jobId, $cv_id);

    echo $message;
} else {
    echo "Form was not submitted correctly.";
}

