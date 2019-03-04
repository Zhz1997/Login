
<div class="centerDiv">
  <h1>Login</h1>
  <form action="includes/login_inc.php" method="post">
    User Name:<br>
    <input type="text" name="userName">
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
    }
   ?>
  <a href="signUp.php">No account? Sign up here!</a>
</div>
