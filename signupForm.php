<div class="centerDiv">
  <h1>Sign Up</h1>
  <form action="includes/signUp_inc.php" method="post">
    User Name:<br>
    <?php
      if (isset($_GET['userName'])) {
        $userName = $_GET['userName'];
        echo "<input type='text' name='userName' value='$userName'>";
      }
      else{
        echo "<input type='text' name='userName'>";
      }
     ?>
    <br>
    Email:<br>
    <?php
      if (isset($_GET['email'])) {
        $email = $_GET['email'];
        echo "<input type='text' name='email' value='$email'>";
      }
      else{
        echo "<input type='text' name='email'>";
      }
     ?>
    <br>
    Password:<br>
    <input type="password" name="userPWD">
    <br>
    Re enter your password:<br>
    <input type="password" name="userRePWD"><br>
    <input type="submit" name="signUp_submit" value="signUp">
  </form>
  <?php
    $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    if (strpos($url,'signup=success')!==false) {
      echo "<p class='success'>You have successfully sign up!</p>";
    }
    else{
      if (isset($_GET['error'])) {
        $errorType = $_GET['error'];
        if ($errorType == "missinginfo") {
          echo "<p class='error'>Please fill in all field.</p>";
        }
        elseif ($errorType == "missinginfo") {
          echo "<p class='error'>Please fill in all field.</p>";
        }
        elseif ($errorType == "badEmail") {
          echo "<p class='error'>Please enter a valid email.</p>";
        }
        elseif ($errorType == "passwordcheck") {
          echo "<p class='error'>Passwords are different.</p>";
        }
      }
    }
   ?>
  <a href="index.php">Return to login page</a>
</div>
