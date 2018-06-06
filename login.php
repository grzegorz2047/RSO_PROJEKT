<!doctype html>

<html lang="pl">
<head>
	<meta charset="utf-8">

	<title>Opinie o Poznaniu</title>
	<meta name="description" content="Opinie">
	<meta name="author" content="Grzegorz Boiński">

	<link rel="stylesheet" href="css/style.css?v=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">

	<!--[if lt IE 9]>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
	<![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
</head>
<body>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
		<?php 	
			session_start();
			/*echo "Post test:"."\r\n";
			foreach($_GET as $key => $value) {
				echo "Post ma: ".$key." ".$value."\r\n";
			}*/
			echo "<a href='index.php' class='btn btn-primary right'>Strona główna</a>";

			echo $_SESSION['session'];
			if(isset($_SESSION['session'])) {
				echo "<a href='logout.php' class='btn btn-primary'>Logout</a>";
				exit;
			}
			if(isset($_GET['start'])) {			
				echo "<h1>Zaloguj się używając danych podanych przy rejestracji!</h1>";
			}
		?>
		<form class="form-horizontal" method="post" action="loggingin.php">
		  <fieldset>
			<legend>Zaloguj sie, aby moc dodawac opinie!</legend>
			<div class="form-group">
			  <label for="inputUsername" class="col-lg-2 control-label">Nazwa użytkownika</label>
			  <div class="col-lg-10">
				<input type="text" class="form-control" id="inputUsername" name="inputUsername" placeholder="Nazwa użytkownika">
			  </div>
			</div>
			<div class="form-group">
			  <label for="inputPassword" class="col-lg-2 control-label">Hasło</label>
			  <div class="col-lg-10">
				<input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Hasło">
			  </div>
			</div>
			<div class="form-group">
			  <div class="col-lg-10 col-lg-offset-2">
				<button type="submit" class="btn btn-primary">Zaloguj</button>
			  </div>
			</div>
		  </fieldset>
		</form>
	</body>
</html>