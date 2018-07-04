<?php 
	include_once('config.php');
	include_once('sqlinit.php');
 	if(isset($_POST['inputUsername']) && isset($_POST['inputPassword'])) {
		$conn = getDBConnection();
		//$stmt->bind_param("ssss", $login, $password, $role, $session);
		$login = $_POST['inputUsername'];
		$name = $_POST['inputName'];
		$surname = $_POST['inputSurname'];
		$address = $_POST['inputAddress'];
		$nip = $_POST['inputNip'];
		$pesel = $_POST['inputPesel'];
		$password = hash('sha256', $_POST['inputPassword']);
		$role = "USER";
		$session = "";//Name, Surname, Address, NIP,PESEL
		$answer = $conn->query("INSERT INTO Users (login, name, surname, address, nip, pesel, password, role) VALUES ('".$login."', '".$name."', '".$address."', '".$nip."', '".$pesel."', '".$password."', '".$role."')");

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