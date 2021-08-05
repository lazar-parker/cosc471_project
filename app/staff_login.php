<!doctype html>

<?php
session_start();

include "../server/conn.php";

if(isset($_POST["staffid"])) {
  $staffid = mysqli_real_escape_string($conn, $_POST["staffid"]);
  $sql = 'SELECT * FROM staff WHERE staff_id = ' . $staffid . ';';

  if($result = mysqli_query($conn, $sql)) {
    $res = mysqli_fetch_assoc($result);
    if($staffid == $res["staff_id"] && $_POST["email"] == $res["email"] && $_POST["pass"] == $res["password"]) {
      $_SESSION["staffid"] = $res["staff_id"];
      $_SESSION["is_manager"] = $res["is_manager"];
      header('Location: staff.php');
    }
  } else {
    echo "Error in retrieval: " . mysqli_error($conn) . "   ";
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
        <h1>Zoom University: Event Check-In</h1>
      </div>
      <div>
        <p>Log in using your provided Staff ID, Email, and Password</p>
      </div>
      <form action="" method="POST">
        <label for="staffid">Staff ID: </label>
        <input type="text" id="staffid" name="staffid" size="10">
        <br/>
        <br/>
        <label for="email">Email: </label>
        <input type="text" id="email" name="email" size="10">
        <br/>
        <br/>
        <label for="pass">Password: </label>
        <input type="password" id="pass" name="pass" size="10">
        <br/>
        <br/>
        <input type="submit" value="Submit" />
      </form>
      <div>
        <p>Unable to log in? Contact your supervisor for assistance</p>
      </div>
    </div>
  </body>

</html>
