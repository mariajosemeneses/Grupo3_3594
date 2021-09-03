<?php
$dsn = 'mysql:dbname=prueba;host=localhost';
$user = 'root';
$password = '12345678';

try
{
	$db = new PDO($dsn,$user,$password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	echo "PDO error".$e->getMessage();
	die();
}

define('PRODUCT_IMG_URL','assets/product-images/');

?>