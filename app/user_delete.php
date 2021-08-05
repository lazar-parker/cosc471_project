<!doctype html>

<?php

session_start();

include "../server/conn.php";

if(!isset($_SESSION["staffid"]) && !$_SESSION["is_manager"]) {
  header('Location: staff.php');
}

if(isset($_POST["sid"])) {
  $sql = "SELECT * FROM staff WHERE staff_id = " . $_POST["sid"] . ";";
  if($result = mysqli_query($conn, $sql)) {
    $row = mysqli_fetch_assoc($result);
    $sid = $row["staff_id"];
    $name = $row["f_name"] . " " . $row["l_name"];
  } else {
    echo "Error in submission: " . mysqli_error($conn) . "   ";
    exit;
  }
} else if(isset($_POST["staffid"]) && $_POST["staffid"] == $_SESSION["staffid"]) {
  echo "here";
  $sql = "DELETE FROM staff WHERE staff_id=" . $_POST["userid"] . ";";
  if($result = mysqli_query($conn, $sql)) {
    header("Location: staff.php?msg=uds");
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
        <h1>Zoom University: Delete User</h1>
      </div>

      <div>
        <form action="" method="POST">
          <p>User to Delete: <?= $name ?></p>
          <input type="hidden" id="userid" name="userid" value="<?=$sid?>">
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
