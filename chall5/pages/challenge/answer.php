<?php

    include_once "../../db.php";

    $cid = intval($_GET['cid']);
    $ans = $_POST['ans'];

    $na = $conn->prepare("SELECT * FROM chall where cid=$cid");
    $na->execute();
    $rt = $na->fetch();

    $answer = $rt['file'];
    $answer = substr($answer, 0, -4);
    if($ans == $answer)
        $_SESSION['ans'] = $cid;
    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>