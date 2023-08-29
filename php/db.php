<?php
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$conn = new mysqli("localhost", "root", "", "ucl_db");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// echo "Connected successfully <br>";	

switch ($method) {
    case 'GET':
        $user = $_GET['user'];
        $pass = $_GET['pass'];
        $sql = "SELECT * FROM `users` WHERE `users.user_name` = '$user' AND `users.password` = '$pass'";
        echo $sql;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          echo "you exist!";
        } else {
          echo "invalid login!";
        }
        http_response_code(200); 
        break;
    case 'POST':
      $user = $_POST['user'];
        $pass = $_POST['pass'];
        $sql = "SELECT * FROM `users` WHERE `user_name` = '$user' AND `password` = '$pass'";
        
        // echo $sql;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          echo "you exist!";
        } else {
          echo "invalid login!";
        }
        http_response_code(200); 
        break;
    default:
        http_response_code(405); 
}