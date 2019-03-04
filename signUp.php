<?php

?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
    <title>login</title>
  </head>
  <body>
    <div class="centerDiv">
      <h1>Sign Up</h1>
      <form action="includes/signUp_inc.php" method="post">
        User Name:<br>
        <input type="text" name="userName">
        <br>
        Email:<br>
        <input type="text" name="email">
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
       ?>
      <a href="index.php">Return to login page</a>
    </div>
  </body>
</html>
