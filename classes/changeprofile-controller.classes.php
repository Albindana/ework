<?php
include 'profile.classes.php';
class ChangeProfileController extends Profile {
    private $uname;
    private $password;
    private $new_password;

    public function __construct($new_username, $password, $new_password) {
        $this->uname = $new_username;
        $this->password = $password;
        $this->new_password = $new_password;
    }

    public function changeProfile(){
        session_start();
        if($this->emptyInput() == false) {
            $_SESSION["error"] = "Empty Input";
            header("location: ../profile.php");
            exit();
        }
        if($this->invalidUname() == false) {
            $_SESSION["error"] = "Invalid Username";
            header("location: ../profile.php");
            exit();
        }
        if($this->passwordMatch() == false) {
            $_SESSION["error"] = "Old and new passwords are the same!";
            header("location: ../profile.php");
            exit();
        }
        if($this->unameTakenController() == false) {
            $_SESSION["error"] = "Username already taken";
            header("location: ../profile.php");
            exit();
        }
        if($this->checkOldPassword() == false) {
            $_SESSION["error"] = "Your password is incorrect";
            header("location: ../profile.php");
            exit();
        }
        if($this->tooLongUname() == false) {
            $_SESSION["error"] = "Username should not be longer than 16 characters!";
            header("location: ../profile.php");
            exit();
        }
        if($this->shortPass() == false) {
            $_SESSION["error"] = "Password should have 8 or more characters!";
            header("location: ../profile.php");
            exit();
        }
    
        $this->setProfile($this->uname, $this->new_password);
        header("location: ../profile.php");
        
    }
    
    private function checkOldPassword() {
        $result;
        if(!$this->validateOldPassword($this->password)) {
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }
    

    private function emptyInput() {
        $result;
        if(empty($this->uname) || empty($this->password) || empty($this->new_password)) {
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function invalidUname() {
        $result;
        if(!preg_match("/^[a-zA-Z0-9]*$/", $this->uname)) {
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function passwordMatch() {
        $result;
        if($this->password === $this->new_password) {
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function unameTakenController() {
        $result;
        if(!$this->checkUser($this->uname)) {
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function tooLongUname() {
        $result;
        if(strlen($this->uname) > 16) {
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }
    private function shortPass(){
        $result;
        if(strlen($this->new_password) < 8){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }
}