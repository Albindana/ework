<?php
session_start();

if (isset($_POST['userId'])) {
    $userId = $_POST['userId'];
    $isEmployer = isset($_SESSION['isEmployer']) && $_SESSION['isEmployer'] ? 0 : 1;

    include '../classes/dbh.classes.php';
    include '../classes/role.classes.php';

    $role = new Role();
    $role->changeRole($userId, $_SESSION['isEmployer']);

    $_SESSION['isEmployer'] = $isEmployer;

    header("Location: ../profile.php");
    exit();
}
?>
