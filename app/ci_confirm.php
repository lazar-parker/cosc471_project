<!doctype html>

<?php

include "../server/conn.php";

$text = "Something went wrong, please try again";
//the minimum data required for a user to be saved in the database. if a phone
//  number or email address is not provided, the entry is still saved, and dummy
//  values are entered for the rest
if(isset($_POST["type"]) && isset($_POST["uid"]) && isset($_POST["event"])) {
  if($_POST["type"] == "student") {
    $sql = "INSERT INTO student_attendees VALUES (" . $_POST['uid']. ", " . $_POST['event'] . ");";
    if(mysqli_query($conn, $sql)) {
      $text = "Thank you for checking in, and welcome!";
    } else {
      $text = "Something went wrong, please try again";
    }
  } else if($_POST["type"] == "guest") {
    $sql = "INSERT INTO guest_attendees VALUES (" . $_POST['uid']. ", " . $_POST['event'] . ");";
    if(mysqli_query($conn, $sql)) {
      $text = "Thank you for checking in, and welcome!";
    } else {
      $text = "Something went wrong, please try again";
    }
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
        <h3><?=$text?></h3>
      </div>
      <br/>
      <form action="index.php">
        <input type="submit" value="Return to home" />
      </form>
      <br/>
    </div>
  </body>

</html>
