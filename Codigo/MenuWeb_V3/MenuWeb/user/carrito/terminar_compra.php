
<?php
# Es responsabilidad del programador hacer algo con los productos
include_once "funciones.php";
$propiedades = obtenerProductosEnCarrito();
# Puede que solo quieras los ids, para ello invoca a obtenerIdsDeProductosEnCarrito();
var_dump($propiedades);
