<!doctype html>

<?php

session_start();

include "../server/conn.php";

if(!isset($_SESSION["staffid"])) {
  header('Location: index.php');
}

if(isset($_POST["event"])) {
  $sql = "SELECT * FROM event WHERE event_id = " . $_POST["event"] . ";";
  if($result = mysqli_query($conn, $sql)) {
    $row = mysqli_fetch_assoc($result);
    $eid = $row["event_id"];
    $name = $row["title"];

    $sql = "SELECT * FROM student WHERE student_id IN (SELECT attendee_id FROM student_attendees WHERE event_id = " . $eid . ");";
    $res1 = mysqli_query($conn, $sql);

    $sql = "SELECT * FROM guest WHERE guest_id IN (SELECT attendee_id FROM guest_attendees WHERE event_id = " . $eid . ");";
    $res2 = mysqli_query($conn, $sql);
    if($res1 && $res2) {
      $num = mysqli_num_rows($res1) + mysqli_num_rows($res2);

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
        <h1>Zoom University: Select Event</h1>
      </div>
      <br/>
      <div>
        <p>Viewing Attendance For: <?= $name ?></p>
        <p>Total attendees: <?= $num ?></p>
        <table>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone #</th>
          </tr>
<?php

  while($row = mysqli_fetch_assoc($res1)) {
    echo "<tr><th>";
    echo $row["student_id"];
    echo "</th><th>";
    echo $row["f_name"] . " " . $row["l_name"];
    echo "</th><th>";
    echo $row["email"];
    echo "</th><th>";
    echo $row["phone"];
    echo "</th></tr>";
  }
  while($row = mysqli_fetch_assoc($res2)) {
    echo "<tr><th>";
    echo $row["guest_id"];
    echo "</th><th>";
    echo $row["f_name"] . " " . $row["l_name"];
    echo "</th><th>";
    echo $row["email"];
    echo "</th><th>";
    echo $row["phone"];
    echo "</th></tr>";
  }

?>
      </div>
      <br/>
    </div>
  </body>

</html>
