<?php
//Para registro
include('conexion.php');

$correo = $_POST["txtcorreo"];
$pass 	= $_POST["txtpassword"];
$usu 	= $_POST["txtnombre"];

$queryusuario 	= mysqli_query($conn,"SELECT * FROM login WHERE correo = '$correo'");
$nr 			= mysqli_num_rows($queryusuario); 

if ($nr == 0)
{
	$queryregistro = "INSERT INTO login(correo, pass, usu) values ('$correo','$pass','$usu')";
	

if(mysqli_query($conn,$queryregistro))
{
	echo "<script> alert('Usuario registrado: $usu');window.location= 'perfil.php' </script>";
}
else 
{
	echo "Error: " .$queryregistro."<br>".mysq_error($conn);
}

}
else
{
		echo "<script> alert('No se puede registrar este correo: $correo');window.location= 'perfil.php' </script>";
}
/*VaidrollTeam*/
?>