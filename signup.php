<?php
    require 'backup/config.php';
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	// checking email already in use
	$check = $conn->query("SELECT * FROM user_details WHERE email = '{$email}'");
	if($check->num_rows>0){
		$conn->close();
		header("Location: index.php?signup=email_already_in_use");
	}
	else{
		$stmt = $conn->prepare("INSERT INTO user_details(name,email,password) VALUES(?, ?, ?)");
		$stmt->bind_param("sss", $name,$email,$password);
		$execval = $stmt->execute();
		$_SESSION['email'] = $email;
		$_SESSION['name'] = $name;
		$_SESSION['password'] = $password;
		$stmt->close();
		$conn->close();
		header("Location: index.php?signup=success");
	}
?>
