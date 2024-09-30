<?php
session_start();
include '../classes/dbh.classes.php';
require_once '../classes/department.classes.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Number = $_POST['d_Number'];
    $Name = $_POST['d_Name'];

    $department = new Department($Number, $Name);
    $department->insertDepartment($Number, $Name);

    echo 'Successfull';
} else {
    echo 'error occured';
}
