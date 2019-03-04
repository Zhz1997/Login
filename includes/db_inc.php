<?php
$serverName = "localhost";
$dbUserName = "root";
$dbPWD = "";
$dbName = "login";

$conn = mysqli_connect($serverName,$dbUserName,$dbPWD,$dbName);

#Error handler for conn
if(!$conn){
  die("Connection failed: ".mysqli_connect_error());
}
