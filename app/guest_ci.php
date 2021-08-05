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
      <br/>
      <form action="ci.php" method="POST">
        <input type="hidden" id="type" name="type" value="guest">
        <label for="fname">First Name: </label>
        <input type="text" id="fname" name="fname" size="10">
        <br/>
        <br/>
        <label for="lname">Last Name: </label>
        <input type="text" id="lname" name="lname" size="10">
        <br/>
        <br/>
        <label for="email">Email Address: </label>
        <input type="text" id="email" name="email" size="10">
        <br/>
        <br/>
        <label for="phone">Phone Number: </label>
        <input type="text" id="phone" name="phone" size="10">
        <br/>
        <p>Enter the Student ID of the student you are with</p>
        <input type="text" id="sid" name="sid" size="10">
        <br/>
        <input type="submit" value="Submit" />
      </form>
      <br/>
    </div>
  </body>

</html>
