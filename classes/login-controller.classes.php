<?php

    class LoginContr extends Login {

        private $uname;
        private $password;

        public function __construct($uname, $password) {
            $this->uname = $uname;
            $this->password = $password;

        }

        public function loginUser(){
            if($this->emptyInput() == true) {
                header("location: ../index.php?error=emptyinput");
                exit();
            }
        

            if ($this->getUser($this->uname, $this->password)) {
                header("location: ../index.php");
                exit();
            } else {
                header("location: ../login.php?error=wrongcredentials");
                exit();
            }
        }
        
        private function emptyInput() {
            $result;
            if(empty($this->uname) || empty($this->password)) {
                $result = true;  
            } else {
                $result = false; 
            }
            return $result;
        }
        

    }