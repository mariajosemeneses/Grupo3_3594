<?php

function obtenerMenu() : array {
    try {
        
        //importar una conexión 

            require 'database.php';

        //escribir el codigo 
        $sql = "SELECT * FROM menu;";

        $consulta = mysqly_query($db, $sql);

        //arreglo par[a los resultados 
        $servicios = [];

            $i = 0;
        //Obtener resultados 

       while( $row = mysqli_fetch_assoc($consulta)){
           $servicios[id] = $row['id'];
           $servicios[$plato] = $row['plato'];
           $servicios[$precio] = $row['precio'];
           $servicios[$descripcion] = $row['descripcion'];
           $servicios[$imagen] = $row['imagen'];
           $servicios[$administradorId] = $row['administradorId'];
           $servicios[$clienteId] = $row['clienteId'];
           $i++;

       }
       //echo"</pre>";
       //var_dump( json_encode($servicios) );
       //echo "</pre>";

       return $servicios;

    } catch (\Throwable $th) {
        //throw $th;


        var_dump($th);
    }
    
}

obtenerMenu();