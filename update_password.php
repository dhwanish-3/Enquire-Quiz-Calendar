<?php
session_start();
ob_start();
if(isset($_GET['token'])){
    $_SESSION['token']=$_GET['token'];
}else{
    $_SESSION['update-msg']="Could not get token for verification";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- the following stylesheet has the icons in the login signup form form_container -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="style.css">
    <title>Update Password</title>
</head>
<style>
    body{
        background-color: var(--grey);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 700px;
    }
    .container{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: var(--textColor);
        padding: 2rem 3rem;
        border-radius: 1rem;
        width: fit-content;
    }
    .container header{
        font-size: 1.5rem;
        margin-bottom: 10px;
    }
    .container form{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 1rem;       
        background-color: var(--textColor);
    }
    .form-field input{
        width: 15rem;
        height: 2.5rem;
    }
    .go-button{
        font-size: 1rem;
    }
</style>
<body>
    <div class="container">
        <header>Update Password</header>
        <?php
        if(isset($_SESSION['update-msg'])){
            echo "<span class='session-msg'>{$_SESSION['update-msg']}</span>";
        }
        ?>
        <form action="auth/reset_password.php">
            <div class="form-field">
                <input type="password" placeholder="New password" required name="password">
            </div>
            <div class="form-field">
                <input type="password" placeholder="Confirm password" required name="cpassword">
            </div>
            <button class="button go-button" name="submit">Update</button>
        </form>
        <div class="poster">
            <span>Don't have an account?</span>
            <a href="index.php?signup=open">SignUp Here</a>
        </div>
    </div>
</body>
</html>