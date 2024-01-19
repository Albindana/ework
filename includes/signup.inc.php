<?php

if(isset($_POST["submit"]))
{
    $uname = $_POST["uname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    include '../classes/dbh.classes.php';
    include '../classes/signup.classes.php';
    include '../classes/signup-controller.classes.php';
    $signup = new SignupContr($uname, $email, $password, $confirm_password);

    $signup->signupUser();

    header("location: ../login.php");
}