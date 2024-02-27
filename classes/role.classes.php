<?php
include_once 'dbh.classes.php';

class Role extends Dbh {

    public function changeRole($userId, $isEmployer){
        $db = $this->connect();
        if($isEmployer == 1){
            $stmt = $db->prepare('UPDATE users SET isEmployer = 0 WHERE users_id = ?');
        }
        else{
            $stmt = $db->prepare('UPDATE users SET isEmployer = 1 WHERE users_id = ?');
        }
        $result = $stmt->execute([$userId]);
        
    }
}
?>
