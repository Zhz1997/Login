<?php
  session_start();
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
    <?php
      if (isset($_SESSION['user_name'])) {
        echo '<div class="centerDiv">';
        echo '<h2> Welcome <h2>'.'<h1>'.$_SESSION['user_name'].'</h1>';
        echo '<form action="includes/logout_inc.php" method="post">
          <input type="submit" name="logout_submit" value="Logout">
        </form>';
        echo '</div>';
      }
      else{
        include 'loginForm.php';
      }
     ?>
  </body>
</html>
