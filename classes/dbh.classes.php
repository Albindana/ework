<?php

class Dbh { 

    public function connect() {
        try {
            $username = "root";
            $password = "";
            $dbp = new PDO('mysql:host=localhost;dbname=ework', $username, $password);
            return $dbp;
        } catch (PDOExeption $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
} 