<?php
	include_once("sqlconnect.php");
	require_once('functions.php');
		$user = session_check();

	if(isset($user['username'])) {
		logout($user['username']);
	}

	header("Location:index.php");
?>