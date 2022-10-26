<?php

    include_once "../../db.php";

    $name = $_POST['name'];

    //xu ly file
    $file_tmp = $_FILES['file']['tmp_name'];
    $target_file = "file/".basename($_FILES["file"]["name"]);

    //check trung ten file
    $count = 0;
    while (file_exists($target_file)) {
        $count++;
        $file_tmp = '('.$count.')'.$_FILES['file']['name'];
        $target_file = "file/".$file_tmp;
    }

    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
    if($count>1) $file_name = '('.$count.')'.$_FILES['file']['name'];
    else $file_name = $_FILES['file']['name'];

    $insert = "INSERT INTO hwt (name, file, date) VALUES ('$name','$file_name', now())";
    $conn->exec($insert);

    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>