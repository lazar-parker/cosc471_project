<?php

$servername = "localhost";
$username = isset($_SERVER["SQL_USERNAME"]) ? $_SERVER["SQL_USERNAME"] : "root";
$password = isset($_SERVER["SQL_PASSWORD"]) ? $_SERVER["SQL_PASSWORD"] : "";
$dbname = "check-in";

$conn = new mysqli($servername, $username, $password, $dbname);
if(!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

?>
