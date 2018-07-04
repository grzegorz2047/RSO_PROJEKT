<?PHP
	include_once("sqlconnect.php");
	require_once('functions.php');
	$user=session_check();
?>
<html>
	<head>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.26.3/css/uikit.min.css" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.26.3/js/uikit.min.js">
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
	</script>
	</head>
	<body>
	<?PHP show_menu($user); ?>
	Hello <?PHP echo $user['username']; ?>! na stronie!
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
