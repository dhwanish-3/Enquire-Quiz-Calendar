<?php
require 'backup/config.php';
if(isset($_POST['submit'])){
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $emailQuery="SELECT * FROM user_details WHERE email='$email'";
    $query=mysqli_query($conn,$emailQuery);
    if(mysqli_num_rows($query)>0){
        $userdata=mysqli_fetch_array($query);
        $username=$userdata['name'];
        $subject="Reset Password";
        $token=$userdata['token'];
        $body="Hi, $username Click here to update your password\n
        http://localhost/enquireCalendardhwanish/reset_password.php?token=$token ";
        $sender_email="From: dhwani333sh@gmail.com";

        if(mail($email, $subject, $body , $sender_email)){
            $_SESSION['msg']="check your mail to reset your password";
            header('location:index.php');
        }else{
            echo "Failed to send mail... Check the email entered and try again...";
        }
    }else{
        echo "Account not found";
    }
}
?>