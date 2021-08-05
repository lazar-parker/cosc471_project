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
      <div>
        <form action="ci.php" method="POST">
          <input type="hidden" id="type" name="type" value="student">
          <label for="fname">First Name: </label>
          <input type="text" id="fname" name="fname" size="10">
          <br/>
          <br/>
          <label for="lname">Last Name: </label>
          <input type="text" id="lname" name="lname" size="10">
          <br/>
          <br/>
          <label for="sid">Student ID: </label>
          <input type="text" id="sid" name="sid" size="10">
          <br/>
          <br/>
          <label for="email">Email Address: </label>
          <input type="text" id="email" name="email" size="10">
          <br/>
          <br/>
          <label for="phone">Phone Number: </label>
          <input type="text" id="phone" name="phone" size="10">
          <br/>
          <br/>
          <label for="guest">Guests? </label>
          <input type="radio" id="yes" name="guest" value="yes">Yes</input>
          <input type="radio" id="no" name="guest" value="no">No</input>
          <br/>
          <br/>
          <label for="count"># of Guests: </label>
          <input type="text" id="count" name="count" size="10">
          <br/>
          <input type="submit" value="Submit" />
        </form>
      </div>
      <br/>
    </div>
  </body>

</html>
