<!doctype html>

<?php

session_start();

include "../server/conn.php";

if(!isset($_SESSION["staffid"])) {
  header('Location: index.php');
}

?>


<html>
  <head>
    <link rel="stylesheet" href="css/general.css">
  </head>

  <body>
    <div style="border:1px solid black">
      <div>
        <h1>Zoom University: Select Event</h1>
      </div>
      <br/>
      <div>
        <form action="attendance.php" method="POST">
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
          <input type="submit" value="Submit" />
        </form>
      </div>
      <br/>
    </div>
  </body>

</html>
