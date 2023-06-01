<?php
require 'config.php';
require 'backup/google.php';
// if(isset($_SESSION['email'])){
//     header('Location: index.php?google-login=success');
//     exit;
// }
?>
<?php
// Check if the user is logged in
if (isset($_SESSION['name'])) {
  // Display the welcome message
  echo "Hello, " . $_SESSION['name'] . "!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <title>EnQuire Calender by Dhwanish</title>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <img src="./images/logo.png" alt="">
        <?php
          // Check if the user is logged in
        if (isset($_SESSION['email'])) { ?>
           <button class="button" onclick="window.location.href = 'logout.php'">LogOut</button>
        <?php
        }else{ ?>
          <button class="button" id="form-open">LogIn</button>
        <?php
        }
        ?>
    </header>
    <!-- Home -->
    <section class="home">
      <div class="form_container">
        <i class="uil uil-times form_close"></i>
        <!-- Login From -->
        <div class="form login_form">
          <form action="login.php" method="POST">
            <h2>Login</h2>
            <div class="input_box">
              <input type="email" placeholder="Enter your email" required name="email"/>
              <i class="uil uil-envelope-alt email"></i>
            </div>
            <div class="input_box">
              <input type="password" placeholder="Enter your password" required name="password"/>
              <i class="uil uil-lock password"></i>
              <i class="uil uil-eye-slash pw_hide"></i>
            </div>
            <div class="option_field">
              <span class="checkbox">
                <input type="checkbox" id="check" />
                <label for="check">Remember me</label>
              </span>
              <a href="#" class="forgot_pw">Forgot password?</a>
            </div>
            <button class="button">Login Now</button>      
          </form>
          <a href="<?php echo $client->createAuthUrl(); ?>"><button id="google-button"><img src="images/google-logo.png">Sign in with Google</button></a>
          <div class="login_signup">Don't have an account? <a href="#" id="signup">Signup</a></div>
        </div>

        <!-- Signup From -->
        <div class="form signup_form">
          <form action="signup.php" method="POST">
            <h2>Signup</h2>
            <div class="input_box">
              <i class="uil uil-user-circle name"></i>
              <input type="text" placeholder="Enter your name" required name="name"/>           
            </div>
            <div class="input_box">
              <input type="email" placeholder="Enter your email" required name="email"/>
              <i class="uil uil-envelope-alt email"></i>
            </div>
            <div class="input_box">
              <input type="password" placeholder="Create password" required id="password1" name="password" />
              <i class="uil uil-lock password"></i>
              <i class="uil uil-eye-slash pw_hide"></i>
            </div>
            <div class="input_box">
              <input type="password" placeholder="Confirm password" required id="password2" />
              <i class="uil uil-lock password"></i>
              <i class="uil uil-eye-slash pw_hide"></i>
            </div>
            <button class="button" onclick="return checkPasswords()">SignUp now</button>
          </form>
          <a href="<?php echo $client->createAuthUrl(); ?>"><button id="google-button"><img src="images/google-logo.png">Sign in with Google</button></a>
          <div class="login_signup">Already have an account? <a href="#" id="login">Login</a></div>       
        </div>
        <script>
          const urlParams = new URLSearchParams(window.location.search);
          const signup = urlParams.get('signup');
          if (signup === 'success') {
            const message = document.createElement('p');
            message.innerText = 'You have successfully signed up!';
            document.body.appendChild(message);
          }
        </script>
      </div>
    </section>
    <script src="script.js" defer></script>
</body>
</html>