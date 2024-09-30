<?php
include_once 'dbh.classes.php';
class Department extends Dbh
{
    protected $pdo;
    protected $Number;
    protected $Name;

    public function __construct($Number, $Name)
    {
        $db = new Dbh();
        $this->pdo = $db->connect();
        $this->Number = $Number;
        $this->Name = $Name;
    }

    public function insertDepartment($Number, $Name)
    {
        $sql = "INSERT INTO department (d_Number, d_Name) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$this->Number, $this->Name]);

    }
}