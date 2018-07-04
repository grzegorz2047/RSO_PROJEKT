<?PHP
	include_once("sqlconnect.php");
	require_once('functions.php');
	$user=session_check();
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
				$conn = getGlobalDBConnection();
				$stmt = $conn->query("SELECT textarea, login FROM Greetings g JOIN Users u ON g.author = u.id"); 
				if ($stmt->num_rows > 0) {
					// output data of each row
					$rowNumber = 1;
					while($row = $stmt->fetch_assoc()) {
						if($rowNumber % 2 == 0) {
							echo "<tr>\n";
						}else {
							echo "<tr class='success'>\n";
						}
						echo "<tr>\n";
						echo "<td>".$rowNumber."</td>\n";
						echo "<td>".$row['login']."</td>\n";
						echo "<td>".$row['textarea']."</td>\n";			
						echo "</tr>\n";
					}
				} else {
				}
			?>
		  </tbody>
		</table> 
	</body>
</html>
