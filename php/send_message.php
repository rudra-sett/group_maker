<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require("../php_connect/DB_connect.php");

$signed_in = false;
session_start();
if (isset($_SESSION['user_id'])) {
  $signed_in = true;
  $user_id = $_SESSION['user_id'];
}
if(!$signed_in) {
  header("Location: ../index.php");
}

if(!isset($_GET['message']) || !isset($_GET['group'])) {
  header("Location: ../group_page.php?group=".$group);
}

$message=htmlentities(addslashes($_GET['message']));
$group=htmlentities(addslashes($_GET['group']));

if($_GET['message'] == "" || $_GET['group'] == "") {
  header("Location: ../group_page.php?group=".$group);
}

$sql = "INSERT INTO `messages` 
(`message_id`, `group_id`, `member_id`, `message`) 
VALUES (NULL, '$group','$user_id','$message')";

  //test for insertion if/else
  if ($conn->query($sql) === TRUE) {
    sleep(0.5);
    header("Location: ../group_page.php?group=".$group);
  }

?>