<?php
// set the variables

// your database name
$dbname = 'group_maker_db';

// your username if set
$username = 'root';

// in this case no password is set so leave blank
$password = '';

// the server name would change if not hosted on the client virtual server
// this varible can be obtained from the hosting company were your database and web site is hosted
$servername = '127.0.0.1';

// Create connection by using the variables as arguments in a new instance of a mysqli class called $conn
$conn = new mysqli($servername, $username, $password, $dbname);


// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>