<!-- 
-- Tabela e Ekipeve
CREATE TABLE Team (
  TeamId INT AUTO_INCREMENT PRIMARY KEY,
  Name VARCHAR(255) NOT NULL
);

-- Tabela e Lojtarëve
CREATE TABLE Player (
  PlayerId INT AUTO_INCREMENT PRIMARY KEY,
  Name VARCHAR(255) NOT NULL,
  Number INT,
  TeamId INT,
  FOREIGN KEY (TeamId) REFERENCES Team(TeamId) ON DELETE CASCADE
); -->




<?php
// Lidhja me bazën e të dhënave
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ework";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kontrollo lidhjen
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


//============== KODI PER FUNKSIONET ======================
//#1 insert team

// Kontrollo nëse të dhënat janë dërguar me metodën POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $team_name = $_POST['team_name'];

        // Kontrollo nëse emri i ekipit është i plotësuar
        if (!empty($team_name)) {
            // Insertimi i ekipit në bazën e të dhënave
            $sql = "INSERT INTO Team (Name) VALUES ('$team_name')";
            
            if ($conn->query($sql) === TRUE) {
            echo "Ekipi u shtua me sukses!";
            } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Emri i ekipit është i detyrueshëm!";
        }
        }

                    //#2 insert player ============


        // Proceso formën për të shtuar lojtarë
        if (isset($_POST['player_name']) && isset($_POST['player_number']) && isset($_POST['team_id'])) {
            $player_name = $_POST['player_name'];
            $player_number = $_POST['player_number'];
            $team_id = $_POST['team_id'];
        
            if (!empty($player_name) && !empty($player_number) && !empty($team_id)) {
            $sql = "INSERT INTO Player (Name, Number, TeamId) VALUES ('$player_name', '$player_number', '$team_id')";
            
            if ($conn->query($sql) === TRUE) {
                echo "Lojtari u shtua me sukses!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            } else {
            echo "Të gjitha fushat janë të detyrueshme!";
            }
        }
  
                    // #3 delete  =====

        // Proceso kërkesën për fshirje të lojtarit
        if (isset($_POST['delete_player_id'])) {
            $player_id = $_POST['delete_player_id'];
        
            if (!empty($player_id)) {
            $sql = "DELETE FROM Player WHERE PlayerId = '$player_id'";
            
                if ($conn->query($sql) === TRUE) {
                    echo "Lojtari u fshi me sukses!";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
            echo "ID-ja e lojtarit është e detyrueshme!";
            }
        }
  
                // #4 update ========

        // Proceso formën për përditësimin e ekipit
        if (isset($_POST['edit_team_id']) && isset($_POST['edit_team_name'])) {
            $team_id = $_POST['edit_team_id'];
            $team_name = $_POST['edit_team_name'];
        
            if (!empty($team_id) && !empty($team_name)) {
            $sql = "UPDATE Team SET Name = '$team_name' WHERE TeamId = '$team_id'";
            
            if ($conn->query($sql) === TRUE) {
                echo "Ekipi u përditësua me sukses!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            } else {
            echo "Të gjitha fushat janë të detyrueshme!";
            }
        }
        
        // Pas përpunimit të përditësimit, ridrejtohu në index.php
        header("Location: index.php");
        exit();
  

// Mbyll lidhjen
$conn->close();

// Ridrejto te index.php
header("Location: index.php");
exit();
?>
