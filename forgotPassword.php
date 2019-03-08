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
      <h1>Reset Password</h1>
      <form action="includes/resetPWDRequest_inc.php" method="post">
        User name:
        <br>
        <input type="text" name="userName_reset">
        <br>
        Email:
        <br>
        <input type="text" name="userEmail_reset">
        <br>
        <?php
          if (isset($_GET['PWDresetRequestSubmit'])) {
            $resetResult = $_GET['PWDresetRequestSubmit'];
            if ($resetResult == "success") {
              echo "<p class='success'>Check your email!</p>";
            }
          }
         ?>
        <input type="submit" name="PWDresetRequest_submit">
      </form>
    </div>
  </body>
</html>
