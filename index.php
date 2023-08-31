<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// Create connection
require('php_connect/DB_connect.php');

$sql = "SELECT * FROM `groups`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while ($row = $result->fetch_assoc()) {
    // echo "Name: " . $row["user_name"]. " " . $row["last_name"]. "<br>";
  }
} else {
  // echo "0 groups";
}

session_start();
if (isset($_SESSION['user_id'])) {
  $signed_in = true;
}
?>


<!doctype html>
<html>

<head>
  <script src="https://cdn.tailwindcss.com"></script>
  <meta charset="utf-8">
  <title>Join a group</title>

  <style>
    :root {
      --ice-blue: #90fcf9ff;
      --magnolia: #f8f1ffff;
      --sandy-brown: #ff9b54ff;
      --russian-violet: #251351ff;
      --cardinal: #d11149ff;
    }
  </style>
</head>

<body>
  <div>
    <div class="content-wrapper grid sm:grid-cols-2 gap-4 lg:sm:grid-cols-4
 justify-items-center content-around p-20">
      <!-- Content here -->
      <?php
      if ($data === NULL): ?>
        <p class="justify-items-center">No groups exist!</p><?php else: ?>
      
        <?php foreach ($data as $item): ?>
          <div class="grid-item">
            
            <h3><?= $item[0] ?></h3>
      
            <hr>
      
            <p><?= $item[1] ?></p>
      
          </div><?php endforeach; ?>
      
      <?php endif; ?>

    </div>
    <div id="bottomControlContainer" class="w-full flex flex-row justify-center p-8 gap-x-4 fixed bottom-0">
      <?php
      if ($signed_in) {
        echo
          '<button id="add-group-btn" class="place-self-center text-violet-50 text-2xl bg-violet-400 p-2 rounded-md shadow-xl 
hover:bg-violet-600 active:bg-violet-700">
      Add group
    </button>
    <button id="log-out-btn" class="text-violet-50 text-2xl bg-violet-400 shadow-xl p-2 rounded-md
 hover:bg-violet-600 active:bg-violet-700">
      Log out
    </button>
    ';
      } else {
        echo '<button id="sign-in-btn" class="text-violet-50 text-2xl bg-violet-400 shadow-xl p-2 rounded-md
 hover:bg-violet-600 active:bg-violet-700">
      Sign in
    </button>';
      }
      ?>
    </div>

  </div>
</body>
<!--the html tag ends-->

</html>