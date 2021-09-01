<?php

function obtenerMenu() : array {
    
    try {
        
        //importar una conexión 

        require '../includes/config/database.php';

        //escribir el codigo 
        $sql = "SELECT * FROM propiedades";

        $consulta = mysqly_query($db, $sql);

        //arreglo par[a los resultados 
        $servicios = [];

            $i = 0;
        //Obtener resultados 

       while( $row = mysqli_fetch_assoc($consulta)){
           $servicios[$id] = $row['idpropiedades'];
           $servicios[$plato] = $row['nombre'];
           $servicios[$precio] = $row['precio'];
           $servicios[$descripcion] = $row['descripcion'];
           $servicios[$imagen] = $row['imagen'];
           $servicios[$categoriaId] = $row['categoriaId'];
           $servicios[$clienteId] = $row['clienteId'];
           $i++;

       }
       //echo"</pre>";
       //var_dump( json_encode($servicios) );
       //echo "</pre>";

       return $servicios;

    }catch (\Throwable $th) {
        //throw $th;

        var_dump($th);
    }
    
}
obtenerMenu();