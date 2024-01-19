<?php
session_start();
include '../classes/dbh.classes.php';
require_once '../classes/job.classes.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jobTitle = $_POST['job_title'];
    $jobCompName = $_POST['job_compname'];
    $jobDescription = $_POST['job_description'];
    $jobSkills = $_POST['job_skills'];
    $jobIncome = $_POST['job_income'];
    $userId = $_SESSION["userid"];
 

    $job = new Job();
    $job->insertJob($userId, $jobTitle, $jobDescription, $jobSkills, $jobIncome, $jobCompName);

    header("Location: ../index.php"); // Redirect to the home page after inserting the job
} else {
    // Handle the case where the form wasn't submitted via POST
    echo "Form was not submitted correctly.";
}
