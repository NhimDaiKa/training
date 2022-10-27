<?php

    include_once "../../db.php";
    
    $mid = intval($_GET['mid']);
    $recv = intval($_GET['user']);
    $mess = $_POST['mess'];

    $da = $conn->prepare("UPDATE message SET mess='$mess' WHERE mid='$mid'");
    $da->execute();

    header("Location: ./chat.php?user=".$recv);
?>

