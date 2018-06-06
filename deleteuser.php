<html lang="pl">
<head>
	<meta charset="utf-8">

	<title>Pozdrowienia</title>
	<meta name="description" content="Opinie">
	<meta name="author" content="Grzegorz2047">

	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">

	<!--[if lt IE 9]>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
	<![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=3, shrink-to-fit=no">
 
</head>

<body>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

<?php
	include_once("sqlinit.php");
	include_once("sessionchecker.php");
	session_start();
	echo "<a href='index.php' class='btn btn-primary right'>Strona główna</a>";
	$session = $_SESSION['session'];
	if(isset($_SESSION['session'])) {
		//echo "Jestes zalogowany! Twoja sesja to: ".$session."<br>";
		//echo "Twoja rola to: ".getRole($session)."<br>";
	}else {
		die();
	}
	if(getRole($session) != "ADMIN") {
		echo "Dostęp zabroniony!";
		die();
	}
	//echo "Usuwam użytkownika ".$_POST['inputUsername']."<br>";
	$conn = getDBConnection();
	$stmt = $conn->prepare("DELETE u, g FROM Users u JOIN Greetings g ON u.id = g.author WHERE login = ?");
	$stmt->bind_param("s", $_POST['inputUsername']);
	$stmt->execute();
	$stmt->close();
	if(getRole($session) == "") {
		session_unset();
		session_destroy();
		
	}
	echo "<h1>Pomyślnie usunięto użytkownika oraz jego wpisy!</h1>";
?>
	</body>
</html>