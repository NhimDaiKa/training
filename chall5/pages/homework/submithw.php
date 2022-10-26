<?php

    include_once "../../db.php";

    $prj_id = $_GET['hw'];
    $pid = $_SESSION['pid'];
    $user = $_SESSION['usr'];

    if(isset($_FILES['file'])){
        //xu ly file
        $file_tmp = $_FILES['file']['tmp_name'];
        $target_file = "homework/".basename($_FILES["file"]["name"]);

        //check trung ten file
        $count = 0;
        while (file_exists($target_file)) {
            $count++;
            $file_tmp = '('.$count.')'.$_FILES['file']['name'];
            $target_file = "homework/".$file_tmp;
        }

        move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
        if($count>0) $file_name = '('.$count.')'.$_FILES['file']['name'];
        else $file_name = $_FILES['file']['name'];

        $insert = "INSERT INTO hws (file, date, pid, user, prj_id) VALUES ('$file_name',now(), $pid, '$user', $prj_id)";
        $conn->exec($insert);
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>