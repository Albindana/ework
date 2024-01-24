
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
    // Check if the job belongs to the user or the user is an admin
    $sql = "SELECT * FROM jobs WHERE job_id = ? AND (users_id = ? OR ? = 1)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$jobId, $userId, $_SESSION['isAdmin']]);
    if($stmt->rowCount() > 0) {
        // Start a transaction
        $this->pdo->beginTransaction();

        try {
            // Delete associated records in the applications table
            $stmt = $this->pdo->prepare('DELETE FROM applications WHERE job_id = ?');
            $stmt->execute([$jobId]);

            // If the job belongs to the user or the user is an admin, delete the job
            $sql = "DELETE FROM jobs WHERE job_id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$jobId]);

            // Commit the transaction
            $this->pdo->commit();

            return true;
        } catch (PDOException $e) {
            // Roll back the transaction if something failed
            $this->pdo->rollBack();
            echo "Error: " . $e->getMessage();
            return false;
        }
    } else {
        // If the job does not belong to the user and the user is not an admin, return false
        return false;
    }
}




}
