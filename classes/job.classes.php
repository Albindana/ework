
<?php
include_once 'dbh.classes.php';
class Job extends Dbh {
    protected $pdo;

    public function __construct()
    {
        $db = new Dbh();
        $this->pdo = $db->connect();
    }

    public function insertJob($userId, $jobTitle, $jobDescription, $jobSkills, $jobIncome, $jobCompName)
    {
        $sql = "INSERT INTO jobs (users_id, job_title, job_description, job_skills, job_income, job_compname) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId, $jobTitle, $jobDescription, $jobSkills, $jobIncome, $jobCompName]);
    }

    public function hasPostedJob($userId) {
        $sql = "SELECT * FROM jobs WHERE users_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->rowCount() > 0;
    }
    public function deleteJob($userId, $jobId)
{
<<<<<<< HEAD
    // Check if the job belongs to the user
    $sql = "SELECT * FROM jobs WHERE users_id = ? AND job_id = ?";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$userId, $jobId]);
    if($stmt->rowCount() > 0) {
        // If the job belongs to the user, delete the job
=======
    // Check if the job belongs to the user or the user is an admin
    $sql = "SELECT * FROM jobs WHERE job_id = ? AND (users_id = ? OR ? = 1)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$jobId, $userId, $_SESSION['isAdmin']]);
    if($stmt->rowCount() > 0) {
        // If the job belongs to the user or the user is an admin, delete the job
>>>>>>> semi-branch
        $sql = "DELETE FROM jobs WHERE job_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$jobId]);
        return true;
    } else {
<<<<<<< HEAD
        // If the job does not belong to the user, return false
=======
        // If the job does not belong to the user and the user is not an admin, return false
>>>>>>> semi-branch
        return false;
    }
}

<<<<<<< HEAD
=======

>>>>>>> semi-branch
    
}
