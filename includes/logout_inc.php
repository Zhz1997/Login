<?php
if (isset($_POST['logout_submit'])) {
  echo 'tf';
  session_start();
  session_unset();
  session_destroy();
  header("Location: ../index.php?logout=succes");
}
else{
  header("Location: ../index.php?logout=failed");
}
