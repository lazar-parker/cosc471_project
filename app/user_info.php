<!doctype html>

<?php

session_start();

include "../server/conn.php";

if(!isset($_SESSION["staffid"]) || (!$_SESSION["is_manager"] && $_POST["sid"] != $_SESSION["staffid"])) {
  header('Location: staff.php');
}

$eid;
$row;

if(isset($_POST["sid"])) {
  $sql = "SELECT * FROM staff WHERE staff_id=" . $_POST["sid"] . ";";
  if($result = mysqli_query($conn, $sql)) {
    $row = mysqli_fetch_assoc($result);
    $sid = $row["staff_id"];
  } else {
    echo "Error in submission: " . mysqli_error($conn) . "   ";
    exit;
  }
}

if(isset($_POST["fname"])) {
  $sid = $_POST["sid"];
  $fname = mysqli_real_escape_string($conn, $_POST["fname"]);
  $lname = mysqli_real_escape_string($conn, $_POST["lname"]);
  $email = mysqli_real_escape_string($conn, $_POST["email"]);
  $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
  $pass = mysqli_real_escape_string($conn, $_POST["pass"]);


  $sql = 'UPDATE staff SET f_name = "' . $fname . '", l_name = "' . $lname . '", phone =' . $phone . ', email = "' . $email . '", password = "' . $pass . '" WHERE staff_id = ' . $sid . ';';
  if(mysqli_query($conn, $sql)) {
    header("Location: staff.php?msg=ues");
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
      document.getElementById("fname").value= '<?php echo $row["f_name"];?>';
      document.getElementById("lname").value= '<?php echo $row["l_name"];?>';
      document.getElementById("email").value= '<?php echo $row["email"];?>';
      document.getElementById("phone").value = '<?php echo $row["phone"];?>';
      document.getElementById("pass").value = '<?php echo $row["password"];?>';
    }

    </script>
  </head>

  <body onload="changeFields()">
    <div style="border:1px solid black">
      <div>
        <h1>Zoom University: Edit User</h1>
      </div>
      <br/>
      <div>
        <form action="" method="POST">
          <input type="hidden" id="sid" name="sid" value="<?=$sid?>"
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
          <input type="submit" value="Submit" />
        </form>
        <form action="user_delete.php" method="POST">
          <p>Press button below to delete event</p>
          <input type="hidden" id="sid" name="sid" value="<?=$sid?>">
          <input type="submit" value="Delete User" />
        </form>
      </div>
      <br/>
    </div>
  </body>

</html>
