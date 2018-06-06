<?php
	include_once("sqlconnect.php");
	session_start();
	function getRole($session) {
		$conn = getDBConnection();
		$stmt = $conn->prepare("SELECT role FROM Users WHERE session = ? LIMIT 1");
		$stmt->bind_param("s",$_SESSION['session']);
		$stmt->execute(); 
		$stmt->bind_result($answer);

		$stmt->fetch();
		$error = $conn->error;
		//echo "Wstawilem ".$login." oraz ".$password;
 		if($error != "") {
			$conn->close();
			die("Podany login juz istnieje!");
		}
		return $answer;
		if ($answer->num_rows == 1) {
			return $result->fetch_assoc()['role'];
		}
		return "ERROR";
	}
	
	function isAdmin($session) {
		return getRole($session) == "ADMIN";
	}
?>