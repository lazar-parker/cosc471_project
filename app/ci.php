<!doctype html>

<?php

include "../server/conn.php";

//the minimum data required for a user to be saved in the database. if a phone
//  number or email address is not provided, the entry is still saved, and dummy
//  values are entered for the rest
if(isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_POST["sid"])) {
  if(isset($_POST["type"]) && $_POST["type"] == "student") {
    $sid = mysqli_real_escape_string($conn, $_POST["sid"]);
    $fname = mysqli_real_escape_string($conn, $_POST["fname"]);
    $lname = mysqli_real_escape_string($conn, $_POST["lname"]);
    $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    if($_POST["guest"] == "yes") {
      $guest = mysqli_real_escape_string($conn, $_POST["count"]);
    } else {
      $guest = 0;
    }
    $sql = 'SELECT * FROM student WHERE student_id=' . $sid . ' AND f_name="' . $fname . '" AND l_name="' . $lname . '";';
    if(!mysqli_query($conn, $sql)) {
      $sql = 'INSERT INTO student VALUES (' . $sid .', "'. $fname .'", "'. $lname .'", "'. $phone .'", "'. $email .'", '. $guest .  ');';

      if(mysqli_query($conn, $sql)) {

      } else {
        echo "Error in submission: " . mysqli_error($conn) . "   ";
        exit;
      }
    } else {
      $sql = 'UPDATE student SET phone=' . $phone . ', email="' . $email . '", guest_count=' . $guest . ' WHERE student_id=' . $sid . ';';

      if(mysqli_query($conn, $sql)) {

      } else {
        echo "Error in submission: " . mysqli_error($conn) . "   ";
        exit;
      }
    }


    $uid = $sid;
    $type = "student";

  } else if(isset($_POST["type"]) && $_POST["type"] == "guest") {
    $sid = mysqli_real_escape_string($conn, $_POST["sid"]);
    $fname = mysqli_real_escape_string($conn, $_POST["fname"]);
    $lname = mysqli_real_escape_string($conn, $_POST["lname"]);
    $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);

    $sql = 'SELECT guest_id FROM guest WHERE student_id=' . $sid . ' AND f_name="' . $fname . '" AND l_name="' . $lname . '";';
    if(!mysqli_query($conn, $sql)) {
      //this is the most ramshackle method of getting the id value for guest, but
      //  it also might be the easiest without messing with the AUTO_INCREMENT from
      //  MySQL.
      $sql = 'SELECT MAX(guest_id) FROM guest';
      if($result = mysqli_query($conn, $sql)) {
        $gid = mysqli_fetch_row($result)[0] + 1;

        $sql = 'INSERT INTO guest VALUES (' . $gid . ', ' . $sid . ', "' . $fname . '", "' . $lname . '", ' . $phone . ', "' . $email . '");';
        if(mysqli_query($conn, $sql)) {

        } else {
          echo "Error in submission: " . mysqli_error($conn) . "   ";
          exit;
        }
      }
    } else {
      $gid = mysqli_fetch_assoc(mysqli_query($conn, $sql))["guest_id"];
      $sql = 'UPDATE guest SET phone=' . $phone . ', email= "' . $email . '" WHERE guest_id = ' . $gid . ';';
      if(mysqli_query($conn, $sql)) {

      } else {
        echo "Error in submission: " . mysqli_error($conn) . "   ";
        exit;
      }
    }

      $uid = $gid;
      $type = "guest";
    }


} else {
  //the echo line doesn't really ever get seen as it's an immediate redirect,
  //  but it'll stay here in case header becomes non-instantaneous or something,
  //  better to be safe than sorry
  echo "no user submitted, redirecting ... ";
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
        <h1>Zoom University: Event Check-In</h1>
      </div>
      <br/>
      <div>
        <form action="ci_confirm.php" method="POST">
          <input type="hidden" id="type" name="type" value="<?=$type?>">
          <input type="hidden" id="uid" name="uid" value="<?=$uid?>">
          <p>Select the event you are here for today: </p>
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
