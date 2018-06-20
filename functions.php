<?php
	include_once("sqlconnect.php");
	
	function session_check() {
		if(!isset($_COOKIE['MYSID'])) {
			$token = hash('sha256', $login.$password.time());
			setcookie('MYSID', $token);
			$user = array('id'=>NULL,'username'=>"Visitor");
			redis_set_json($token, $user, 0);
		} else {
			$token = $_COOKIE['MYSID'];
			if(isset($_POST['username']) and isset($_POST['password'])) {
				return authorize($_POST['username'], $_POST['password'], $token);
			}else {
				return authorize(NULL, NULL, $token);
			}
		}
	}
	
	function logout($user) {
		$token = $_COOKIE['MYSID'];
		$user = array('id' => NULL, 'username' => "Visitor");
		redis_set_json($token, $user, "0");
		return $user;
	}
	 
	function redis_set_json($key, $val, $expire) {
		$redisClient = new Redis();
		$redisClient->connect('127.0.0.1', 6379);
		$value=json_encode($val);
		if($expire > 0) {
			$redisClient->setex($key,$expire, $value);
		} else {
			$redisClient->set($key, $value);
		}
		$redisClient->close();
	}
	
	function redis_get_json($key) {
		$redisClient = new Redis();
		$redisClient->connect('127.0.0.1', 6379);
		$ret = json_decode($redisClient->get($key), true);
		$redisClient->close();
		return $ret;
	}
	
	function authorize($username, $pass, $token) {
		if($username != NULL and $password != NULL) {
			$conn = getDBConnection();
			$stmt = $conn->prepare("SELECT password, role FROM Users WHERE (login = ? AND password = ?)");
			$stmt->bind_param("ss", $login, $password);
			$login = $username;
			$password = hash('sha256', $pass);
			$answer = $stmt->execute();
			$error = $conn->error;
			//echo "Wstawilem ".$login." oraz ".$password;
			if($error != "") {
				$stmt->close();
				die("Wystapil blad!!");
			}

			//$result = mysql_query($sql);
			/* bind result variables */
			mysqli_stmt_bind_result($stmt, $name, $role);

			$found = false;
			/* fetch values */
			while (mysqli_stmt_fetch($stmt)) {
				$found = true;
				return true;
			}
			if (!$found) {
				$stmt->close();
				return false;
			}
		}
	}
	 
?>