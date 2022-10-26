<?php
    include_once "../../db.php";

	$id = intval($_GET['id']);
    $user = $_POST['user'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $number = $_POST['number'];
    $pass = $_POST['pass'];

    $na = $conn->prepare("UPDATE user SET user='$user',pass='$pass',email='$email',name='$name',sdt='$number' WHERE pid='$id'");
	$na->execute();
		
	header("Location:./basic-table.php");
?>