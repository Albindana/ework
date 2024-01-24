<?php
session_start();
include '../classes/dbh.classes.php';
require_once '../classes/job.classes.php';
include_once '../classes/job-controller.classes.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jobTitle = $_POST['job_title'];
    $jobCompName = $_POST['job_compname'];
    $jobDescription = $_POST['job_description'];
    $jobSkills = $_POST['job_skills'];
    $jobIncome = $_POST['job_income'];
    $userId = $_SESSION["userid"];
 

    $job = new JobController($userId, $jobTitle, $jobDescription, $jobSkills, $jobIncome, $jobCompName);
    $job->validateAndInsertJob();

    
} else{
    echo 'error occured';
}
