<?PHP
include_once('sqlinit.php');
include_once("sqlconnect.php");
	
function session_check() {
	if(!isset($_COOKIE['MYSID'])) {
		$token=md5(rand(0,1000000000));
		setcookie('MYSID', $token);
		$user=array('id'=>NULL,'username'=>"Visitor");
		redis_set_json($token, $user,0);
	}
	else
		$token=$_COOKIE['MYSID'];
	if (isset($_POST['username']) and isset($_POST['password']))
		return authorize($_POST['username'], $_POST['password'], $token);
	else
		return authorize(NULL,NULL,$token);
}
function authorize($username,$password, $token) {
	if ($username !=NULL and $password !=NULL) {
		if (isLegit($username, $password)) {
			echo "Legitne";
			$user=array('id'=>333,'username'=>$username);
		} else {
			$user=array('id'=>NULL,'username'=>"Visitor");
		}
		redis_set_json($token,$user,"0");
		return $user;
	}
	else
		return redis_get_json($token);
}
function logout($user) {
	$token=$_COOKIE['MYSID'];
	$user=array('id'=>NULL,'username'=>"Visitor");
	redis_set_json($token,$user,"0");
	return $user;
}
function redis_set_json($key, $val, $expire) {
	$redisClient = new Redis();
	$redisClient->connect( '127.0.0.1', 6379 );
	$value=json_encode($val);
	if ($expire > 0)
		$redisClient->setex($key, $expire, $value );
	else
		$redisClient->set($key, $value);
	$redisClient->close();
}
function redis_get_json($key) {
	$redisClient = new Redis();
	$redisClient->connect( '127.0.0.1', 6379 );
	$ret=json_decode($redisClient->get($key),true);
	$redisClient->close();
	return $ret;
}

function isLegit($username, $pass) {
	$found = false;
	if($username != NULL && $pass != NULL) {
		$conn = getDBConnection();
		$stmt = $conn->prepare("SELECT password, role FROM Users WHERE (login = ? AND password = ?)");
		$stmt->bind_param("ss", $login, $password);
		$login = $username;
		$password = hash('sha256', $pass);
		
		$answer = $stmt->execute();
		$error = $conn->error;
		echo "spr ".$login." oraz ".$password;
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
			echo $name."  ".$role;
		}
		
		$stmt->close();
	}
	return $found;
}
function show_menu($user)
{
echo '
<nav class="uk-navbar">
    <ul class="uk-navbar-nav">';
				if ($user !==NULL and $user['id'] !==NULL) {
					//echo '<li class="uk-active"><a href="insertgreeting.php">Dodaj wpis</a></li>';
					echo '<li class="uk-active"><a href="logout.php">Wyloguj</a></li>';
				}
				else {
					echo '<li class="uk-active"><a href="login.php">Login</a></li>';
                }
echo '        <li class="uk-parent"><a href="index.php">Home</a></li>
    </ul>
</nav>';
}
?>
