<?php

class SignupContr extends Signup
{
    private $uname;
    private $email;
    private $password;
    private $confirm_password;

    public function __construct($uname, $email, $password, $confirm_password)
    {
        $this->uname = $uname;
        $this->email = $email;
        $this->password = $password;
        $this->confirm_password = $confirm_password;

    }

    public function signupUser()
    {
        session_start();
        if ($this->emptyInput() == false) {
            $_SESSION["error"] = "Empty Input";
            header("location: ../signup.php");
            exit();
        }
        if ($this->invalidUname() == false) {
            $_SESSION["error"] = "Invalid Username";
            header("location: ../signup.php");
            exit();
        }
        if ($this->invalidEmail() == false) {
            $_SESSION["error"] = "Invalid Email";
            header("location: ../signup.php");
            exit();
        }
        if ($this->passwordMatch() == false) {
            $_SESSION["error"] = "Passwords don't match!";
            header("location: ../signup.php");
            exit();
        }
        if ($this->unameTakenController() == false) {
            $_SESSION["error"] = "Username already taken";
            header("location: ../signup.php");
            exit();
        }
        if ($this->tooLongUname() == false) {
            $_SESSION["error"] = "Username should not be longer than 16 characters!";
            header("location: ../signup.php");
            exit();
        }
        if ($this->shortPass() == false) {
            $_SESSION["error"] = "Password should have 8 or more characters!";
            header("location: ../signup.php");
            exit();
        }
        $this->setUser($this->uname, $this->password, $this->email);
    }

    private function emptyInput()
    {

        if (empty($this->uname) || empty($this->email) || empty($this->password) || empty($this->confirm_password)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function invalidUname()
    {

        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->uname)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function invalidEmail()
    {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function passwordMatch()
    {

        if ($this->password !== $this->confirm_password) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function unameTakenController()
    {

        if (!$this->checkUser($this->uname, $this->email)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
    private function tooLongUname()
    {

        if (strlen($this->uname) > 16) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
    private function shortPass()
    {

        if (strlen($this->password) < 8) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

}