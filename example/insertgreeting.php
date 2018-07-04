<?php
	include_once("sqlconnect.php");
	require_once('functions.php');
	$user=session_check();
	if ($user !== NULL and $user['id'] !== NULL and isset($_GET['textArea'])) {
		$conn = getDBConnection();
		$name = $user['username'];
		$stmt = $conn->prepare("INSERT INTO Greetings (author, textarea) VALUES (? , ?)");
		$stmt->bind_param("is", $name, $textarea);
		$textarea = $_GET['textArea'];
		$answer = $stmt->execute();
		$error = $conn->error;
		//echo "Wstawilem ".$login." oraz ".$password;
 		if($error != "") {
			$stmt->close();
			die("BLAD!");
		}
		header("Location:index.php");
		exit;
	} else {
		echo "Cos poszlo nie tak!";
		echo "Wpisales: ".$_GET['textArea'];
		echo "Twoja sesja to ".$_COOKIE['MYID'];
	}
	/*
	
	echo "Post test:"."\r\n";
	foreach($_POST as $key => $value) {
		echo "Post ma: ".$key." ".$value."\r\n";
	}*/
?>