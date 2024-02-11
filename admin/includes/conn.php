<?php
	$conn = new mysqli('localhost', 'phpmyadmin', 'test123', 'votesystem');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>