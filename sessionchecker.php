<?php
	include_once("sqlconnect.php");
	function getRole($login) {
		$conn = getDBConnection();
		$stmt = $conn->prepare("SELECT role FROM Users WHERE login = ? LIMIT 1");
		$stmt->bind_param("s",$login);
		$stmt->execute(); 
		$stmt->bind_result($answer);

		$stmt->fetch();
		$error = $conn->error;
		//echo "Wstawilem ".$login." oraz ".$password;
 		if($error != "") {
			$conn->close();
			die("error!");
		}
		return $answer;
		if ($answer->num_rows == 1) {
			return $result->fetch_assoc()['role'];
		}
		return "ERROR";
	}
	
	function isAdmin($login) {
		return getRole($login) == "ADMIN";
	}
?>