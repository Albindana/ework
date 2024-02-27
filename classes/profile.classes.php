<?php
include 'dbh.classes.php';
class Profile extends Dbh {

    protected function setProfile($uname, $new_password) {
        $stmt = $this->connect()->prepare('UPDATE users SET users_uname = ?, users_password = ? WHERE users_id = ?;');

        $hashedPwd = password_hash($new_password, PASSWORD_DEFAULT);

        if(!$stmt->execute(array($uname, $hashedPwd, $_SESSION["userid"])))
        {
            $stmt = null;
            header("location: ../profile.php?error=stmtfailed");
            exit();
        }
        $stmt = null;
    }

    protected function checkUser($uname) {
        $stmt = $this->connect()->prepare('SELECT users_uname FROM users WHERE users_uname = ?;');

        if(!$stmt->execute(array($uname)))
        {
            $stmt = null;
            header("location: ../profile.php?error=stmtfailed");
            exit();
        }

        $resultCheck;
        if($stmt->rowCount() > 0) {
            $resultCheck = false;
            return false;
        }
        else {
            $resultCheck = true;
            return true;
        }
        return $resultCheck;
    }
        
    protected function validateOldPassword($password) {
        $stmt = $this->connect()->prepare('SELECT users_password FROM users WHERE users_id = ?;');
        $stmt->execute(array($_SESSION["userid"]));
        $old_password = $stmt->fetch(PDO::FETCH_ASSOC)["users_password"];
        
        return password_verify($password, $old_password);
    }
        
}