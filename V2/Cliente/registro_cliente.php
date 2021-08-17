<?php
session_star();
if($_SESSION['rol'] !=1)
{
    header("location: ./");
}
include "../conexion.php";
if(!empty($_POST))
{
    $aler='';
    if(empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || || empty($_POST['clave']) || || empty($_POST['rol']))  
    {
        $aler='<p class="msg_error">Todos los campos son obligatorios.</p>';

    }else{
        $nombre = $_POST['nombre'];
        $email = $_POST['correo'];
        $user = $_POST['telefono'];
        $clave = $_POST['direccion'];
        

        $querry = mysqli_querry($connection,"SELECT * FROM usuario WHERE usuario = '$user' OR correo = '$email' " ); 
        mysqli_close($connection);
        $result = mysqli_fetch_array($querry);

        if ($result >   0){
            $aler='<p class="msg_error">El correo o el usuario ya existen.</p>';
        
        }else{
            $query_insert = mysqli_querry($conection,"INSERT INTO usuario(nombre,correo,usuario,telefono,direccion)
                                                        VALUES('$nombre','$email','$usuario','$telefono','direccion')");
            if(querry_insert){
                $aler='<p class"msg_save">Usuario creado correctamente.</p>';
            } else{
                $aler='<p class"msg_error">Error al crear el usuario.</p>';
            }       
    }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <?php include "include/header.php"; ?>
        <title>Registro de cliente</title>
</head>
<body>
    <?php include "include/header.php"; ?>
    <section id="container">


        <div class="form_register">
        <h1>Registro de cliente</h1>    
        <hr>
        <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div> 

        <form action="" method="post">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre completo">
            <label for="correo">Correo electronico</label>
            <input type="email" name="correo" id="correo" placeholder="Correo electronico">
            <label for="telefono">Telefono</label>
            <input type="number" name="telefono" id="telefono" placeholder="Numero de Telefono">
            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" id="direccion" placeholder="Inserte la direccion completa">
           
<input type ="submit" value="Guardar Cliente" class="btn_save">

</form>
</div>

</section>
<?php include "includes/footer.php"; ?>
</body>
</html>
