?>
<?php

function obtenerpropiedadesEnCarrito()
{
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $sentencia = $bd->prepare("SELECT propiedades.id, propiedades.nombre, propiedades.descripcion, propiedades.precio, propiedades.imagen, propiedades.administradorId, propiedades.clienteId
     FROM propiedades
     INNER JOIN pedidos
     ON propiedades.id = pedidos.id
     WHERE pedidos.clienteId = ?");
    $idSesion = clienteId();
    $sentencia->execute([$idSesion]);
    return $sentencia->fetchAll();
}
function quitarProductoDelCarrito($id)
{
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $idSesion = clienteId();
    $sentencia = $bd->prepare("DELETE FROM pedidos WHERE clienteId = ? AND id = ?");
    return $sentencia->execute([$idSesion, $id]);
}

function obtenerpropiedades()
{
    $bd = obtenerConexion();
    $sentencia = $bd->query("SELECT id, nombre, descripcion, precio, imagen, administradorId, clienteId FROM propiedades");
    return $sentencia->fetchAll();
}
function productoYaEstaEnCarrito($id)
{
    $ids = obtenerIdsDepropiedadesEnCarrito();
    foreach ($ids as $idd) {
        if ($idd == $id) return true;
    }
    return false;
}

function obtenerIdsDepropiedadesEnCarrito()
{
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $sentencia = $bd->prepare("SELECT id FROM pedidos WHERE clienteId = ?");
    $idSesion = session_id();
    $sentencia->execute([$idSesion]);
    return $sentencia->fetchAll(PDO::FETCH_COLUMN);
}

function agregarProductoAlCarrito($id)
{
    // Ligar el id del producto con el usuario a través de la sesión
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $idSesion = session_id();
    $sentencia = $bd->prepare("INSERT INTO pedidos(clienteId, id) VALUES (?, ?)");
    return $sentencia->execute([$idSesion, $id]);
}


function iniciarSesionSiNoEstaIniciada()
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
}

// function eliminarProducto($id)
// {
//     $bd = obtenerConexion();
//     $sentencia = $bd->prepare("DELETE FROM propiedades WHERE id = ?");
//     return $sentencia->execute([$id]);
// }

// function guardarProducto($nombre, $precio, $descripcion)
// {
//     $bd = obtenerConexion();
//     $sentencia = $bd->prepare("INSERT INTO propiedades(nombre, precio, descripcion) VALUES(?, ?, ?)");
//     return $sentencia->execute([$nombre, $precio, $descripcion]);
// }

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
