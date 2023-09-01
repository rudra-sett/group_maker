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
  <script>
    function submitGroupRegistrationData() {
      var data = {
        gname: document.getElementById('register_gname').value,
        gdesc: document.getElementById("groupDescInput").value,      
      };

      // console.log(data);

      var formData = new URLSearchParams(data).toString();

      // Send a POST request
      fetch('./php/create_group.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: formData
      })
        .then(response => response.text())
        .then(data => {
          // Do something with the response data
          if (data.substring(0, 5) == "ERROR") {
            alert(data.substring(6));
          } else if (data.substring(0,7) == "SUCCESS") {            
            window.location.href = "php/join_group.php?group="+data.substring(8);
          }
          console.log(data);
        })
        .catch((error) => console.error('Error:', error));
    }
  </script>
</head>

<body>

  <div class="flex flex-col items-center justify-center h-screen">
    <div id="addGroupFlow"
      class="bg-violet-50 p-6 rounded-lg shadow-md min-w-[60%] max-w-[80%] flex flex-col items-center space-y-6">
      <div class="text-xl font-medium">Group Registration
      </div>

      <div class="flex flex-row space-x-2 w-full">
        <input id="register_gname" class="border border-violet-200 rounded p-2 w-full" placeholder="Group name">
      </div>

      <div id="groupDescContainer" class="w-full min-h-[2rem] h-48">
        <textarea id="groupDescInput" type="text"
          class="border border-violet-200 min-h-[4rem] rounded p-2 w-full h-48 resize-none"
          placeholder="Group description">
</textarea>
      </div>

      <div class="flow flow-row space-x-2">
        <button onclick="submitGroupRegistrationData()" class="text-violet-50 text-lg bg-violet-400 shadow-xl p-2 rounded-md
 hover:bg-violet-600 active:bg-violet-700">
          Create group
        </button>

        <button onclick="location.href = 'index.php';" class="text-violet-50 text-lg bg-violet-400 shadow-xl p-2 rounded-md
 hover:bg-violet-600 active:bg-violet-700">
          Go back
        </button>
      </div>
    </div>

  </div>

</body>
<!--the html tag ends-->

</html>