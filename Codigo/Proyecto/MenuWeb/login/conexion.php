<?php
$conn = new mysqli('localhost', 'root', '12345678', 'resraurante1');
	
	if($conn->connect_errno)
	{
		echo "No hay conexión: (" . $conn->connect_errno . ") " . $conn->connect_error;
	}
?>