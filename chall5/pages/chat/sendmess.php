<?php

    include_once "../../db.php";

    $recv = intval($_GET['user']);
    $send = $_SESSION['pid'];
    $mess = $_POST['mess'];

    $ka = $conn->prepare("SELECT * FROM user WHERE pid=$send");
    $ka->execute();
    $rt = $ka->fetch();
    $sender = $rt['name'];
    if($rt['avatar']!="") $sava = $rt['avatar'];
    else $sava = NULL;

    $ka = $conn->prepare("SELECT * FROM user WHERE pid=$recv");
    $ka->execute();
    $rt = $ka->fetch();
    $recver = $rt['name'];
    if($rt['avatar']!="") $rava = $rt['avatar'];
    else $rava = NULL;

    $insert = "INSERT INTO message (sid, send, sava, rid, receive, rava, mess) VALUES ($send,'$sender', '$sava', $recv, '$recver', '$rava', '$mess')";
    $conn->exec($insert);

    header("Location: ./chat.php?user=".$recv);
?>