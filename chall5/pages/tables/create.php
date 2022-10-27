<?php
	
	include_once "../../db.php";
	$newuser = $_POST['user'];
	$nickname = $_POST['nickname'];
	$newpass = $_POST['pass'];
	$email = $_POST['email'];
	$insert = "INSERT INTO 21days (user, pass, name, role, email) VALUES ('$newuser', '$newpass', '$nickname', 0, '$email')";

	// use exec() because no results are returned
	$conn->exec($insert);
	header("Location:./admin.php");

	
?>