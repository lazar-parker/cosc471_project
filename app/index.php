<!doctype html>

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
        <p>Select an option below to
          check in to the event:</p>
      </div>
      <div>
        <form action="student_ci.php">
          <input type="submit" value="Student Check-In" />
        </form>
        <br/>
        <form action="guest_ci.php">
          <input type="submit" value="Guest Check-In" />
        </form>
      </div>
      <div>
        <p>Registered employees:</p>
      </div>
      <div>
        <form action="staff_login.php">
          <input type="submit" value="Staff Member Login" />
        </form>
      </div>
      <br/>
    </div>
  </body>

</html>
