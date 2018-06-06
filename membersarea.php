<?php
	include_once("sqlconnect.php");
	include_once("sessionchecker.php");
	include_once("toppanel.php");

	$session = $_SESSION['session'];
	if(isset($_SESSION['session'])) {
		//echo "Jestes zalogowany! Twoja sesja to: ".$session."<br>";
		echo "Twoja rola to: ".getRole($session)."<br>";
	}else {
		die();
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	  <title>Members area</title>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/style.css?v=1.0">
		<link rel="stylesheet" href="css/bootstrap.min.css">

		<!--[if lt IE 9]>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
		<![endif]-->
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
		<?php
			generateTop();
		?>
		<form class="form-horizontal" method="get" action="insertgreeting.php">
		  <fieldset>
			<legend>Add your own greeting on main site</legend>
			<div class="form-group">
			  <label for="textArea" class="col-lg-2 control-label">Textarea</label>
			  <div class="col-lg-10">
				<textarea class="form-control" rows="3" id="textArea" name="textArea"></textarea>
				<span class="help-block">Type your greeting</span>
			  </div>
			</div>
			<div class="form-group">
			  <div class="col-lg-10 col-lg-offset-2">
				<button type="submit" class="btn btn-primary">Submit</button>
			  </div>
			</div>
		  </fieldset>
		</form>
		<?php
			if(getRole($session) == "ADMIN") {
				echo "
						<form class='form-horizontal' method='post' action='deleteuser.php'>
						  <fieldset>
							<legend>Wpisz nazwę użytkownika, którego chcesz usunąć ze strony</legend>
							<div class='form-group'>
							  <label for='inputUsername' class='col-lg-2 control-label'>Nazwa użytkownika</label>
							  <div class='col-lg-10'>
								<input type='text' class='form-control' id='inputUsername' name='inputUsername' placeholder='Nazwa użytkownika'>
							  </div>
							</div>
							<div class='form-group'>
							  <div class='col-lg-10 col-lg-offset-2'>
								<button type='submit' class='btn btn-primary'>Usuń</button>
							  </div>
							</div>
						  </fieldset>
						</form>
				";		
			} else {
				//echo "ty juzerze";
			}
		?>
		
	</body>
</html>