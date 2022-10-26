<?php

	include_once "../../db.php";
	$id = intval($_GET['id']);
	$na = "DELETE FROM user WHERE pid=$id";
	$conn->exec($na);
		
	header("Location:./basic-table.php");

?>