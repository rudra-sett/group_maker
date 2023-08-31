<html>

<head>
  <title>
    Registration Form
  </title>
  <script src="https://cdn.tailwindcss.com"></script>
  <meta charset="utf-8">
</head>

<script>

  function submitLoginData() {
    const data = {
      email: document.getElementById('login_email').value,
      password: document.getElementById('login_password').value,
      // etc...
    };
    var formData = new URLSearchParams(data).toString();

    // Send a POST request
    fetch('./php/login_user.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: formData
    })
      .then(response => response.text())
      .then(data => {
        // Do something with the response data
        // console.log(data);
        if (data == "0FAILED") {
          alert("Invalid credentials!");
        } else if (data == "1FOUND USER") {
          window.location.href = "index.php";
        }
      })
      .catch((error) => console.error('Error:', error));
  }

  function submitRegistrationData() {
    var data = {
      fname: document.getElementById('register_fname').value,
      lname: document.getElementById("register_lname").value,
      email: document.getElementById('register_email').value,
      year: document.getElementById('register_year').value,
      password: document.getElementById('register_pass_1').value,
      password_c: document.getElementById('register_pass_2').value,
      bio: document.getElementById('bioInput').value
      // etc...
    };
    
    // console.log(data);

    var formData = new URLSearchParams(data).toString();

    // Send a POST request
    fetch('./php/register_user.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: formData
    })
      .then(response => response.text())
      .then(data => {
        // Do something with the response data
        if (data.substring(0,5) == "ERROR") {
          alert(data.substring(6));
        } else if (data == "SUCCESS") {
          window.location.href = "index.php";
        }
        // console.log(data);
      })
      .catch((error) => console.error('Error:', error));
  }

  window.addEventListener("DOMContentLoaded", (event) => {
    const bioInput = document.getElementById('bioInput');

    bioInput.addEventListener('input', () => {      
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
        <input type="email" id="login_email" class="border border-violet-200 rounded p-2 w-full" placeholder="Email">
        <input type="password" id="login_password" class="border border-violet-200 rounded p-2 w-full"
          placeholder="Password">
      </div>

      <div class="flow flow-row space-x-2">
        <button onclick="submitLoginData()" class="text-violet-50 text-lg bg-violet-400 shadow-xl p-2 rounded-md
 hover:bg-violet-600 active:bg-violet-700">
          Sign in
        </button>

        <button onclick="hideSignIn()" class="text-violet-50 text-lg bg-violet-400 shadow-xl p-2 rounded-md
 hover:bg-violet-600 active:bg-violet-700">
          No account?
        </button>
      </div>
    </div>
    <!-- This is the box for registration -->
    <div id="registerFlow"
      class="bg-violet-50 p-6 hidden rounded-lg shadow-md max-w-[80%] flex flex-col items-center space-y-6">
      <div class="text-xl font-medium">User Registration
      </div>

      <div class="flex flex-row space-x-2 w-full">
        <input id="register_fname" class="border border-violet-200 rounded p-2 w-full" placeholder="First name">
        <input id="register_lname" class="border border-violet-200 rounded p-2 w-full" placeholder="Last name">
      </div>

      <div class="flex flex-row space-x-2 w-full">
        <input id="register_email" type="email" class="border border-violet-200 rounded p-2 w-full" placeholder="Email">
        <select id="register_year" class="border border-violet-200 rounded p-2 w-full" placeholder="Year/Grade">
          <option value="1st year (UG)">1st year (UG)</option>
          <option value="2nd year (UG)">2nd year (UG)</option>
          <option value="3rd year (UG)">3rd year (UG)</option>
          <option value="4th year (UG)">4th year (UG)</option>
          <option value="5th+ year (UG)">5th+ year (UG)</option>
          <option value="1st year (G)">1st year (G)</option>
          <option value="2nd+ year (G)">2nd+ year (G)</option>
        </select>
      </div>

      <div class="flex flex-row space-x-2">
        <input id="register_pass_1" type="password" class="border border-violet-200 rounded p-2 w-full"
          placeholder="Password">
        <input id="register_pass_2" type="password" class="border border-violet-200 rounded p-2 w-full"
          placeholder="Confirm password">
      </div>

      <div id="bioInputContainer" class="w-full min-h-[2rem] max-h-48">
        <textarea id="bioInput" type="text"
          class="border border-violet-200 min-h-[4rem] rounded p-2 w-full max-h-48 resize-none" placeholder="Bio">
</textarea>
      </div>

      <div class="flow flow-row space-x-2">
        <button onclick="submitRegistrationData()" class="text-violet-50 text-lg bg-violet-400 shadow-xl p-2 rounded-md
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