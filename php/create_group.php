<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
require("../php_connect/DB_connect.php");

function isInAnyGroup($id_to_check) : bool {
  global $conn;
  $check_query = "SELECT * FROM groups_and_members 
  WHERE `groups_and_members`.`member_id` = '$id_to_check'";
  $res = $conn->query($check_query);
  $num_results = $res->num_rows;
  if ($num_results > 0) {
    return true;
  } else {
    return false;
  }
}

$gname = htmlentities(addslashes($_POST['gname']));
$gdesc = htmlentities(addslashes($_POST['gdesc']));

$signed_in = false;
session_start();
if (isset($_SESSION['user_id'])) {
  $signed_in = true;
  $user_id = $_SESSION['user_id'];
}

if (strlen($gname) < 1 || strlen($gdesc) < 1) {
  echo "ERROR: you cannot leave fields blank";
  exit;
}

if (!$signed_in) {
  // header('Location: ../index.php');
  echo "ERROR: not signed in!";
  exit;
} else {
  if (isInAnyGroup($user_id)) {
    // echo $user_id;
    echo "ERROR: you're already in another group";
  } else {
    $query = "INSERT INTO `groups` (`group_id`,`name`,`description`,`creator`)
   VALUES (NULL,'$gname','$gdesc','$user_id')";

    if ($conn->query($query) === TRUE) {
      //pause the program to make sure that the database is updated 
      sleep(0.5);
      // header('Location: ../index.php'); 

      $query = "SELECT `group_id` FROM `groups` 
              WHERE `creator`='$user_id'
              ORDER BY `groups`.`group_id` DESC LIMIT 1";

      $result = $conn->query($query);

      //loop through the array to fetch the user ID 
      while ($row = $result->fetch_row()) {
        $group_id = $row[0];
      }
      echo "SUCCESS:".$group_id;
    }
  }
}

?>