<?php

    include_once "../../db.php";
	
    $user = $_POST['user'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $number = $_POST['number'];
    $pass = $_POST['pass'];

    // thiết lập kiểu dữ liệu trả về
    $insert = "INSERT INTO user(user, pass, name, role, email, sdt) VALUES ('$user', '$pass', '$name', 0, '$email', '$number')";

    $conn->exec($insert);
	header("Location: ../tables/basic-table.php");
?>