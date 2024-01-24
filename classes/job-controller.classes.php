<?php
require_once 'job.classes.php';

class JobController extends Job {
    private $userId;
    private $jobTitle;
    private $jobDescription;
    private $jobSkills;
    private $jobIncome;
    private $jobCompName;

    public function __construct($userId, $jobTitle, $jobDescription, $jobSkills, $jobIncome, $jobCompName)
    {
        parent::__construct();
        $this->userId = $userId;
        $this->jobTitle = $jobTitle;
        $this->jobDescription = $jobDescription;
        $this->jobSkills = $jobSkills;
        $this->jobIncome = $jobIncome;
        $this->jobCompName = $jobCompName;
    }

    public function validateAndInsertJob()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if($this->emptyInput() == false) {
            $_SESSION["error"] = "Empty Input!";
            header("location: ../post.php");
            exit();
        }
        if($this->invalidJobTitle() == false) {
            $_SESSION["error"] = "Job title should not exceed 60 words.";
            header("location: ../post.php");
            exit();
        }
        if($this->invalidJobCompName() == false) {
            $_SESSION["error"] = "Company name should not exceed 60 words.";
            header("location: ../post.php");
            exit();
        }
        $this->insertJob($this->userId, $this->jobTitle, $this->jobDescription, $this->jobSkills, $this->jobIncome, $this->jobCompName);
        header("Location: ../index.php");
    }

    private function emptyInput() {
        $result;
        if(empty($this->jobTitle) || empty($this->jobCompName) || empty($this->jobDescription) || empty($this->jobSkills) || empty($this->jobIncome)) {
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function invalidJobTitle() {
        $result;
        if(strlen($this->jobTitle) > 60) {
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }
    
    private function invalidJobCompName() {
        $result;
        if(strlen($this->jobCompName) > 60) {
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }
    
}
?>
