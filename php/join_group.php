<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
require("../php_connect/DB_connect.php");
$group_id = $_GET['group'];
$signed_in = false;
session_start();
if (isset($_SESSION['user_id'])) {
  $signed_in = true;
  $user_id = $_SESSION['user_id'];
}

if (!$signed_in) {
  header('Location: ../index.php');
} else {  
  $query = "INSERT INTO `groups_and_members` VALUES ('$group_id','$user_id')";

  if ($conn->query($query) === TRUE) {
    //pause the program to make sure that the database is updated 
    sleep(0.5);
    header('Location: ../index.php');  
  }
  
}

?>