<?php
	require_once('functions.php');
	function generateTop() {
		if(isset($_COOKIE['username']) && $_COOKIE['username'] != "Visitor") {	
			echo "<a href='membersarea.php' class='btn btn-primary right'>Strefa użytkownika</a> \n";
			echo "<a href='logout.php' class='btn btn-success right'>Wyloguj</a> \n";
		} else {
			echo "<a href='login.php' class='btn btn-primary right'>Zaloguj</a>";
			echo "<a href='register.php' class='btn btn-success right'>Zarejestruj</a>";
		}		
	}
?>