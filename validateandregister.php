<?php 
	include_once('config.php');
	include_once('sqlinit.php');
 	if(isset($_POST['inputUsername']) && isset($_POST['inputPassword'])) {
		$conn = getDBConnection();
		echo $conn->error_list;
		$stmt = $conn->prepare("INSERT INTO Users (login, password, role, session) VALUES (?, ?, ?, ?)");
		$stmt->bind_param("ssss", $login, $password, $role, $session);
		$login = $_POST['inputUsername'];
		$password = hash('sha256', $_POST['inputPassword']);
		$role = "USER";
		$session = "";
		$answer = $stmt->execute();
		$error = $conn->error;
		//echo "Wstawilem ".$login." oraz ".$password;
		if($error != "") {
			$stmt->close();
			die("Podany login juz istnieje!");
		}
		$stmt->close();
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