<!doctype html>

<?php

session_start();

include "../server/conn.php";

if(!isset($_SESSION["staffid"]) || !$_SESSION["is_manager"]) {
  header('Location: index.php');
}

if(isset($_POST["fname"])) {
  $fname = mysqli_real_escape_string($conn, $_POST["fname"]);
  $lname = mysqli_real_escape_string($conn, $_POST["lname"]);
  $email = mysqli_real_escape_string($conn, $_POST["email"]);
  $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
  $pass = mysqli_real_escape_string($conn, $_POST["pass"]);

  $manager = 0;

  if($_POST["manager"] == "yes") {
    $manager = 1;
  }

  //oh hey, it's this method of getting a unique ID again. neat!
  $sql = "SELECT MAX(staff_id) FROM staff";
  if($result = mysqli_query($conn, $sql)) {
    $sid = mysqli_fetch_row($result)[0] + 1;

    $sql = 'INSERT INTO staff VALUES (' . $sid . ', "' . $fname . '", "' . $lname . '", ' . $phone . ', "' . $email . '", "' . $pass . '", ' . $manager . ');';
    if(mysqli_query($conn, $sql)) {
      header("Location: staff.php?msg=ucs");
    } else {
      echo $sql;
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
          <label for="fname">First Name: </label>
          <input type="text" id="fname" name="fname" size="10">
          <br/>
          <br/>
          <label for="lname">Last Name: </label>
          <input type="text" id="lname" name="lname" size="10">
          <br/>
          <br/>
          <label for="email">Email: </label>
          <input type="text" id="email" name="email" size="10">
          <br/>
          <br/>
          <p>Enter <i>only numbers</i> for Phone Number</p>
          <label for="phone">Phone #: </label>
          <input type="text" id="phone" name="phone" size="10">
          <br/>
          <br/>
          <label for="pass">Password: </label>
          <input type="text" id="pass" name="pass" size="10">
          <br/>
          <br/>
          <label for="guest">Manager? </label>
          <input type="radio" id="yes" name="manager" value="yes">Yes</input>
          <input type="radio" id="no" name="manager" value="no">No</input>
          <br/>
          <br/>
          <input type="submit" value="Submit" />
        </form>
      </div>
      <br/>
    </div>
  </body>

</html>
