<?php
	include_once("sqlconnect.php");
	$sql = "CREATE DATABASE IF NOT EXISTS testdb CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
	$conn = getGlobalDBConnection();
	//echo "Connected successfully";
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$conn->query($sql);
	mysqli_close($conn);
	$conn = null;
	$conn = getDBConnection();
	
	$sql = "CREATE TABLE IF NOT EXISTS Users (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
		login VARCHAR(30) NOT NULL UNIQUE,
		password VARCHAR(200) NOT NULL,
		role VARCHAR(60) NOT NULL
		)";
		
	if ($conn->query($sql) === TRUE) {
		//echo "Gut";
	} else {
		echo "Error creating table: " . $conn->error;
	}
	
	$sql = "CREATE TABLE IF NOT EXISTS Greetings(
			  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			  author INT NOT NULL REFERENCES Users(id),
			  textarea TEXT
			)";

	if ($conn->query($sql) === TRUE) {
		//echo "Gut";
	} else {
		echo "Error creating table: " . $conn->error;
	}
?>