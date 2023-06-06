<?php
require 'backup/google.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="style.css" />
    <title>Enquire Calender by Dhwanish</title>
</head>
<body>
    <!-- Header -->
    <header class="header">
      <div class="enquire">
        <img src="./images/logo.png" alt="">
        <span>ENQUIRE QUIZ CLUB<span>
      </div>
      <div class="menu">
        <?php
          // Check if the user is logged in
        if (isset($_SESSION['email'])) {
          echo "<span>Hello, {$_SESSION['name']}</span>"
          ?>
           <button class="button" onclick="window.location.href = 'logout.php'">LOGOUT</button>
        <?php
        }else{ ?>
          <button class="button" id="form-open">LOGIN</button>
        <?php
        }
        ?>
      </div>
    </header>

    <!-- Home -->
    <section class="home">
      <div class="form_container">
        <i class="uil uil-times form_close"></i>
        <!-- Login From -->
        <div class="form login_form">
          <form action="login.php" method="POST">
            <h2>LOGIN</h2>
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
            <button class="button">LOGIN NOW</button>
          </form>
          <a href="<?php echo $client->createAuthUrl(); ?>"><button id="google-button"><img src="images/google-logo.png">Sign in with Google</button></a>
          <div class="login_signup">Don't have an account? <a href="#" id="signup">Signup</a></div>
        </div>

        <!-- Signup From -->
        <div class="form signup_form">
          <form action="signup.php" method="POST">
            <h2>SIGNUP</h2>
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
            <button class="button" onclick="return checkPasswords()">SIGNUP NOW</button>
          </form>
          <a href="<?php echo $client->createAuthUrl(); ?>"><button id="google-button"><img src="images/google-logo.png">Sign in with Google</button></a>
          <div class="login_signup">Already have an account? <a href="#" id="login">Login</a></div>       
        </div>
      </div>
    </section>

    <!-- Quiz Calendar -->
    <section class="main-body">
      <div class="calendars">
        <header>Quiz Calendar</header>
        <!-- <div class="bod col-md-8"> -->
          <div class="two-calendars">
            <div class="wrapper">
              <header>
                <p class="current-date"></p>
              </header>
              <div class="calendar">
                <ul class="weeks">
                  <li>Sun</li>
                  <li>Mon</li>
                  <li>Tue</li>
                  <li>Wed</li>
                  <li>Thu</li>
                  <li>Fri</li>
                  <li>Sat</li>
                </ul>
                <ul class="days"></ul>
              </div>
            </div>
            <!-- </div> -->
            <!-- <div class="bod col-md-8"> -->
            <div class="wrapper">
              <header>
                <p class="current-date2"></p>
              </header>
              <div class="calendar">
                <ul class="weeks">
                  <li>Sun</li>
                  <li>Mon</li>
                  <li>Tue</li>
                  <li>Wed</li>
                  <li>Thu</li>
                  <li>Fri</li>
                  <li>Sat</li>
                </ul>
                <ul class="days2"></ul>
              </div>
            </div>
          </div>  
        <!-- </div> -->
        <section class="category-buttons">
          <div class="first-row">
            <button class="button  open">OPEN</button>
            <button class="button  school">SCHOOL</button>
            <button class="button  college">COLLEGE</button>
          </div>
          <div class="second-row">
          <button class="button  open-school">OPEN & SCHOOL</button>
            <button class="button  open-college">OPEN & COLLEGE</button>
            <button class="button  school-college">SCHOOL & COLLEGE</button>
          </div>
        </section>
      </div>
      <!-- Ads Section -->
      <div class="ads-part">
        <div class="heading">
          <span>Popular Events</span>
        </div>
        <div class="poster">
          <span id="prev" class="material-symbols-rounded">l</span>
          <img src="images/poster.jpg" alt="">
          <span id="next" class="material-symbols-rounded">r</span>
        </div>
        <div class="event-details">
          <span>Event : Mega Quiz</span>
          <span>Date : 12-06-2023</span>
          <span>Venue : GHSS Paivalike Nagar, Paivalike</span>
          <span>Type : Sci-Tech-Biz Quiz</span>
          <span>Category : School & College</span>
          <span>Quiz Masters : BatMan & SuperMan</span>
          <span>Contact : 9876543210 </span>
        </div>
      </div>
    </section>
    <section class="fav-events">
      <div class="question">
        <span>HARD TIME SORTING YOUR FAVOURITE </span>
        <span>QUIZ EVENTS ?</span>
      </div>
      <div class="slider-container">
        <div class="range">
          <label for="general">General</label>
          <div class="slider">            
            <div class="range-thumb" id="range-thumb1">
              <div class="range-value">
                <div class="value-number" id="value-number1">
                  <span id="range-number1">5</span>
                </div>
              </div>
            </div>
            <div class="range-slider">
              <span>0</span>
              <input type="range" class="range-input" id="range-input1" name="general" min="0" max="10" value="5" step="1">
              <span>10</span>
            </div>
          </div>
        </div>
        <div class="range">
          <label for="sci-tech">Sci-Tech</label>
          <div class="slider">            
            <div class="range-thumb" id="range-thumb2">
              <div class="range-value">
                <div class="value-number" id="value-number2">
                  <span id="range-number2">5</span>
                </div>
              </div>
            </div>
            <div class="range-slider">
              <span>0</span>
              <input type="range" class="range-input" id="range-input2" name="general" min="0" max="10" value="5" step="1">
              <span>10</span>
            </div>
          </div>
        </div>
        <div class="range">
          <label for="business">Business</label>
          <div class="slider">            
            <div class="range-thumb" id="range-thumb3">
              <div class="range-value">
                <div class="value-number" id="value-number3">
                  <span id="range-number3">5</span>
                </div>
              </div>
            </div>
            <div class="range-slider">
              <span>0</span>
              <input type="range" class="range-input" id="range-input3" name="general" min="0" max="10" value="5" step="1">
              <span>10</span>
            </div>
          </div>
        </div>
        <div class="range">
          <label for="sci-tech-biz">Sci-Tech-Biz</label>
          <div class="slider">            
            <div class="range-thumb" id="range-thumb4">
              <div class="range-value">
                <div class="value-number" id="value-number4">
                  <span id="range-number4">5</span>
                </div>
              </div>
            </div>
            <div class="range-slider">
              <span>0</span>
              <input type="range" class="range-input" id="range-input4" name="general" min="0" max="10" value="5" step="1">
              <span>10</span>
            </div>
          </div>
        </div>
        <div class="range">
          <label for="sports">Sports</label>
          <div class="slider">            
            <div class="range-thumb" id="range-thumb5">
              <div class="range-value">
                <div class="value-number" id="value-number5">
                  <span id="range-number5">5</span>
                </div>
              </div>
            </div>
            <div class="range-slider">
              <span>0</span>
              <input type="range" class="range-input" id="range-input5" name="general" min="0" max="10" value="5" step="1">
              <span>10</span>
            </div>
          </div>
        </div>
        <div class="range">
          <label for="mela">Mela</label>
          <div class="slider">            
            <div class="range-thumb" id="range-thumb6">
              <div class="range-value">
                <div class="value-number" id="value-number6">
                  <span id="range-number6">5</span>
                </div>
              </div>
            </div>
            <div class="range-slider">
              <span>0</span>
              <input type="range" class="range-input" id="range-input6" name="general" min="0" max="10" value="5" step="1">
              <span>10</span>
            </div>
          </div>
        </div>
      </div>     
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="script.js" defer></script>
</body>
</html>