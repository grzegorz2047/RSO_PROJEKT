<?PHP
	include_once("sqlconnect.php");
	require_once('functions.php');
	$user = session_check();
?>
<html>
	<head>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.26.3/css/uikit.min.css" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.26.3/js/uikit.min.js"/>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>		
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<!--[if lt IE 9]>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
		<![endif]-->
		<meta name="viewport" content="width=device-width, initial-scale=3, shrink-to-fit=no">

	</head>
	<body>
	<?PHP show_menu($user); ?>
	Hello <?PHP echo $user['username']; ?>! na stronie!
	<?PHP
		if ($user !==NULL and $user['id'] !==NULL) {
			echo 
			'<div class="row">
				<div class="col-xs-9 ">
				</div>
				<div class="col-xs-3">
					<center><h1>Avatar</h1></center>
					<center><img src='."../../uploads/".$user['username']."_avatar.jpg".' style="height:150px;width:150px;" class="img-responsive"></center>
				</div>
			</div>
		<form action="upload.php" method="post" enctype="multipart/form-data">
			Wybierz zdjecie jako avatar:
			<input type="file" name="fileToUpload" id="fileToUpload">
			<input type="submit" value="Wgraj" name="submit">
		</form>
		<form class="form-horizontal" method="get" action="insertgreeting.php">
		  <fieldset>
			<legend>Dodaj wiadomosc na walla</legend>
			<div class="form-group">
			  <label for="textArea" class="col-lg-2 control-label">Textarea</label>
			  <div class="col-lg-10">
				<textarea class="form-control" rows="3" id="textArea" name="textArea" maxlength="256"></textarea>
				<span class="help-block">Wpisz cos na walla</span>
			  </div>
			</div>
			<div class="form-group">
			  <div class="col-lg-10 col-lg-offset-2">
				<button type="submit" class="btn btn-primary">Wyslij</button>
			  </div>
			</div>
		  </fieldset>
		</form>';
		}
	?>
		<h1>Pozdrowienia</h1>
		  <table class="table table-striped table-hover ">
		  <thead>
			<tr>
			  <th>nr.</th>
			  <th>Autor</th>
			  <th>Pozdrowienie</th>
			</tr>
		  </thead>
		  <tbody>
			<?php		
				include_once("sqlconnect.php");
				require_once('functions.php');
				$cache = redis_get_json('maincache');
				if($cache) {
					print_r( $cache);
					$rowNumber = 1;
						$numRows = count($cache);
						foreach ($cache as $row) {
							if($rowNumber % 2 == 0) {
								echo "<tr>\n";
							}else {
								echo "<tr class='success'>\n";
							}
							echo "<tr>\n";
							echo "<td>".$rowNumber."</td>\n";
							echo "<td>".$row['author']."</td>\n";
							echo "<td>".$row	['textarea']."</td>\n";			
							echo "</tr>\n";
							$rowNumber++;
						}
					return;
				}
				$conn = getGlobalDBConnection();
				$stmt = $conn->query("SELECT * FROM Greetings g ORDER BY id DESC LIMIT 10"); 
				echo "select";
				echo "num rows: ".$stmt->num_rows;
				$error = $conn->error;
				echo "jezeli error to: ".$error;
				if ($stmt->num_rows > 0) {
					echo ">0";
					// output data of each row
					$rowNumber = 1;
					redis_set_json('maincache', mysqli_fetch_array ($stmt), 0);
					while($row = $stmt->fetch_assoc()) {
						echo "looop".$rowNumber;
						if($rowNumber % 2 == 0) {
							echo "<tr>\n";
						}else {
							echo "<tr class='success'>\n";
						}
						echo "<tr>\n";
						echo "<td>".$rowNumber."</td>\n";
						echo "<td>".$row['author']."</td>\n";
						echo "<td>".$row['textarea']."</td>\n";			
						echo "</tr>\n";
						$rowNumber++;
					}
				} else {
				}
			?>
		  </tbody>
		</table> 
	</body>
</html>
