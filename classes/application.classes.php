<?php
class Application extends Dbh
{

    public function hasApplied($userId, $jobId)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM applications WHERE user_id = ? AND job_id = ?;');
        $stmt->execute([$userId, $jobId]);
        return $stmt->rowCount() > 0;
    }

    public function isJobPoster($userId, $jobId)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM jobs WHERE users_id = ? AND job_id = ?;');
        $stmt->execute([$userId, $jobId]);
        return $stmt->rowCount() > 0;
    }

    public function hasCv($userId)
    {
        $sql = "SELECT * FROM cv WHERE users_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userId]);
        $cv = $stmt->fetch();
        return $cv ? $cv['cv_id'] : false;
    }


    public function applyForJob($userId, $jobId, $cv_id)
    {
        if ($this->isJobPoster($userId, $jobId)) {
            $stmt = null;
            $_SESSION["error"] = "You cannot apply to your own job.";
            header("location: ../find.php");
            exit();
        }

        if ($this->hasApplied($userId, $jobId)) {
            $stmt = null;
            $_SESSION["error"] = "You have already applied for this job.";
            header("location: ../find.php");
            exit();
        }
        if ($cv_id) {
            $sql = "INSERT INTO applications (job_id, user_id, cv_id) VALUES (?, ?, ?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$jobId, $userId, $cv_id]);
            $_SESSION["success"] = "Application submitted successfully!";
            header("location: ../find.php");
            exit();
        } else {
            $_SESSION["error"] = "You should upload your CV first!";
        }



        $stmt = $this->connect()->prepare('INSERT INTO applications (job_id, user_id) VALUES (?, ?);');
        $stmt->execute([$jobId, $userId]);

        $_SESSION["success"] = "Application submitted successfully!";
        header("location: ../find.php");
        exit();
    }
}
