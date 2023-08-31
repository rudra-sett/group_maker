<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Create connection
require('php_connect/DB_connect.php');
$signed_in = false;
session_start();
if (isset($_SESSION['user_id'])) {
  $signed_in = true;
  $user_id = $_SESSION['user_id'];
}

if (!$signed_in) {
  header('Location: ../index.php');
}
?>


<!doctype html>
<html>
<head>
<script src="https://cdn.tailwindcss.com"></script>
<meta charset="utf-8">
<title></title>
</head>
<body>

<div class="content-wrapper flex-col">

  
</div>

</body>
<!--the html tag ends-->
</html>