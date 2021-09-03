<?php

function obtenerProductosEnCarrito()
{
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $sentencia = $bd->prepare("SELECT propiedades.idpropiedades, propiedades.nombre, propiedades.descripcion, propiedades.precio
     FROM propiedades
     INNER JOIN carritoc
     ON propiedades.idpropiedades = carritoc.idPropiedades
     WHERE carritoc.idsesion = ?" );
    $idSesion = session_id();
    $sentencia->execute([$idSesion]);
    return $sentencia->fetchAll();
}
function obtenerDatosCarrito()
{
    $bd = obtenerConexion();
    $sentencia = $bd->query("SELECT idsesion, idPropiedades, cantidad, total FROM carritoc");
    return $sentencia->fetchAll();
}
function quitarProductoDelCarrito($idProducto)
{
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $idSesion = session_id();
    $sentencia = $bd->prepare("DELETE FROM carritoc WHERE idsesion = ? AND idPropiedades = ?");
    return $sentencia->execute([$idSesion, $idProducto]);
}

function obtenerProductos()
{
    $bd = obtenerConexion();
    $sentencia = $bd->query("SELECT idpropiedades, nombre, descripcion, precio FROM propiedades");
    return $sentencia->fetchAll();
}
function productoYaEstaEnCarrito($idProducto)
{
    $ids = obtenerIdsDeProductosEnCarrito();
    foreach ($ids as $idpropiedades) {
        if ($idpropiedades == $idProducto) return true;
    }
    return false;
}

function obtenerIdsDeProductosEnCarrito()
{
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $sentencia = $bd->prepare("SELECT idPropiedades FROM carritoc WHERE idsesion = ?");
    $idSesion = session_id();
    $sentencia->execute([$idSesion]);
    return $sentencia->fetchAll(PDO::FETCH_COLUMN);
}

function agregarProductoAlCarrito($idProducto,$cantidad)
{
    // Ligar el id del producto con el usuario a través de la sesión
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $idSesion = session_id();   
    $sentencia = $bd->prepare("INSERT INTO carritoc(idsesion, idPropiedades, cantidad) VALUES (?, ?, ?)");
    return $sentencia->execute([$idSesion, $idProducto, $cantidad]);
}


function iniciarSesionSiNoEstaIniciada()
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
}

/* function eliminarProducto($idpropiedades)
{
    $bd = obtenerConexion();
    $sentencia = $bd->prepare("DELETE FROM propiedades WHERE idpropiedades = ?");
    return $sentencia->execute([$idpropiedades]);
}

function guardarProducto($nombre, $precio, $descripcion)
{
    $bd = obtenerConexion();
    $sentencia = $bd->prepare("INSERT INTO propiedades(nombre, precio, descripcion) VALUES(?, ?, ?)");
    return $sentencia->execute([$nombre, $precio, $descripcion]);
} */

function obtenerVariableDelEntorno($key)
{
    if (defined("_ENV_CACHE")) {
        $vars = _ENV_CACHE;
    } else {
        $file = "env.php";
        if (!file_exists($file)) {
            throw new Exception("El archivo de las variables de entorno ($file) no existe. Favor de crearlo");
        }
        $vars = parse_ini_file($file);
        define("_ENV_CACHE", $vars);
    }
    if (isset($vars[$key])) {
        return $vars[$key];
    } else {
        throw new Exception("La clave especificada (" . $key . ") no existe en el archivo de las variables de entorno");
    }
}
function obtenerConexion()
{
    $password = obtenerVariableDelEntorno("MYSQL_PASSWORD");
    $user = obtenerVariableDelEntorno("MYSQL_USER");
    $dbName = obtenerVariableDelEntorno("MYSQL_DATABASE_NAME");
    $database = new PDO('mysql:host=localhost;dbname=' . $dbName, $user, $password);
    $database->query("set names utf8;");
    $database->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    return $database;
}

function cartesianProduct($sets)
{
    $cartesian = array();
    foreach ($sets as $key => $set) {

        // Si un grupo esta vació no afecta el producto cartesiano
        if (empty($set)) {
            continue;
        }

        // Si esta vacio agregamos el primer grupo
        if (empty($cartesian)) {
            $cartesian[] = array();
        }

        $subset = array();
        foreach ($cartesian as $product) {
            foreach($set as $value) {
                $product[$key] = $value;
                $subset[] = $product;
            }
        }
        $cartesian = $subset;
    }
    return $cartesian;
}