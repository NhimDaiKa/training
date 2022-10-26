<?php

    include_once "../../db.php";

    $id = $_SESSION['pid'];

    if(!empty($_POST['email'])){
        $email = $_POST['email'];
        $da = $conn->prepare("UPDATE user SET email='$email' WHERE pid='$id'");
        $da->execute();
    }

    if(!empty($_POST['pass'])){
        $pass = $_POST['pass'];
        $da = $conn->prepare("UPDATE user SET pass='$pass' WHERE pid='$id'");
        $da->execute();
    }

    if(!empty($_POST['number'])){
        $sdt = $_POST['number'];
        $da = $conn->prepare("UPDATE user SET sdt='$sdt' WHERE pid='$id'");
        $da->execute();
    }

    if(!empty($_POST['bio'])){
        $bio = $_POST['bio'];
        $da = $conn->prepare("UPDATE user SET bio='$bio' WHERE pid='$id'");
        $da->execute();
    }

    if(isset($_FILES['image'])){
        $errors= array();
	    $file_name = $_FILES['image']['name'];
	    $file_size = $_FILES['image']['size'];
	    $file_tmp = $_FILES['image']['tmp_name'];
	    $file_type = $_FILES['image']['type'];
	    $file_parts =explode('.',$_FILES['image']['name']);
	    $file_ext=strtolower(end($file_parts));
	    $expensions= array("jpeg","jpg","png");
	    $image = $_FILES['image']['name'];
	    $target = "../../photo/".basename($image);

		// Kiểm tra kiểu file
		if (in_array($file_ext,$expensions)) {
	        move_uploaded_file($file_tmp, $target);

	        $ava = "UPDATE user SET avatar='$image' WHERE pid='$id'";
	        $don = $conn->prepare($ava);
	        $don->execute();

            $ava = "UPDATE message SET sava='$image' WHERE sid='$id'";
            $don = $conn->prepare($ava);
	        $don->execute();

            $ava = "UPDATE message SET rava='$image' WHERE rid='$id'";
            $don = $conn->prepare($ava);
	        $don->execute();
	    }
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>