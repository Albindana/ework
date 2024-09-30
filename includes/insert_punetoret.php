<?php
include "../classes/dbh.classes.php";
include "../classes/punetoret.classes.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Name = $_SESSION["e_name"];
    $Surame = $_SESSION["e_surname"];
    $Birthyear = $_SESSION["e_birthyear"];
    try {
        $punetoret = new Punetoret($DepartmentID, $Name, $Surname, $Birthyear);
        $punetoret->insertPunetoret();
        echo "Success";
        header('location: ../cv.php');
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}