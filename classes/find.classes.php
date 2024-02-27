<?php 
include_once 'dbh.classes.php';
class find extends Dbh{
    
    // protected $pdo;

    // public function __construct()
    // {
    //     $db = new Dbh();
    //     $this->pdo = $db->connect();
    // }

    public function searchJobs($searchTerm) {
               
        // $stmt = $pdo->prepare("SELECT * FROM jobs WHERE title = :searchTerm OR description LIKE :searchTerm");
        // $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
        // $stmt->execute();
        // $searchResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        
        $searchTerm = '%' . $searchTerm . '%';

        $sql = "SELECT * FROM jobs WHERE title LIKE ? OR description LIKE ?";                                                 
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute($searchTerm);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
}
// Assuming $pdo is your PDO connection

