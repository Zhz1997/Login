<?php
if (isset($_POST["resetPWDsubmit"])) {
  $selector = $_POST["selector"];
  $validator = $_POST["validator"];
  $pwd = $_POST["newPWD"];
  $pwdR = $_POST["re_newPWD"];

  if (empty($pwd)||empty($pwdR)) {
    header("Location: ../resetPassword.php?selector='$selector'&validator='$validator'&error=missinginfo");
    exit();
  }
  else if($pwd != $pwdR){
    header("Location: ../resetPassword.php?selector='$selector'&validator='$validator'&error=pwdDiff");
    exit();
  }
  else{
    require 'db_inc.php';
    $currentDate = date("U");
    $sql = "SELECT * FROM pwdreset WHERE pwdResetSelector=? AND pwdResetExpires >=?";
    $stmt = mysqli_stmt_init($conn);
    #error handler for $statement
    if (!mysqli_stmt_prepare($stmt,$sql)) {
      header("Location: ../resetPassword.php?selector='$selector'&validator='$validator'&error=sqlerror1");
      exit();
    }
    else{
      mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate);
      mysqli_stmt_execute($stmt);

      $result = mysqli_stmt_get_result($stmt);
      if (!$row = mysqli_fetch_assoc($result)) {
        echo "can't get row from database.";
        exit();
      }
      else{
        $tokenBin = hex2bin($validator);
        $tokenCheck = password_verify($tokenBin,$row['pwdResetToken']);
        if ($tokenCheck === false) {
          echo "tokenCheck failed";
          exit();
        }
        else{
          $tokenUserName = $row['pwdResetUserName'];
          $sql = "SELECT * FROM users WHERE user_name=?;";

          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("Location: ../resetPassword.php?selector='$selector'&validator='$validator'&error=sqlerror2");
            exit();
          }
          else{
            mysqli_stmt_bind_param($stmt, "s", $tokenUserName);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (!$row = mysqli_fetch_assoc($result)) {
              echo "can't get row from users table.";
              exit();
            }
            else{
              $sql = "UPDATE users SET user_pwd=? WHERE user_name=?";
              $stmt = mysqli_stmt_init($conn);
              if (!mysqli_stmt_prepare($stmt,$sql)) {
                header("Location: ../resetPassword.php?selector='$selector'&validator='$validator'&error=sqlerror3");
                exit();
              }
              else{
                $hashedPWD = password_hash($pwd,PASSWORD_DEFAULT);
                mysqli_stmt_bind_param($stmt, "ss", $hashedPWD,$tokenUserName);
                mysqli_stmt_execute($stmt);

                $sql = "DELETE FROM pwdReset WHERE pwdResetUserName=?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt,$sql)) {
                  header("Location: ../resetPassword.php?selector='$selector'&validator='$validator'&error=sqlerror4");
                  exit();
                }
                else{
                  mysqli_stmt_bind_param($stmt, "s",$tokenUserName);
                  mysqli_stmt_execute($stmt);
                  header("Location: ../index.php?resetPWD=success");
                }
              }
            }
          }
        }

      }
    }
  }
}
else{

}
