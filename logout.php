<?php
	include_once("sqlinit.php");
	require_once('functions.php');
	if(isset($_COOKIE['username'])) {
		logout($_COOKIE['username']);
	}

	header("Location:index.php");
?>