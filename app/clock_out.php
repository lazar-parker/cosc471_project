<!doctype html>

<?php
session_start();

include "../server/conn.php";

$clocked_out = false;
$not_clocked_in = false;

if(!isset($_SESSION["staffid"])) {
  header('Location: index.php');
}

if(isset($_POST["sid"])) {
  $sid = mysqli_real_escape_string($conn, $_POST["sid"]);
  $eid = $_POST["event"];


  $sql = "UPDATE event_staff SET time_out=SYSDATE() WHERE staff_id=" . $sid . " AND event_id=" . $eid . ";";
  if(mysqli_query($conn, $sql)) {
    $clocked_out = true;
  } else {
    $not_clocked_in = true;
  }
}


?>

<html>
  <head>
    <link rel="stylesheet" href="css/general.css">
  </head>

  <body>
    <div style="border:1px solid black">
      <div>
        <h1>Zoom University: Clock Out</h1>
      </div>
<?php

if($clocked_out) {
  echo "<div><h4>You have clocked out successfully!</h4></div><br/>";
} else if($not_clocked_in) {
  echo "<div><h4>You have to clock in first!</h4></div><br/>";
}

?>
      <div>
        <form action="" method="POST">
          <label for="sid">Staff ID: </label>
          <input type="text" id="sid" name="sid" size="10">
          <br/>
          <br/>
          <label for="event">Event: </label>
          <select id="event" name="event">
<?php
$sql = "SELECT * FROM event";

if($result = mysqli_query($conn, $sql)) {
  while($row = mysqli_fetch_assoc($result)) {
    echo '<option value ="' . $row["event_id"] . '">' . $row["title"] . '</option>';
  }
} else {
  echo "Error in submission: " . mysqli_error($conn) . "   ";
  exit;
}

?>
          </select>
          <br/>
          <br/>
          <input type="submit" value="Clock In">
        </form>
      </div>
      <br/>
    </div>
  </body>

</html>
