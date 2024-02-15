<?php
include '../classes/dbh.classes.php';
if (isset($_POST['jobId'])) {
    $jobId = $_POST['jobId'];

    $db = new Dbh();
    $pdo = $db->connect();
    $sql = "SELECT applications.*, users.users_uname, users.users_email FROM applications JOIN users ON applications.user_id = users.users_id WHERE applications.job_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$jobId]);
    $applications = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($applications as $application) {
        echo '<div class="application" data-user-id="' . htmlspecialchars($application['user_id']) . '">';
        echo '<p><strong>Applicant:</strong> ' . htmlspecialchars($application['users_uname']) . '</p>';
        echo '<p><strong>Email:</strong> ' . htmlspecialchars($application['users_email']) . '</p>';
        echo '<p><strong>Applied At:</strong> ' . htmlspecialchars($application['application_date']) . '</p>';
        echo '</div>';
    }

}
?>