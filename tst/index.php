<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Insert Team</title>
</head>
<body>
  <h2>Shto Ekip të Ri</h2>
  <form id="teamForm" method="POST" action="back.php">
    <label for="team_name">Emri i Ekipit:</label>
    <input type="text" id="team_name" name="team_name" required>
    <button type="submit">Shto Ekipin</button>
  </form>

  <h2>Lista e Ekipeve</h2>
  <table border="solid 2px black" id="teamList">
    <?php
    // Lidhja me bazën e të dhënave për të marrë ekipet
    $conn = new mysqli("localhost", "root", "", "ework");

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM Team";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr><td>" . $row['Name'] . "</td><td> 
                <form method='GET' action='index.php' style='display:inline;'>
                  <input type='hidden' name='edit_team_id' value='" . $row['TeamId'] . "'>
                  <button type='submit'>Edit</button>
                </form>
                </td></tr>";
        }
      } else {
        echo "<li>Nuk ka ekipe të regjistruara.</li>";
      }
    ?>
  </table>








  <!-- Forma për të shtuar lojtarë -->
<h2>Shto Lojtar të Ri</h2>
<form id="playerForm" method="POST" action="back.php">
  <input type="text" name="player_name" placeholder="Emri i Lojtarit" required><br><br>
  <input type="number" name="player_number" placeholder="Numri i Lojtarit" required><br><br>
  <select name="team_id" required>
    <option value="">Zgjidh Ekipin</option>
    <?php
    $sql = "SELECT * FROM Team";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['TeamId'] . "'>" . $row['Name'] . "</option>";
      }
    } else {
      echo "<option value=''>Asnjë ekip i regjistruar</option>";
    }
    ?>
  </select><br><br>
  <button type="submit">Shto Lojtarin</button>
</form>

<!-- Shfaq lista e lojtarëve -->
<h2>Lista e Lojtarëve</h2>
<table border="2px solid black" id="playerList">
  <?php
  $sql = "SELECT Player.PlayerId, Player.Name AS PlayerName, Player.Number, Team.Name AS TeamName
  FROM Player
  INNER JOIN Team ON Player.TeamId = Team.TeamId";
$result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo "<tr><td>" . $row['PlayerName'] . " (Nr: " . $row['Number'] . ") - Ekipi: " . $row['TeamName'] . "</td>";
      echo "<td><form style='display:inline;' method='POST' action='back.php'>
              <input type='hidden' name='delete_player_id' value='" . $row['PlayerId'] . "'>
              <button type='submit'>Fshije</button>
            </form></td></tr>";
    }
  } else {
    echo "<tr><td>Nuk ka lojtarë të regjistruar.</td></tr>";
  }
  ?>
</table>

<hr>

    <?php
    // Kontrollo nëse është zgjedhur një ekip për përditësim
    if (isset($_GET['edit_team_id'])) {
        $edit_team_id = $_GET['edit_team_id'];
        $sql = "SELECT * FROM Team WHERE TeamId = '$edit_team_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $edit_team_name = $row['Name'];
        }
    ?>
    <!-- Forma për përditësimin e ekipit -->
    <h2>Përditëso Ekipin</h2>
    <form method="POST" action="back.php">
      <input type="hidden" name="edit_team_id" value="<?php echo $edit_team_id; ?>">
      <input type="text" name="edit_team_name" value="<?php echo $edit_team_name; ?>" required>
      <button type="submit">Përditëso Ekipin</button>
    </form>
  <?php } ?>
</body>
</html>
