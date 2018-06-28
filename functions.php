<?php
	include_once("sqlconnect.php");
	
	function session_check() {
		if(!isset($_COOKIE['MYSID'])) {
			$token = hash('sha256', "Visitor".time());
			setcookie('MYSID', $token);
			$user = array('id' => NULL,'username' => "Visitor");
			redis_set_json($token, $user, 0);
		} else {
			$token = $_COOKIE['MYSID'];
			$authorized = false;
			if(isset($_COOKIE['username']) and isset($_COOKIE['password'])) {
				$authorized = authorize($_COOKIE['username'], $_COOKIE['password']);
				if($authorized) {
					redis_set_json($token, $user, 0);
				}
			}
			
			return @authorized;
		}
	}
	
	function logout($user) {
		$token = $_COOKIE['MYSID'];
		$user = array('id' => NULL, 'password' => NULL, 'username' => "Visitor");
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
	
	function authorize($username, $pass) {
		$found = false;
		if($username != NULL && $pass != NULL) {
			$conn = getDBConnection();
			$stmt = $conn->prepare("SELECT password, role FROM Users WHERE (login = ? AND password = ?)");
			$stmt->bind_param("ss", $login, $pass);
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
			echo mysql_num_rows($answer);
			$found = false;
			/* fetch values */
			while (mysqli_stmt_fetch($stmt)) {
				$found = true;
			}
			
			$stmt->close();
			return $found;
		}
		return $found;
	}
	 
?>