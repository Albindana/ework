<?php

class CvContr extends Cv
{
    private $userId;
    private $motivationalLetter;
    private $skills;
    private $address;
    private $phoneNumber;
    private $country;
    private $city;
    private $degree;
    private $pImage;

    public function __construct($userId, $motivationalLetter, $skills, $address, $phoneNumber, $country, $city, $degree, $pImage)
    {
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

    public function createOrUpdateCv()
    {
        session_start();
        if ($this->emptyInput() == false) {
            $_SESSION["error"] = "Empty Input";
            header('location: ../cv.php');
            exit();
        }
        $this->insertCv();
        $_SESSION["success"] = "Cv Uploaded Successfully";
        header("location: ../cv.php");
    }

    private function emptyInput()
    {
        if (empty($this->userId) || empty($this->motivationalLetter) || empty($this->skills) || empty($this->address) || empty($this->phoneNumber) || empty($this->country) || empty($this->city) || empty($this->degree)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}
