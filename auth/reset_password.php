<?php
ob_start();
require '../backup/config.php';
if(isset($_POST['submit']) && isset($_SESSION['token'])){
    $token=$_SESSION['token'];
    $newPassword=mysqli_real_escape_string($conn,$_POST['password']);
    $confirmPassword=mysqli_real_escape_string($conn,$_POST['cpassword']);
    if($newPassword!=$confirmPassword){
        $_SESSION['update-msg']="Paswords do not match";
        header('Location: ../forgot_password.php');
    }
    $tokenQuery="SELECT * FROM user_details WHERE token='$token'";
    $query=mysqli_query($conn,$tokenQuery);
    if(mysqli_num_rows($query)>0){
        $updatePassword=password_hash($newPassword,PASSWORD_BCRYPT);
        $updateQuery="UPDATE user_details SET password='$updatePassword' WHERE token='$token'";
        $query=mysqli_query($conn,$updateQuery);
        if($query){
            $_SESSION['login-msg']="Your password has been updated";
            header('Location: ../index.php?login=password_updated');
        }else{
            $_SESSION['update-msg']="Could not update password.\nPlease try again.";
        }
    }else{
        $_SESSION['update-msg']="Account not found";
    }
}else{
    $_SESSION['update-msg']="Could not get token for verification";
}
header('Location: ../forgot_password.php');
?>