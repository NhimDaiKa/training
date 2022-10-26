<?php

    include_once "../../db.php";

    $name = $_POST['name'];
    $hint = $_POST['hint'];

    //xu ly file
    $file_tmp = $_FILES['file']['tmp_name'];
    $target_file = "chall/".basename($_FILES["file"]["name"]);

    //check trung ten file
    $ok = 1;
    if (file_exists($target_file))
        $ok = 0;

    if($ok){
        move_uploaded_file($file_tmp, $target_file);
        $file_name = $_FILES['file']['name'];

        $insert = "INSERT INTO chall (file, name, hint, date) VALUES ('$file_name','$name', '$hint', now())";
        $conn->exec($insert);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    else echo "Ten challenge bi trung";
?>