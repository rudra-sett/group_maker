<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require('../php_connect/DB_connect.php');

// Get form data
$email = htmlentities(addslashes($_POST['email']));
$password = htmlentities(addslashes($_POST['password']));

// Process form submission

$query = "SELECT `members`.`member_id` FROM `members` 
WHERE `email`='$email'
AND `password`='$password'
ORDER BY `members`.`member_id` DESC LIMIT 1";

//output data of each row
//save the query result array in the result variable
$result = $conn->query($query);

$num_results = $result->num_rows;

echo $num_results;

if ($num_results == 0) {
  // header("Location:../sign_in.php?lf=1");
  echo "FAILED";
} else {

  //loop through the array to fetch the user ID 
  while ($row = $result->fetch_row()) {
    $user_id = $row[0];
  }

  //if all ok load the user id
  session_start();
  $_SESSION['user_id'] = $user_id;

  //pause the program to make sure that the database is updated 
  sleep(0.5);

  echo "FOUND USER";
}
$conn->close();
?>