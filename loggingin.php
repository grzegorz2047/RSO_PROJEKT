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
	include_once('sqlinit.php');
	require_once('functions.php');
	echo "<a href='index.php' class='btn btn-primary right'>Strona główna</a>";
	if(isset($_POST['inputUsername']) && isset($_POST['inputPassword'])) {
		$token = $_COOKIE['MYSID'];
		$authorized = authorize($_POST['inputUsername'],$_POST['inputPassword'], token);
		if($authorized) {
			echo "Zostales zalogowany ".$_POST['inputUsername']."\r\n";
			header("Location:membersarea.php");
			exit;
		}else {
			die("Zle login lub haslo");
		}
		
		
	}

	/*
	
	echo "Post test:"."\r\n";
	foreach($_POST as $key => $value) {
		echo "Post ma: ".$key." ".$value."\r\n";
	}*/
?>
	</body>
</html>