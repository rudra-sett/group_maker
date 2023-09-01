<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$group_id = $_GET['group'];
// Create connection
require('php_connect/DB_connect.php');

$group_query = "SELECT * FROM groups WHERE `groups`.`group_id` = '$group_id'";
$members_query = "SELECT m.fname, m.lname, m.bio, g.group_id, m.year, m.member_id 
                  FROM members m 
                  JOIN groups_and_members gm ON m.member_id = gm.member_id
                  JOIN groups g ON gm.group_id = g.group_id";

// Execute the queries 
$group_result = $conn->query($group_query);
$members_result = $conn->query($members_query);
// Execute the queries 
$num_res = $group_result->num_rows;


if ($num_res == 0) {
  header("Location: index.php");
}


$group = $group_result->fetch_assoc();

$signed_in = false;
$in_group = false;
$user_id = -1;
session_start();
if (isset($_SESSION['user_id'])) {
  $signed_in = true;
  $user_id = $_SESSION['user_id'];
}

function isInAnyGroup($id_to_check): bool
{
  global $conn;
  $check_query = "SELECT * FROM groups_and_members 
  WHERE `groups_and_members`.`member_id` = '$id_to_check'";
  $res = $conn->query($check_query);
  $num_results = $res->num_rows;
  if ($num_results > 0) {
    return true;
  } else {
    return false;
  }
}

// get the messages too!
$messages_query = "SELECT m.message, p.fname, p.lname, p.year
                  FROM messages m 
                  JOIN members p ON m.member_id = p.member_id
                  WHERE m.group_id = '$group_id'";

// Execute the queries 
$messages = $conn->query($messages_query);
?>

<html>

<head>
  <title>
    Group
  </title>
  <script src="https://cdn.tailwindcss.com"></script>
  <meta charset="utf-8">
</head>

<script type="text/javascript">
  function sendMessage() { 
    var message = document.getElementById('messageInput').value;
    window.location.href = "php/send_message.php?message="+message+"&group="+<?=$group['group_id']?>;
  }
</script>

<body>
  <h3 class="px-6 py-4 bg-gray-200 text-gray-700 text-4xl text-ellipsis overflow-hidden top-0 break-words">
    <?= $group['name']; ?>
  </h3>
  <h2 class="px-6 py-4 bg-gray-100 text-gray-700 text-2xl text-ellipsis overflow-hidden top-0 break-words">
    <?= $group['description']; ?>
  </h2>

  <div class="flex flex-row">
    <!-- Holds the member info -->
    <div class="flex flex-col w-1/2 border-r-2">
      <h1 class="px-6 py-4 bg-gray-50 text-gray-700 text-xl text-ellipsis overflow-hidden top-0 break-words">
        Member list
      </h1>
      <!-- The list of members -->
      <div class="px-6 pb-4">
        <?php
        // Reset pointer to start, to get members for current group
        $members_result->data_seek(0);
        $is_member = false;
        ?>

        <?php while ($member = $members_result->fetch_assoc()): ?>
          <?php if ($member['group_id'] == $group['group_id']): ?>
            <p class="mt-2">
              <span class="font-bold text-xl">
                <?= $member['fname']; ?>
                <?= $member['lname']; ?>
              </span>
              <span class="font-light text-xs mb-8">
                <?= "" . $member['year'] . "" ?>
              </span>
            </p>
            <div class="hidden pt-4 pb-6 px-6">

              <!-- Show more info here -->
              <p>Detailed description of the group</p>

            </div>
            <p class="mb-4 text-gray-700 overflow-y-auto max-h-96 text-ellipsis overflow-hidden break-words">
              <span>
                <?= $member['bio']; ?>
              </span>
            </p>
            <hr>
            <?php if ($member['member_id'] == $user_id): ?>
              <?php $is_member = true; ?>
              <!-- <button id="add-group-btn" class="place-self-center text-violet-50 text-2xl bg-violet-400 p-2 rounded-md shadow-xl hover:bg-violet-600 active:bg-violet-700">
                      Leave group
                    </button> -->
            <?php endif; ?>
          <?php endif; ?>
        <?php endwhile; ?>

      </div>
      <div id="cardButtonPanel" class="fixed bottom-0 p-8 flex-row justify-items-around">
        <?php if ($is_member): ?>
          <button id="leave-group-btn"
            onclick="window.location.href = 'php/leave_group.php?group=<?php echo $group['group_id'] ?>'"
            class="place-self-center text-violet-50 text-xl bg-violet-400 p-2 rounded-md shadow-xl hover:bg-violet-600 active:bg-violet-700 ml-2 mb-2">
            Leave group
          </button>
        <?php endif; ?>
        <?php if (!$is_member & $signed_in & !isInAnyGroup($user_id)): ?>
          <button id="join-group-btn"
            onclick="window.location.href = 'php/join_group.php?group=<?php echo $group['group_id'] ?>'"
            class="place-self-center text-violet-50 text-xl bg-violet-400 p-2 rounded-md shadow-xl hover:bg-violet-600 active:bg-violet-700 ml-2 mb-2">
            Join group
          </button>
        <?php endif; ?>
        <button id="go-back-btn" onclick="window.location.href = 'index.php'"
          class="place-self-center text-violet-50 text-xl bg-violet-400 p-2 rounded-md shadow-xl hover:bg-violet-600 active:bg-violet-700 ml-2 mb-2">
          Go back
        </button>
      </div>
    </div>

    <!-- Displays a message history -->
    
    <div class="flex flex-col w-1/2 border-l-2 justify-between">
      <h1 class="px-6 py-4 bg-gray-50 text-gray-700 text-xl text-ellipsis overflow-hidden top-0 break-words">
        Message board
      </h1>
      <!-- message container -->
      <div class="px-6 pb-4">
        <?php while ($message = $messages->fetch_assoc()): ?>

          <p class="mt-2">
            <span class="font-bold text-xl">
              <?= $message['fname']; ?>
              <?= $message['lname']; ?>
            </span>
            <!-- <span class="font-light text-xs mb-8">
              <?= "" . $message['year'] . "" ?>
            </span> -->
          </p>
          <span class="text-md">
            <?= "" . $message['message'] . "" ?>
          </span>
          <p>
          </p>
          <hr>
        <?php endwhile; ?>

      </div>

      <!-- container for the message sending UI -->
      <?php if ($signed_in): ?>
      <div id="messageUIContainer" class="p-8 flex flex-row w-full gap-8 justify-between">
        <input id="messageInput" type="text"
          class="border border-violet-200 min-h-[4rem] rounded p-2 w-full max-h-48 resize-none" placeholder="Send message to the group...">
        <button onclick="sendMessage()" class="text-violet-50 text-lg bg-violet-400 shadow-xl p-2 rounded-md
 hover:bg-violet-600 active:bg-violet-700 min-w-[10%]">
          Send
        </button>
      </div>
      <?php endif; ?>
    </div>
  </div>
</body>

</html>