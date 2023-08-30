<html>

<head>
  <title>
    Registration Form
  </title>
  <script src="https://cdn.tailwindcss.com"></script>
  <meta charset="utf-8">
</head>

<script>

  function submitData() {
    const formData = {
      firstName: document.getElementById('first_name').value,
      lastName: document.getElementById('last_name').value,
      // etc...
    };

    // Send request to processing page
    fetch('php/register_user.php', {
      method: 'POST',
      body: JSON.stringify(formData)
    });
  }

  window.addEventListener("DOMContentLoaded", (event) => {
    const bioInput = document.getElementById('bioInput');

    bioInput.addEventListener('input', () => {
      console.log("hey!");
      bioInput.style.height = 'auto';
      bioInputContainer.style.height = 'auto';
      bioInput.style.height = bioInput.scrollHeight + 'px';
      bioInputContainer.style.height = bioInput.scrollHeight + 'px';
    });
  });

  function hideSignIn() {
    var signIn = document.getElementById("signInFlow");
    var register = document.getElementById("registerFlow");
    signIn.classList.add("hidden");
    register.classList.remove("hidden");
  }

  function hideRegistration() {
    var signIn = document.getElementById("signInFlow");
    var register = document.getElementById("registerFlow");
    signIn.classList.remove("hidden");
    register.classList.add("hidden");
  }

</script>

<body>

  <div class="flex items-center justify-center h-full">

    <div id="signInFlow" class="bg-violet-50 p-6 rounded-lg shadow-md max-w-[80%] flex flex-col items-center space-y-6">

      <div class="text-xl font-medium">Welcome back!
      </div>

      <div class="flex flex-row space-x-2 w-full">
        <input class="border border-violet-200 rounded p-2 w-full" placeholder="Email">
        <input class="border border-violet-200 rounded p-2 w-full" placeholder="Password">
      </div>

      <div class="flow flow-row space-x-2">
        <button class="text-violet-50 text-lg bg-violet-400 shadow-xl p-2 rounded-md
 hover:bg-violet-600 active:bg-violet-700">
          Sign in
        </button>

        <button onclick="hideSignIn()" class="text-violet-50 text-lg bg-violet-400 shadow-xl p-2 rounded-md
 hover:bg-violet-600 active:bg-violet-700">
          No account?
        </button>
      </div>
    </div>

    <div id="registerFlow"
      class="bg-violet-50 p-6 hidden rounded-lg shadow-md max-w-[80%] flex flex-col items-center space-y-6">
      <div class="text-xl font-medium">User Registration
      </div>

      <div class="flex flex-row space-x-2 w-full">
        <input class="border border-violet-200 rounded p-2 w-full" placeholder="First name">
        <input class="border border-violet-200 rounded p-2 w-full" placeholder="Last name">
      </div>

      <div class="flex flex-row space-x-2">
        <input type="email" class="border border-violet-200 rounded p-2 w-full" placeholder="Email">
        <input class="border border-violet-200 rounded p-2 w-full" placeholder="Year/Grade">
      </div>

      <div class="flex flex-row space-x-2">
        <input type="password" class="border border-violet-200 rounded p-2 w-full" placeholder="Password">
        <input type="password" class="border border-violet-200 rounded p-2 w-full" placeholder="Confirm password">
      </div>

      <div id="bioInputContainer" class="w-full min-h-[2rem] max-h-48">
        <textarea id="bioInput" type="text"
          class="border border-violet-200 min-h-[4rem] rounded p-2 w-full max-h-48 resize-none" placeholder="Bio">
</textarea>
      </div>

      <div class="flow flow-row space-x-2">
        <button class="text-violet-50 text-lg bg-violet-400 shadow-xl p-2 rounded-md
 hover:bg-violet-600 active:bg-violet-700">
          Register
        </button>

        <button onclick="hideRegistration()" class="text-violet-50 text-lg bg-violet-400 shadow-xl p-2 rounded-md
 hover:bg-violet-600 active:bg-violet-700">
          Have an account?
        </button>
      </div>
    </div>

  </div>

</body>

</html>