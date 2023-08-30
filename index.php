<?php 

$servername = "localhost";
$username = "root";
$password = "";

// $data = [
//   ['Group 1', 'Text 1'],
//   ['Group 2', 'Text 2'],
//   ['Title 3', 'Text 3'],
//   ['Title 3768126471461874', 'Text 3'],
//   ['Title 3', 'Text 3'],
//   ['Title 3', 'Text 3'],
//   ['Title 3', 'Text 3'],
//   ['Title 3', 'Text 3'],
//   ['Title 33424209489028429079', 'Text 3'],
//   ['Title 3', 'Text 3'],
//   ['Title 32i58729527985289752982857298572985729857987298572983', 'Text 3'],
//   ['Title 3', 'Text 3'],
//   ['Title 3', 'Text 3184718461987194732848729847298479'],
//   ['Title 3', 'Text 3'],
//   ['Title 3', 'Text 3'],
//   ['Title 3', 'Text 3'], 
//   ['Title 3', 'Text 3184718461987194732848729847298479'],
//   ['Title 3', 'Text 3'],
//   ['Title 3', 'Text 3'],
//   ['Title 3', 'Text 3'], 
//   ['Title 3', 'Text 3184718461987194732848729847298479'],
//   ['Title 3', 'Text 3'],
//   ['Title 3', 'Text 3'],
//   ['Title 3', 'Text 3'], 
// ];

// Create connection
$conn = new mysqli($servername, $username, $password,"group_maker_db");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully <br>";
	
$sql = "SELECT * FROM `groups`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    // echo "Name: " . $row["user_name"]. " " . $row["last_name"]. "<br>";
  }
} else {
  // echo "0 groups";
}


?>


<!doctype html>
<html>
<head>
<script src="https://cdn.tailwindcss.com"></script>
<meta charset="utf-8">
<title></title>
<style type="text/tailwindcss">
  @tailwind base;
    @layer utilities {
      .content-auto {
        content-visibility: auto;
      }
    }
</style>
<style>



:root {
--ice-blue: #90fcf9ff;
--magnolia: #f8f1ffff;
--sandy-brown: #ff9b54ff;
--russian-violet: #251351ff;
--cardinal: #d11149ff;
}

html, body {
  height: 100%;
}

.page-wrapper {
  position: relative;
  height: 100%;  
  /* additional styling */ 
}

.content-wrapper {
  padding-bottom: 40px; /* height of buttons */ 
  /* display: grid;
  grid-template-columns: auto auto auto;
  grid-template-rows: auto auto auto;
  justify-items: center; */
}

.button {
  position: absolute;
  bottom: 0;  
  /* button styling */
  background-color:var(--russian-violet);
}

#add-group-btn {
  position: fixed;
  left: 40px;
  bottom: 40px;
}

#sign-in-btn {
  position: fixed; 
  right: 40px;
  bottom: 40px;
}
  
</style>
</head>
<body><div>
<div class="content-wrapper grid sm:grid-cols-2 gap-4 lg:sm:grid-cols-4
 justify-items-center content-around p-20">
    <!-- Content here -->
		<?php 
      if ($data === NULL) {
        echo '<p class="justify-items-center">No groups exist!</p>';
      }
      else {
			echo '
			
			';
			
			
			foreach ($data as $item) {
			echo '<div class="grid-item border-2 border-rose-200
      rounded-md flex flex-col min-w-full">';
			echo '
			
			<h3 class = "text-lg p-4 whitespace-normal break-all">
			' . $item[0] . '
			
			</h3>
      <hr class="h-1 w-3/4 place-self-center bg-gray-300 border-0 rounded">
			';
			echo '
			
			<p class="text-sm p-2 place-self-center break-all whitespace-normal">
			' . $item[1] . '
			
			</p>
			';
			echo '
			
			</div>
			';
			}
			
			
			echo '';}
		
		?>

</div>
<button id="add-group-btn" class=" text-violet-50 text-2xl bg-violet-400 p-2 rounded-md shadow-xl 
hover:bg-violet-600 active:bg-violet-700">
Add group
</button>
<button id="sign-in-btn" class="text-violet-50 text-2xl bg-violet-400 shadow-xl p-2 rounded-md
 hover:bg-violet-600 active:bg-violet-700">
Sign in
</button>
</div>  
</body>
<!--the html tag ends-->
</html>