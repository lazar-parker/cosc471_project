<!doctype html>

<?php

session_start();

include "../server/conn.php";

if(!isset($_SESSION["staffid"]) && !$_SESSION["is_manager"]) {
  header('Location: index.php');
}

if(isset($_POST["eid"])) {
  $sql = "SELECT * FROM event WHERE event_id = " . $_POST["eid"] . ";";
  if($result = mysqli_query($conn, $sql)) {
    $row = mysqli_fetch_assoc($result);
    $eid = $row["event_id"];
    $name = $row["title"];
  } else {
    echo "Error in submission: " . mysqli_error($conn) . "   ";
    exit;
  }
} else if(isset($_POST["staffid"]) && $_POST["staffid"] == $_SESSION["staffid"]) {
  echo "here";
  $sql = "DELETE FROM event WHERE event_id=" . $_POST["eventid"] . ";";
  if($result = mysqli_query($conn, $sql)) {
    header("Location: staff.php?msg=eds");
  } else {
    echo "Error in deletion: " . mysqli_error($conn) . "   ";
    exit;
  }
} else {
  header("Location: staff.php");
}

?>


<html>
  <head>
    <link rel="stylesheet" href="css/general.css">
  </head>

  <body>
    <div style="border:1px solid black">
      <div>
        <h1>Zoom University: Delete Event</h1>
      </div>

      <div>
        <form action="" method="POST">
          <p>Event to Delete: <?= $name ?></p>
          <input type="hidden" id="eventid" name="eventid" value="<?=$eid?>">
          <p>Enter your Staff ID</p>
          <label for="staffid">Staff ID: </label>
          <input type="text" id="staffid" name="staffid" size="10">
          <br/>
          <br/>
          <input type="submit" value="Submit" />
        </form>
      </div>
      <br/>
    </div>
  </body>

</html>
