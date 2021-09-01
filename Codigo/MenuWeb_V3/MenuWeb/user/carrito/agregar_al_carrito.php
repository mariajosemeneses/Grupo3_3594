?>

<?php
include_once "funciones.php";
if (!isset($_POST["idPropiedades"])) {
    exit("No hay idPropiedades");
}
agregarProductoAlCarrito($_POST["idPropiedades"]);
header("Location: tienda.php");
