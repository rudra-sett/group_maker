<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require('../php_connect/DB_connect.php');

// Get form data
$fname = htmlentities(addslashes($_POST['fname']));
$lname = htmlentities(addslashes($_POST['lname']));
$email = htmlentities(addslashes($_POST['email']));
$year = htmlentities(addslashes($_POST['year']));
$password = htmlentities(addslashes($_POST['password']));
$password_c = htmlentities(addslashes($_POST['password_c']));
$bio = htmlentities(addslashes($_POST['bio']));

// Process form submission
$possible_years = array(
  "1st year (UG)",
  "2nd year (UG)",
  "3rd year (UG)",
  "4th year (UG)",
  "5th+ year (UG)",
  "1st year (G)",
  "2nd+ year (G)",
);
$isValidYear = in_array($year, $possible_years);

if (!$isValidYear) {
  echo "ERROR: please don't try to hack this website";
  exit;
}

if ($password != $password_c) {
  echo "ERROR: passwords do not match";
  exit;
}

if (strlen($password) < 8) {
  echo "ERROR: password is not long enough";
  exit;
}

if (strlen($fname) < 1 || strlen($lname) < 1 || strlen($email) < 1 || strlen($bio) < 1) {
  echo "ERROR: you cannot leave fields blank";
  exit;
}

// make sure no one is double-registering
$query = "SELECT `members`.`member_id` FROM `members` 
WHERE `email`='$email'
ORDER BY `members`.`member_id` DESC LIMIT 1";

$result = $conn->query($query);

$num_results = $result->num_rows;
// echo $num_results;

// if there was no one else in the DB with the same email, we're good
if ($num_results == 0) {
  // echo "registering!";
  $sql = "INSERT INTO `members` 
(`member_id`, `fname`, `lname`, `email`, `year`,`bio`,`password`) 
VALUES (NULL, '$fname','$lname','$email','$year','$bio','$password')";

  //test for insertion if/else
  if ($conn->query($sql) === TRUE) {
    //pause the program to make sure that the database is updated 
    sleep(0.5);

    //use email to get the newly assigned member id
    $query = "SELECT `member_id` FROM `members` 
              WHERE `email`='$email'
              AND `password`='$password'              
              ORDER BY `members`.`member_id` DESC LIMIT 1";

    $result = $conn->query($query);

    //loop through the array to fetch the user ID 
    while ($row = $result->fetch_row()) {
      $user_id = $row[0];
    }

    //if all ok start a new session with the user id
    session_start();
    $_SESSION['user_id'] = $user_id;
    echo "SUCCESS";
  } else {
    echo "ERROR: unknown error, try again";
    exit;
  }
} else {
  echo "ERROR: user with that email already exists";
  exit;
}
$conn->close();
?>