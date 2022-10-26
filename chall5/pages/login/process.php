<?php

include_once "../../db.php";

if (isset($_POST['user']) && isset($_POST['pass'])) {
	
	$user = $_POST['user'];
	$pass = $_POST['pass'];

    // thiết lập kiểu dữ liệu trả về
    $da = $conn->prepare("SELECT * FROM user WHERE user=:user AND pass=:pass");
    $da->execute(['user'=>$user, 'pass'=>$pass]);

    if ($rt = $da->fetch()) {

        $_SESSION['usr'] = $user;
        $_SESSION['pid'] = $rt['pid'];
        $_SESSION['pass'] = $pass;
        
        setcookie($user, 'usr='.$pass, time() + (86400 * 30), "/");

        if(isset($_SESSION['w'])) unset($_SESSION['w']);

        header("Location:../../dashboard.php");

	}
    else {
        $_SESSION['w'] = 1;
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

?>