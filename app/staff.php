<!doctype html>

<?php
session_start();

//this is for removing the warning messages that pop up with the $_GET["msg"] when
//  no message is present. Only warnings are disabled
error_reporting(E_ALL & ~E_WARNING);

include "../server/conn.php";

if(!isset($_SESSION["staffid"])) {
  header('Location: index.php');
}

if(isset($_POST["lo"])) {
  session_unset();
  session_destroy();
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
        <h1>Zoom University: Staff Tools</h1>
      </div>
<?php

if($_GET["msg"] == "ecs") {
  echo "<div><h4>Event Created Successfully!</h4></div>";
} else if($_GET["msg"] == "ees") {
  echo "<div><h4>Event Updated Successfully!</h4></div>";
} else if($_GET["msg"] == "eds") {
  echo "<div><h4>Event Deleted Successfully!</h4></div>";
} else if($_GET["msg"] == "ucs") {
  echo "<div><h4>User Created Successfully!</h4></div>";
} else if($_GET["msg"] == "ues") {
  echo "<div><h4>User Updated Successfully!</h4></div>";
} else if($_GET["msg"] == "uds") {
  echo "<div><h4>User Deleted Successfully!</h4></div>";
}
?>
      <div>
        <p>Time Sheet:</p>
        <form action="clock_in.php">
          <input type="submit" value="Clock In" />
        </form>
        <form action="clock_out.php">
          <input type="submit" value="Clock Out" />
        </form>
      </div>
      <br/>
      <div>
        <p>Users:</p>
        <form action="user_create.php">
          <input type="submit" value="Register User" />
        </form>
        <form action="user_edit.php">
          <input type="submit" value="Edit User" />
        </form>
      </div>
      <br/>
      <div>
        <p>Events:</p>
        <form action="event_create.php">
          <input type="submit" value="Create Event" />
        </form>
        <form action="event_edit.php">
          <input type="submit" value="Edit Event" />
        </form>
        <form action="select_event.php">
          <input type="submit" value="View Attendance" />
        </form>
      </div>
      <br/>
      <div>
        <p>Log Out:</p>
        <form action="" method="POST">
          <input type="hidden" id="lo" name="lo" value="logout">
          <input type="submit" value="Log Out" />
        </form>
      </div>
      <br/>
    </div>
  </body>

</html>
