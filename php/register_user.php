<?php 
// register_submit.php


// $json = file_get_contents('php://input');
// $data = json_decode($json, true);

// $firstName = $data['first_name'];
// $lastName = $data['last_name'];


// Get form data
$first_name = $_POST['first_name']; 
$last_name = $_POST['last_name'];
// etc

// Process form submission
// Insert into database etc

// Show confirmation message
echo "Registration successful!";
?>