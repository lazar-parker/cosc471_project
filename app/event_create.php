<!doctype html>

<?php

session_start();

include "../server/conn.php";

if(!isset($_SESSION["staffid"])) {
  header('Location: index.php');
}

if(isset($_POST["title"])) {
  $title = mysqli_real_escape_string($conn, $_POST["title"]);
  $location = mysqli_real_escape_string($conn, $_POST["location"]);
  $date = mysqli_real_escape_string($conn, $_POST["date"]);
  $time = mysqli_real_escape_string($conn, $_POST["time"]);


  //oh hey, it's this method of getting a unique ID again. neat!
  $sql = "SELECT MAX(event_id) FROM event";
  if($result = mysqli_query($conn, $sql)) {
    $eid = mysqli_fetch_row($result)[0] + 1;

    $sql = 'INSERT INTO event VALUES (' . $eid . ', "' . $title . '", "' . $location . '", "' . $date . '", "' . $time . '");';
    if(mysqli_query($conn, $sql)) {
      header("Location: staff.php?msg=ecs");
    } else {
      echo "Error in submission: " . mysqli_error($conn) . "   ";
      exit;
    }
  } else {
    echo "Error in submission: " . mysqli_error($conn) . "   ";
    exit;
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
        <h1>Zoom University: Create Event</h1>
      </div>
      <br/>
      <div>
        <form action="" method="POST">
          <label for="title">Title: </label>
          <input type="text" id="title" name="title" size="10">
          <br/>
          <br/>
          <label for="location">Location: </label>
          <input type="text" id="location" name="location" size="10">
          <br/>
          <br/>
          <p>Enter date in YYYY-MM-DD format</p>
          <label for="date">Date: </label>
          <input type="text" id="date" name="date" size="10">
          <br/>
          <br/>
          <p>Enter date in HH:MM:SS format<p>
          <label for="time">Time: </label>
          <input type="text" id="time" name="time" size="10">
          <br/>
          <br/>
          <input type="submit" value="Submit" />
        </form>
      </div>
      <br/>
    </div>
  </body>

</html>
