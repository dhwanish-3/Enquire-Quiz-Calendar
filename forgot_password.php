<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Forgot Password</title>
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
        <header>Reset Password</header>
        <form action="recover_email.php">
            <div class="form-field">
                <input type="email" placeholder="Enter your email address" required name="email">
            </div>            
            <button class="button go-button" name="submit">SUBMIT</button>
        </form>
    </div>
</body>
</html>