<?php

include('conexion.php');

$usu = $_POST["txtusu"];
$pass 	= $_POST["txtpassword"];

//Para iniciar sesión

$queryusuario = mysqli_query($conn,"SELECT * FROM login WHERE usu ='$usu' and pass = '$pass'");
$nr 		= mysqli_num_rows($queryusuario);  
	
if ($nr == 1)  
	{ 
	echo	"<script> window.location= 'bienvenida.php' </script>";
	}
else
	{
	echo "<script> alert('Datos incorrectos.');window.location= 'login.html' </script>";
	}

/*VaidrollTeam*/
?>
