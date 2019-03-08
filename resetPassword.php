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
      <?php
        $selector = $_GET["selector"];
        $validator = $_GET["validator"];
        if (empty($selector)||empty($validator)) {
          echo 'Error';
        }
        else{
          if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
            ?>
            <form action="includes/resetPassword_inc.php" method="post">
              <input type="hidden" name="selector" value="<?php echo $selector; ?>">
              <input type="hidden" name="validator" value="<?php echo $validator; ?>">
              Enter new password:<br>
              <input type="password" name="newPWD"><br>
              Re enter new password:<br>
              <input type="password" name="re_newPWD"><br>
              <input type="submit" name="resetPWDsubmit">
            </form>
            <?php
          }

        }
      ?>
    </div>
  </body>
</html>
