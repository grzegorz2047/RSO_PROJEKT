<!doctype html>

<html lang="pl">
<head>
	<meta charset="utf-8">

	<title>Pozdrowienia</title>
	<meta name="description" content="Pozdrowienia użytkowników">
	<meta name="author" content="Grzegorz Boiński">

	<link rel="stylesheet" href="css/styles.css?v=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">

	<!--[if lt IE 9]>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
	<![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
</head>

<body>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
		<form class="form-horizontal" method="post" action="validateandregister.php">
		  <fieldset>
			<legend>Zarejestruj się, aby móc dodawać pozdrowienia!</legend>
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
			  <label for="inputConfirmPassword" class="col-lg-2 control-label">Potwierdź hasło</label>
			  <div class="col-lg-10">
				<input type="password" class="form-control" id="inputConfirmPassword" name="inputConfirmPassword" placeholder="Potwierdź hasło">
			  </div>
			</div>
			<div class="form-group">
			  <div class="col-lg-10 col-lg-offset-2">
				<button type="submit" class="btn btn-primary">Zarejestruj</button>
			  </div>
			</div>
		  </fieldset>
		</form>
	</body>
</html>