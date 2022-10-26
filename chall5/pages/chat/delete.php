<?php

    include_once "../../db.php";

    $recv = intval($_GET['user']);
    $mid = intval($_GET['mid']);

    $na = "DELETE FROM message WHERE mid=$mid";
	$conn->exec($na);

	header('Location: ./chat.php?user='.$recv);

?>