<?php

/*
Loader file for creating the database initially. Run this first, and the database
  will populate itself with a few test users and relationships.
*/

//-------MODIFY THIS SECTION ONLY-------//

$servername = "localhost";
$username = isset($_SERVER["SQL_USERNAME"]) ? $_SERVER["SQL_USERNAME"] : "root";
$password = isset($_SERVER["SQL_PASSWORD"]) ? $_SERVER["SQL_PASSWORD"] : "";
$dbname = "check-in";

//-------MODIFY ONLY ABOVE SECTION-------//

$conn = @new mysqli($servername, $username, $password, $dbname);
if(!mysqli_connect_error()) {
  $sql = 'DROP DATABASE `check-in`';
  if(mysqli_query($conn, $sql)) {
    echo "Database has been dropped   ";
    mysqli_close($conn);
  } else {
    echo "Error dropping database: " . mysqli_error($conn) . "   ";
  }
} else {
  echo "No database exists, generating   ";
}

$conn = new mysqli($servername, $username, $password);
if(!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = 'CREATE DATABASE `check-in`;';

if(mysqli_query($conn, $sql)) {
  echo "Database has been created   ";
} else {
  echo "Error creating database: " . mysqli_error($conn) . "   ";
}
mysqli_close($conn);

$dbname = "check-in";

$conn = new mysqli($servername, $username, $password, $dbname);
if(!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = 'CREATE TABLE student (
    student_id int(11) NOT NULL UNIQUE,
    f_name varchar(50) NOT NULL,
    l_name varchar(50) NOT NULL,
    phone varchar(15),
    email varchar(50),
    guest_count int(3) NOT NULL,
    PRIMARY KEY (student_id)
);

CREATE TABLE staff (
    staff_id int(11) NOT NULL UNIQUE,
    f_name varchar(50) NOT NULL,
    l_name varchar(50) NOT NULL,
    phone varchar(15),
    email varchar(50) NOT NULL,
    password varchar(50) NOT NULL UNIQUE,
    is_manager boolean NOT NULL,
    PRIMARY KEY (staff_id)
);

CREATE TABLE guest (
    guest_id int(11) NOT NULL UNIQUE,
    student_id int(11) NOT NULL,
    f_name varchar(50) NOT NULL,
    l_name varchar(50) NOT NULL,
    phone varchar(15),
    email varchar(50),
    PRIMARY KEY (guest_id),
    FOREIGN KEY (student_id) REFERENCES student(student_id)
);

CREATE TABLE event (
    event_id int(11) NOT NULL UNIQUE AUTO_INCREMENT,
    title varchar(50) NOT NULL,
    location varchar(50) NOT NULL,
    event_date date NOT NULL,
    event_time time NOT NULL,
    PRIMARY KEY (event_id)
);

CREATE TABLE student_attendees (
    attendee_id int(11) NOT NULL,
    event_id int(11) NOT NULL,
    FOREIGN KEY (attendee_id) REFERENCES student(student_id),
    FOREIGN KEY (event_id) REFERENCES event(event_id)
);

CREATE TABLE guest_attendees (
    attendee_id int(11) NOT NULL,
    event_id int(11) NOT NULL,
    FOREIGN KEY (attendee_id) REFERENCES guest(guest_id),
    FOREIGN KEY (event_id) REFERENCES event(event_id)
);

CREATE TABLE event_staff (
    staff_id int(11) NOT NULL UNIQUE,
    event_id int(11) NOT NULL UNIQUE,
    time_in datetime NOT NULL,
    time_out datetime,
    FOREIGN KEY (staff_id) REFERENCES staff(staff_id),
    FOREIGN KEY (event_id) REFERENCES event(event_id)
);

INSERT INTO student VALUES (11223, "Jane", "Doe", "5672821111", "jdoe@gmail.com", 0);
INSERT INTO student VALUES (11226, "Jane", "Doe", "5671111111", "jdoe2@gmail.com", 2);
INSERT INTO student VALUES (12456, "John", "Smith", "1234567890", "jsmith@gmail.com", 1);
INSERT INTO student VALUES (49913, "Steve", "Jobs", "1324657980", "sjobs@apple.com", 0);
INSERT INTO student VALUES (123456, "Mike", "Wazowski", "5672821111", "mwazow@gmail.com", 2);
INSERT INTO student VALUES (8675309, "Kristen", "Applebees", "5678675309", "kapple@aol.com", 0);

INSERT INTO guest VALUES (1, 12456, "James", "Smith", "9998887765", "jsmithy@aol.com");
INSERT INTO guest VALUES (2, 11226, "David", "Doe", "1112223333", "dms_doe@gmail.com");
INSERT INTO guest VALUES (3, 11226, "Mary", "Doe", "1112223333", "dms_doe@gmail.com");
INSERT INTO guest VALUES (4, 123456, "Jack", "Wazowski", "6863849685", "thewazzes@outlook.com");
INSERT INTO guest VALUES (5, 123456, "Diane", "Wazowski", "6863849685", "thewazzes@outlook.com");

INSERT INTO staff VALUES (1, "default", "user", "1231231231", "defuser@default.com", "default", 1);
INSERT INTO staff VALUES (2, "Geoffry", "Butler", "5438761029", "gbutler@gmail.com", "freshPrince", 1);
INSERT INTO staff VALUES (3, "So", "Blue", "0000000000", "dabodee@gmail.com", "dabodaa", 1);

INSERT INTO event VALUES (1, "Test Event", "Zoom", "2020-07-17", "04:30:00");
INSERT INTO event VALUES (2, "Homecoming", "Home", "2021-10-25", "09:00:00");
INSERT INTO event VALUES (3, "Due Date", "Canvas", "2021-08-04", "23:59:00");

INSERT INTO student_attendees VALUES (11223, 1);
INSERT INTO student_attendees VALUES (11223, 2);
INSERT INTO student_attendees VALUES (11226, 1);
INSERT INTO student_attendees VALUES (12456, 1);
INSERT INTO student_attendees VALUES (49913, 1);
INSERT INTO student_attendees VALUES (49913, 2);
INSERT INTO student_attendees VALUES (123456, 1);
INSERT INTO student_attendees VALUES (123456, 2);
INSERT INTO student_attendees VALUES (8675309, 2);

INSERT INTO guest_attendees VALUES (1, 1);
INSERT INTO guest_attendees VALUES (2, 1);
INSERT INTO guest_attendees VALUES (3, 1);
INSERT INTO guest_attendees VALUES (4, 1);
INSERT INTO guest_attendees VALUES (5, 1);




';

if(mysqli_multi_query($conn, $sql)) {
  echo "Database has been populated correctly   ";
} else {
  echo "Error populating database: " . mysqli_error($conn) . "   ";
}



mysqli_close($conn);

?>
