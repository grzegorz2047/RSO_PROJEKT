<?php
	include_once("sqlconnect.php");
	include_once("sessionchecker.php");
	include_once("toppanel.php");
	$session = $_SESSION['session'];
	if(isset($_SESSION['session'])) {
		//echo "Jestes zalogowany! Twoja sesja to: ".$session."<br>";
		echo "Twoja rola to: ".getRole($session);
	}
?>
<!doctype html>
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
		require_once('functions.php');
		generateTop();
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
			include_once('config.php');
			include_once('sqlinit.php');	
			$conn = getDBConnection();
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