<!doctype html>

<?php

session_start();

include "../server/conn.php";

if(!isset($_SESSION["staffid"])) {
  header('Location: index.php');
}

$eid;
$row;

if(isset($_POST["event"])) {
  $sql = "SELECT * FROM event WHERE event_id=" . $_POST["event"] . ";";
  if($result = mysqli_query($conn, $sql)) {
    $row = mysqli_fetch_assoc($result);
    $eid = $row["event_id"];
  } else {
    echo "Error in submission: " . mysqli_error($conn) . "   ";
    exit;
  }
}

if(isset($_POST["title"])) {
  $eid = $_POST["eid"];
  $title = mysqli_real_escape_string($conn, $_POST["title"]);
  $location = mysqli_real_escape_string($conn, $_POST["location"]);
  $date = mysqli_real_escape_string($conn, $_POST["date"]);
  $time = mysqli_real_escape_string($conn, $_POST["time"]);


  $sql = 'UPDATE event SET title = "' . $title . '", location = "' . $location . '", event_date = "' . $date . '", event_time = "' . $time . '" WHERE event_id = ' . $eid . ';';
  if(mysqli_query($conn, $sql)) {
    header("Location: staff.php?msg=ees");
  } else {
      echo "Error in submission: " . mysqli_error($conn) . "   ";
      exit;
  }
}

?>


<html>
  <head>
    <link rel="stylesheet" href="css/general.css">
    <script>

    function changeFields()
    {
      document.getElementById("title").value= '<?php echo $row["title"];?>';
      document.getElementById("location").value= '<?php echo $row["location"];?>';
      document.getElementById("date").value= '<?php echo $row["event_date"];?>';
      document.getElementById("time").value = '<?php echo $row["event_time"];?>';
    }

    </script>
  </head>

  <body onload="changeFields()">
    <div style="border:1px solid black">
      <div>
        <h1>Zoom University: Edit Event</h1>
      </div>
      <br/>
      <div>
        <form action="" method="POST">
          <input type="hidden" id="eid" name="eid" value="<?=$eid?>">
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
        <form action="event_delete.php" method="POST">
          <p>Press button below to delete event</p>
          <input type="hidden" id="eid" name="eid" value="<?=$eid?>">
          <input type="submit" value="Delete Event" />
        </form>
      </div>
      <br/>
    </div>
  </body>

</html>
