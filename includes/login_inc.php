<?php
if (isset($_POST['login_submit'])) {
  require 'db_inc.php';

  $userName = $_POST['userName'];
  $pwd = $_POST['userPWD'];

  //check empty field
  if (empty($userName)||empty($pwd)) {
    header("Location: ../index.php?error=missinginfo&userName=".$userName);
    exit();
  }
  else{
    $checkExist = "SELECT * FROM users WHERE user_name=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt,$checkExist)) {
      header("Location: ../index.php?error=sqlerror1");
      exit();
    }
    else{
      mysqli_stmt_bind_param($stmt, "s", $userName);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result)) {
        $checkPWD = password_verify($pwd,$row['user_pwd']);
        if($checkPWD == true){
          session_start();
          $_SESSION['user_id'] = $row['user_id'];
          $_SESSION['user_name'] = $row['user_name'];

          header("Location: ../index.php?login=success");
          exit();
        }
        else if($checkPWD == false){
          header("Location: ../index.php?error=wrongpwd");
          exit();
        }
        else{
          header("Location: ../index.php?error=wrongpwd");
          exit();
        }
      }
      else{
        header("Location: ../index.php?error=userdoesnotexist");
        exit();
      }
    }
  }
}
else{
  header("Location: ../index.php?theFuckUthinkUdoing");
}
