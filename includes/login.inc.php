<?php

if(isset($_POST["submit"]))
{
    $uname = $_POST["uname"];
    $password = $_POST["password"];

    include '../classes/dbh.classes.php';
    include '../classes/login.classes.php';
    include '../classes/login-controller.classes.php';

    $login = new LoginContr($uname, $password);

    if ($login->loginUser()) {
        // Redirect only if login is successful
        header("location: ../index.php");
        exit();
    } else {
        // Redirect with an error message if login fails
        header("location: ../login.php?error=wrongcredentials");
        exit();
    }
}
