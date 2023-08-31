<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
  $query = "DELETE FROM `groups_and_members` WHERE 
  `groups_and_members`.`group_id` = '$group_id' AND 
  `groups_and_members`.`member_id` = '$user_id'";

  if ($conn->query($query) === TRUE) {
    //pause the program to make sure that the database is updated 

    //if the group is now empty, just delete the group too, yeah?
    $check_num_query = "SELECT * FROM `groups_and_members` WHERE 
    `groups_and_members`.`group_id` = '$group_id'";
    $num_members_result = $conn->query($check_num_query);
    $num_members = $num_members_result->num_rows;
    
    if ($num_members == 0) {
      $delete_group_query = "DELETE FROM `groups` WHERE 
      `groups`.`group_id` = '$group_id'";
      $conn->query($delete_group_query);
    }

    sleep(0.5);
    header('Location: ../index.php');
  }

}

?>