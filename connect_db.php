<?php
	// Definieer severname, usernaam, wachtwoord en databasenaam
	$servername = 'localhost';
	$username = 'root';
	$password = '';
	$databasename = 'videotheek';
	
	// Maak contact met de server waarop de database draait.
	$connection = mysqli_connect($servername, $username, $password, $databasename);
?>