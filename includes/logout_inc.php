<?php
echo 'tf';
session_start();
session_unset();
session_destroy();
header("Location: ../index.php?logout=succes");
