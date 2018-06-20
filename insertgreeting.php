<?php
	include_once("sqlconnect.php");
	include_once("sessionchecker.php");
	$session = $_COOKIE['MYID'];
	if(isset($_COOKIE['username'] != "Visitor") && isset($_GET['textArea'])) {
		$conn = getDBConnection();
		$stmt = $conn->prepare("SELECT id FROM Users where password = ? LIMIT 1");
		$stmt->bind_param("s", $_COOKIE['password']);
		
		$answer = $stmt->execute();
		mysqli_stmt_bind_result($stmt, $name);

		/* fetch values */
		while (mysqli_stmt_fetch($stmt)) {
			printf ("%s (%s)\n\r", $name);
		}
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