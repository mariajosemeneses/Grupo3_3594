?>

<?php
include_once "funciones.php";  

if (!isset($_POST["idPropiedades"]) || !isset($_POST["cantidad"])) {
    exit("No hay idPropiedades");
}
agregarProductoAlCarrito($_POST["idPropiedades"], $_POST["cantidad"],);
header("Location: tienda.php");
