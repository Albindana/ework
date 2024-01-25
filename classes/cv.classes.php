<?php
include_once 'dbh.classes.php';

class Cv extends Dbh {
    private $userId;
    private $motivationalLetter;
    private $skills;
    private $address;
    private $phoneNumber;
    private $country;
    private $city;
    private $degree;
    private $pImage;

    public function __construct($userId,$motivationalLetter, $skills, $address, $phoneNumber, $country, $city, $degree, $pImage) {
        $this->userId = $userId;
        $this->motivationalLetter = $motivationalLetter;
        $this->skills = $skills;
        $this->address = $address;
        $this->phoneNumber = $phoneNumber;
        $this->country = $country;
        $this->city = $city;
        $this->degree = $degree;
        $this->pImage = $pImage;
    }
    
    public function getCv() {
        $sql = "SELECT * FROM cv WHERE users_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$this->userId]);
        return $stmt->fetch();
    }

    public function insertCv() {
        // First, check if a CV already exists for this user
        $sql = "SELECT * FROM cv WHERE users_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$this->userId]);
        $cv = $stmt->fetch();
    
        if ($cv) {
            // If a CV already exists, update it
            $sql = "UPDATE cv SET cv_motivationalLetter = ?, cv_skills = ?, cv_address = ?, cv_phoneNumber = ?, cv_country = ?, cv_city = ?, cv_degree = ?, cv_pImage = ? WHERE users_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$this->motivationalLetter, $this->skills, $this->address, $this->phoneNumber, $this->country, $this->city, $this->degree, $this->pImage, $this->userId]);
        } else {
            // If no CV exists, insert a new one
            $sql = "INSERT INTO cv (users_id, cv_motivationalLetter, cv_skills, cv_address, cv_phoneNumber, cv_country, cv_city, cv_degree, cv_pImage) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$this->userId, $this->motivationalLetter, $this->skills, $this->address, $this->phoneNumber, $this->country, $this->city, $this->degree, $this->pImage]);
        }
    }
}
?>
