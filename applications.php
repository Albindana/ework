<?php
session_start();
include 'classes/dbh.classes.php';
include 'classes/job.classes.php';

$userId = $_SESSION["userid"];

$db = new Dbh();
$pdo = $db->connect();
$sql = "SELECT applications.*, users.users_uname, users.users_email, jobs.job_title FROM applications JOIN users ON applications.user_id = users.users_id JOIN jobs ON applications.job_id = jobs.job_id WHERE jobs.users_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$userId]);
$applications = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Applications</title>
</head>
<body>
    <h1>Job Applications</h1>
    <?php foreach ($applications as $application): ?>
        <div>
            <h2><?php echo htmlspecialchars($application['job_title']); ?></h2>
            <p><strong>Applicant:</strong> <?php echo htmlspecialchars($application['users_uname']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($application['users_email']); ?></p>
            <p><strong>Applied At:</strong> <?php echo htmlspecialchars($application['application_date']); ?></p>
        </div>
    <?php endforeach; ?>
</body>
</html>
