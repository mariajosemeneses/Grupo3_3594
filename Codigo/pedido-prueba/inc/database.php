<?php
function conectarDB() : mysqli{
    $db=mysqli_connect('localhost', 'root', 'clave', 'platos');

    if(!$db){
        echo "Error no se pudo conectar";
        exit;
    }
    return $db;
}