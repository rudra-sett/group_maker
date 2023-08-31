<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Create connection
require('php_connect/DB_connect.php');

// Query to get group data
$groups_query = "SELECT * FROM groups";

// Query to get member data and join with groups
$members_query = "SELECT m.fname, m.lname, m.bio, g.group_id, m.year, m.member_id 
                  FROM members m 
                  JOIN groups_and_members gm ON m.member_id = gm.member_id
                  JOIN groups g ON gm.group_id = g.group_id";

// Execute the queries 
$groups_result = $conn->query($groups_query);
$members_result = $conn->query($members_query);

$user_id = -1;
$signed_in = false;
$in_group = false;
session_start();
if (isset($_SESSION['user_id'])) {
  $signed_in = true;
  $user_id = $_SESSION['user_id'];
}

function isInAnyGroup($id_to_check) : bool {
  global $conn;
  $check_query = "SELECT * FROM groups_and_members";
  $res = $conn->query($check_query);
  $num_results = $res->num_rows;
  if ($num_results > 0) {
    return true;
  } else {
    return false;
  }
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
  <script type="text/javascript">
    function leaveGroup(group_id) {
      window.location.href = "php/leave_group.php?group="+group_id;
    }

    function joinGroup(group_id) {
      window.location.href = "php/join_group.php?group="+group_id;
    }

  </script>
</head>

<body>
  <div>
    <div class="content-wrapper grid sm:grid-cols-2 gap-4 lg:sm:grid-cols-4
 justify-items-center content-around p-20">
      <!-- Content here -->
      <?php if ($groups_result->num_rows == 0): ?>
        <p class="text-center text-gray-500">No groups exist!</p>

      <?php else: ?>

        <?php while ($group = $groups_result->fetch_assoc()): ?>

          <article class="rounded-md overflow-auto shadow-lg min-w-full w-1/4 max-h-96">

            <h3 class="px-6 py-4 bg-gray-200 text-gray-700 text-xl text-ellipsis overflow-hidden max-h-48 break-words">
              <?= $group['name']; ?>
            </h3>

            <div class="px-6 pb-4">

              <?php
              // Reset pointer to start, to get members for current group
              $members_result->data_seek(0);
              $is_member = false;
              ?>

              <?php while ($member = $members_result->fetch_assoc()): ?>
                <?php if ($member['group_id'] == $group['group_id']): ?>
                  <p class="mt-2">
                    <span class="font-bold leading-3">
                      <?= $member['fname']; ?>
                      <?= $member['lname']; ?>
                    </span>
                  </p>
                  <span class="font-light text-xs leading-3 mb-8">
                    <?= "" . $member['year'] . "" ?>
                  </span>
                  <!-- <p class="mb-4 text-gray-700 overflow-y-auto max-h-24 text-ellipsis overflow-hidden break-words">
                    <span>
                      <?= $member['bio']; ?>
                    </span>
                  </p> -->
                  <?php if ($member['member_id'] == $user_id): ?>
                    <?php $is_member = true; ?>
                    <!-- <button id="add-group-btn" class="place-self-center text-violet-50 text-2xl bg-violet-400 p-2 rounded-md shadow-xl hover:bg-violet-600 active:bg-violet-700">
                      Leave group
                    </button> -->
                  <?php endif; ?>
                <?php endif; ?>
              <?php endwhile; ?>  
              <hr>
            </div>
            <div id="cardButtonPanel" class="relative bottom-0">
              <?php if ($is_member): ?>
                <button id="leave-group-btn" onclick="leaveGroup(<?php echo $group['group_id']?>)"
                  class="place-self-center text-violet-50 text-sm bg-violet-400 p-2 rounded-md shadow-xl hover:bg-violet-600 active:bg-violet-700 ml-2 mb-2">
                  Leave group
                </button>
                <?php $in_group = true;?>
              <?php endif; ?>

              <?php if (!$is_member & $signed_in & !isInAnyGroup($user_id)): ?>
                <button id="join-group-btn" onclick="joinGroup(<?php echo $group['group_id']?>)"
                  class="place-self-center text-violet-50 text-sm bg-violet-400 p-2 rounded-md shadow-xl hover:bg-violet-600 active:bg-violet-700 ml-2 mb-2">
                  Join group
                </button>
              <?php endif; ?>
            </div>

          </article>

        <?php endwhile; ?>

      <?php endif; ?>
    </div>
    <div id="bottomControlContainer" class="w-full flex flex-row justify-center p-8 gap-x-4 fixed bottom-0">

      <?php if ($signed_in): ?>
        <button id="add-group-btn" class="place-self-center text-violet-50 text-2xl bg-violet-400 p-2 rounded-md shadow-xl 
hover:bg-violet-600 active:bg-violet-700">
          Add group
        </button>
        <button id="log-out-btn" class="text-violet-50 text-2xl bg-violet-400 shadow-xl p-2 rounded-md
 hover:bg-violet-600 active:bg-violet-700">
          Log out
        </button>

      <?php else: ?>
        <button onclick="location.href = 'sign_in.php';" id="sign-in-btn" class="text-violet-50 text-2xl bg-violet-400 shadow-xl p-2 rounded-md
 hover:bg-violet-600 active:bg-violet-700">
          Sign in
        </button>
      <?php endif; ?>
    </div>

  </div>
</body>
<!--the html tag ends-->

</html>