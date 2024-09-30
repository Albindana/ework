<?php
include '../classes/dbh.classes.php';
include '../classes/cv.classes.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['userId'])) {
        echo 'Error: User ID is not set.';
        exit();
    }

    $userId = $_POST['userId'];

    $db = new Dbh();
    $pdo = $db->connect();
    $sql = "SELECT * FROM cv WHERE users_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userId]);
    $cv = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($cv) {

        echo '<img src="' . htmlspecialchars($cv['cv_pImage']) . '" alt="CV Image" class="cv-image">';
        echo '<p><strong>Motivational Letter:</strong> ' . htmlspecialchars($cv['cv_motivationalLetter']) . '</p>';
        echo '<p><strong>Skills:</strong> ' . htmlspecialchars($cv['cv_skills']) . '</p>';
        echo '<p><strong>Address:</strong> ' . htmlspecialchars($cv['cv_address']) . '</p>';
        echo '<p><strong>Phone Number:</strong> ' . htmlspecialchars($cv['cv_phoneNumber']) . '</p>';
        echo '<p><strong>Country:</strong> ' . htmlspecialchars($cv['cv_country']) . '</p>';
        echo '<p><strong>City:</strong> ' . htmlspecialchars($cv['cv_city']) . '</p>';
        echo '<p><strong>Degree:</strong> ' . htmlspecialchars($cv['cv_degree']) . '</p>';
    } else {
        echo 'This user does not have a CV.';
    }
} else {
    echo 'Error: Invalid request method.';
}
?>