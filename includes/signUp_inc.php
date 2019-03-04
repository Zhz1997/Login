<?php
if(isset($_POST['signUp_submit'])){
  require 'db_inc.php';

  $userName = $_POST['userName'];
  $pwd = $_POST['userPWD'];
  $RePWD = $_POST['userRePWD'];
  $email = $_POST['email'];

  #error handle for user inputs
  if(empty($userName)||empty($pwd)||empty($RePWD)||empty($email)){ #There is/are empty field
    header("Location: ../signUp.php?error=missinginfo&userName=".$userName);
    exit();
  }
  else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ #Email is not correct
    header("Location: ../signUp.php?error=badEmail&userName=".$userName);
    exit();
  }
  else if($pwd !== $RePWD){ #Passwords are not the same
    header("Location: ../signUp.php?error=passwordcheck&userName=".$userName);
    exit();
  }
  else{
    $testUserExist = "SELECT user_name FROM users WHERE user_name=?";
    $statement = mysqli_stmt_init($conn);
    #error handler for $statement
    if (!mysqli_stmt_prepare($statement,$testUserExist)) {
      header("Location: ../signUp.php?error=sqlerror1");
      exit();
    }
    else{
      #check if username already exist
      mysqli_stmt_bind_param($statement, "s", $userName);
      mysqli_stmt_execute($statement);
      mysqli_stmt_store_result($statement);
      $checkExistResult = mysqli_stmt_num_rows($statement);

      if ($checkExistResult > 0) {
        header("Location: ../signUp.php?error=userExist&email=".$email);
        exit();
      }
      else{
        $addUser = "INSERT INTO users(user_name,user_pwd,user_createDate,user_email) VALUES (?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$addUser)){
          header("Location: ../signUp.php?error=sqlerror2");
          exit();
        }
        else{
          $hashedPWD = password_hash($pwd,PASSWORD_DEFAULT);
          $date = date("Y-m-d H:i:s");
          mysqli_stmt_bind_param($stmt, "ssss", $userName,$hashedPWD,$date,$email);
          mysqli_stmt_execute($stmt);
          header("Location: ../signUp.php?signup=success");
          exit();
        }
      }
    }

  }
  mysqli_stmt_close($statement);
  mysqli_stmt_close($stmt);
  mysqli_close($conn);

}
else{
  header("Location: ../signUp.php?theFuckUthinkUdoing");
}
