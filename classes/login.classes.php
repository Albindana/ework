<?php

class Login extends Dbh{


    protected function getUser($uname, $password) {
        session_start();
        $stmt = $this->connect()->prepare('SELECT users_password, isAdmin FROM users WHERE users_uname = ? OR users_email = ?;');

        if(!$stmt->execute(array($uname, $uname)))
        {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() == 0) 
        {
            $stmt = null;
            $_SESSION["error"] = "User not found!";
            header("location: ../login.php");
            exit();
        }
        
        $pwdHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPwd = password_verify($password, $pwdHashed[0]["users_password"]);
        
        if($checkPwd == false) 
        {
            $stmt = null;
            $_SESSION["error"] = "Wrong Password";
            header("location: ../login.php");
            exit();
            return false;
        }
        elseif($checkPwd == true){
            $stmt = $this->connect()->prepare('SELECT * FROM users WHERE users_uname = ? OR users_email = ? AND users_password = ?;');

            if(!$stmt->execute(array($uname, $uname, $password)))
            {
                $stmt = null;
                $_SESSION["error"] = "Statement Failed";
                header("location: ../login.php");
                exit();
            }
            if($stmt->rowCount() == 0) 
            {
                $stmt = null;
                $_SESSION["error"] = "User not found";
                header("location: ../login.php");
                exit();
            }

            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            session_start();
            $_SESSION["userid"] = $user[0]["users_id"];
            $_SESSION["useruname"] = $user[0]["users_uname"];
            $_SESSION["isAdmin"] = $user[0]["isAdmin"];
            $stmt = null;
            return true;
        }
    }
}


