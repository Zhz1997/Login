<div class="centerDiv">
  <h1>Login</h1>
  <?php
    if(isset($_GET['resetPWD'])){
      $resetR = $_GET['resetPWD'];
      if ($resetR == "success") {
        echo "<p class='success'>Your password has been reset.</p>";
      }
    }
   ?>
  <form action="includes/login_inc.php" method="post">
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
    Password:<br>
    <input type="password" name="userPWD">
    <br>
    <input type="submit" name="login_submit" value="Login">
  </form>
  <?php
    if (isset($_GET['error'])) {
      $errorType = $_GET['error'];
      if ($errorType == "userdoesnotexist") {
        echo "<p class='error'>User name does't exist.</p>";
      }
      else if ($errorType == "wrongpwd") {
        echo "<p class='error'>Password is not correct.</p>";
      }
      else if ($errorType == "missinginfo") {
        echo "<p class='error'>Please fill in all field.</p>";
      }
    }
   ?>
  <a href="signUp.php">No account? Sign up here!</a>
  <br>
  <a href="forgotPassword.php">Forgot your password?</a>
</div>
