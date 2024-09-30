<?php
include_once 'dbh.classes.php';

class Punetoret extends Dbh
{
    private $DepartmentID;
    private $Name;
    private $Surname;
    private $Birthyear;

    public function __construct($DepartmentID, $Name, $Surname, $Birthyear)
    {
        $this->DepartmentID = $DepartmentID;
        $this->Name = $Name;
        $this->Surname = $Surname;
        $this->Birthyear = $Birthyear;
    }
    public function getPunetoret()
    {
        $sql = "SELECT * FROM employee WHERE EmployeeID = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$this->DepartmentID]);
        return $stmt->fetch();
    }

    public function insertPunetoret()
    {
        $sql = "SELECT * FROM employee WHERE EmployeeID = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$this->DepartmentID]);
        $employee = $stmt->fetch();

        if ($employee) {
            $sql = "UPDATE employee  SET e_name = ?, e_surname = ?, e_birthyear = ? WHERE Employee_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$this->Name, $this->Surname, $this->Birthyear]);
        } else {
            $sql = "INSERT Into employee (e_name, e_surname, e_birthyear) VALUES (?,?,?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$this->Name, $this->Surname, $this->Birthyear]);
        }
    }
}