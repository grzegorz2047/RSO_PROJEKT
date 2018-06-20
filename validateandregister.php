<?php 
	include_once('config.php');
	include_once('sqlinit.php');
 	if(isset($_POST['inputUsername']) && isset($_POST['inputPassword'])) {
		$conn = getDBConnection();
		//$stmt->bind_param("ssss", $login, $password, $role, $session);
		$login = $_POST['inputUsername'];
		$password = hash('sha256', $_POST['inputPassword']);
		$role = "USER";
		$session = "";
		$answer = $conn->query("INSERT INTO Users (login, password, role, session) VALUES (".$login.", ".$password.", ".$role.", ".$session.")");

		$error = $conn->error;
		//echo "Wstawilem ".$login." oraz ".$password;
		if($error != "") {
			//$stmt->close();
			die($error."Podany login juz istnieje!");
		}
		echo "Zostales zarejestrowany ".$_POST['inputUsername']."\r\n";
	}
	/*
	
	echo "Post test:"."\r\n";
	foreach($_POST as $key => $value) {
		echo "Post ma: ".$key." ".$value."\r\n";
	}*/
	
 	header("Location:login.php?start=registered");
	exit;
?>