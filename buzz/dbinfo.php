<!--	Copyright © 2015 - sayitagain.pw 
 	Author - Dmitry Kuznetsov		-->
<?php
$db_server = "localhost";
$db_user = "user1";
$db_password = "user1";
$db_name = "users";
$db_table = "users";
$conn = null;

function connect() {
  global $db_server, $db_user, $db_password, $db_name, $conn;
  
  $conn = new mysqli($db_server, $db_user, $db_password, $db_name);
  // Check connection
  if (mysqli_connect_errno()) {
      die("Connection failed: " . $conn->connect_error);
  } 
//   return $conn;
}
?> 
