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
        <h1>Zoom University: Select User</h1>
      </div>
      <div>
        <form action="user_info.php" method="POST">
          <p>Enter the Staff ID of the user to edit</p>
          <label for="sid">Staff ID: </label>
          <input type="text" id="sid" name="sid" size="10">
          <br/>
          <br/>
          <input type="submit" value="Submit" />
        </form>
      </div>
      <br/>
    </div>
  </body>

</html>
