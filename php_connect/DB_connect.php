<?php
// set the variables

// your database name
$dbname = 'summerschoolex';

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

// echo "connected<hr>";
/*exit;
// connection is good so
// run your query
$sql = "SELECT * FROM `users`";
$result = $conn->query($sql);

// reosults are an array so loop through until there are no more records
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {

// echo out the results stored in the $row variable
// these are the names of the columns preceded by a text string description
// gaps are added in the strings to make the output readable, lastly a line break is added to seperate the rows
			echo 
			"id: " . $row["user_Id"].
			" first name: " . $row["f_name"]. 
			" last name: " . $row["l_name"]. 
			" date of birth: " . $row["dob"]. 
			" age: " . $row["age"]. 			
			" <br> ";
  }
// if the above finds data this next line is ignored, if not the text 0 results is shown
			} else {
				echo "0 results";
					}
// close the connectioon					
$conn->close();*/


?>