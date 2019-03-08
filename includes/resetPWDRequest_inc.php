<?php
if (isset($_POST['PWDresetRequest_submit'])) {
  require 'db_inc.php';

  $userName = $_POST['userName_reset'];
  $userEmail = $_POST['userEmail_reset'];

  if (empty($userName)||empty($userEmail)) {
    header("Location: ../forgotPassword.php?error=missinginfo");
    exit();
  }

  $sql = "SELECT user_name FROM users WHERE user_name=?";
  $stmt = mysqli_stmt_init($conn);
  #error handler for $statement
  if (!mysqli_stmt_prepare($stmt,$sql)) {
    header("Location: ../forgotPassword.php?error=sqlerror1");
    exit();
  }
  else{
    #check if username exist
    mysqli_stmt_bind_param($stmt, "s", $userName);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $checkExistResult = mysqli_stmt_num_rows($stmt);

    if ($checkExistResult == 0) {
      #userName doesn't exist in DB
      header("Location: ../forgotPassword.php?error=userDoesntExist&email=".$userEmail);
      exit();
    }
    else{
      #check Username email in DB == email
      $sql = "SELECT * FROM users WHERE user_name=?";
      $stmt = mysqli_stmt_init($conn);
      #error handler for $statement
      if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("Location: ../forgotPassword.php?error=sqlerror1");
        exit();
      }
      else{
        #check if username exist
        mysqli_stmt_bind_param($stmt, "s", $userName);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        $dbEmail = $row['user_email'];
        if ($dbEmail!=$userEmail) { #dbEmail != userEmail
          header("Location: ../forgotPassword.php?dbEmail!=userEmail&userName=".$userName);
          exit();
        }
        else{
          // input correct, create token and selector
          $selector = bin2hex(random_bytes(8));
          $token = random_bytes(32);
          $url = "localhost/logintest/resetPassword.php?selector=".$selector."&validator=".bin2hex($token);//change this line when upload to online hosting service
          $expires = date("U") + 1800;

          //delete existing row in resetPassword table where row['userName'] = userName
          $sql = "DELETE FROM pwdreset WHERE pwdResetUserName=?";
          $stmt = mysqli_stmt_init($conn);

          if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("Location: ../forgotPassword.php?error=sqlerror2");
            exit();
          }
          else{
            mysqli_stmt_bind_param($stmt, "s", $userName);
            mysqli_stmt_execute($stmt);
          }

          $sql = "INSERT INTO pwdreset(pwdResetUserName,pwdResetUserEmail,pwdResetSelector,pwdResetToken,pwdResetExpires) VALUES (?,?,?,?,?)";
          $stmt = mysqli_stmt_init($conn);

          if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("Location: ../forgotPassword.php?error=sqlerror3");
            exit();
          }
          else{
            $hashedToken = password_hash($token, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt, "sssss", $userName,$userEmail,$selector,$hashedToken,$expires);
            mysqli_stmt_execute($stmt);
          }

          mysqli_stmt_close($stmt);
          mysqli_close();

          //send email to user with url they need to click on to reset their password

          $to      = $userEmail;

          $subject = "Reset Your Password";

          $message = '<h1>Click on url below to change your password</h1>';
          $message .= "<a href = '$url'>'$url'</a>";

          $headers = "From: test <testtest396392@gmail.com>\r\n";
          $headers .= "Reply-To:<testtest396392@gmail.com>\r\n";
          $headers .= "Content-type: text/html\r\n";

  //            'content-type: text/html'."\r\n";



          if(!mail($to, $subject, $message, $headers)){

            header("Location: ../forgotPassword.php?PWDresetRequestSubmit=failed");
            exit();

          }else{

            header("Location: ../forgotPassword.php?PWDresetRequestSubmit=success");
            exit();

          }
          header("Location: ../forgotPassword.php?PWDresetRequestSubmit=asdas");
          exit();
        }
      }
      header("Location: ../forgotPassword.php?PWDresetRequestSubmit=unkown");
      exit();
    }
  }
  header("Location: ../forgotPassword.php?PWDresetRequestSubmit=what");
  exit();
}
else{
  header("Location: ../forgotPassword.php?theFuckUthinkUdoing");
  exit();
}
