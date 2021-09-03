<!DOCTYPE html>
<html lang="en">
<?php

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    //if(!$id) {
   //     header('Location: /admin');
   // }

    require 'conexion.php';
    $conn = new mysqli("localhost","root","","base");
    

    $consulta = "SELECT * FROM login WHERE id = ${id}";
    $resultado = mysqli_query($conn, $consulta);
    $usuario = mysqli_fetch_assoc($resultado);

    $errores = [];

    $correo = $usuario['correo'];
    $pass = $usuario['pass'];
    $usu = $usuario['usu'];
    

  if($_SERVER['REQUEST_METHOD'] === 'POST'){
      //echo "<pre>";
      //var_dump($_POST);
      //echo "</pre>";

     //echo "<pre>";
     //var_dump($_FILES);
      //echo "</pre>";


    $correo = mysqli_real_escape_string($conn, $_POST['correo']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);
    $usu = mysqli_real_escape_string($conn, $_POST['usu']);



      //Agregar files hacia una variavle
      //$imagen = $propiedad['imagen'];
      //var_dump($imagen['name']);

      if(!$correo){
        $errores[] = "Debe añadir un correo";
      }
      if(!$pass){
        $errores[] = "Debe añadir una contraseña";
      }
      if(!$usu){
        $errores[] = "Debe añadir una contraseña";
      }

    

     //echo "<pre>";
     //var_dump($errores);
     //echo "</pre>";

      //Revisar Errores
      if(empty($errores)) 
      {

            //insertar en la base de datos
            $query = "UPDATE login SET correo = '${correo}', pass = ${pass}, usu = '${usu}' WHERE id = ${id}";

            echo $query;
            $resultado = mysqli_query($conn, $query);

            if($resultado){
                header('perfil.php');
            }
        }
      
    } 
?>


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Datos</title>
    <link rel = "preland" href="../../css/styleCss.css" as = "styleCss">
    <link href="../../css/styleCss.css" rel = "stylesheet">
</head>
<body class="stylebody" body topmargin="0 ">
    <div class="ctn">
        <p>
            <img src="../../img/logo.png" style="float:left " alt=" " class="logo" class="title"><b>ACTUALIZAR DATOS</b>
            <a href="modificar.php" style="float:right ; margin-right: 20px ">
                <svg xmlns="http://www.w3.org/2000/svg " class="icon-tabler-logout " width="28 " height="28 " viewBox="0 0 24 24 " stroke-width="1.5 " stroke="#ffffff " fill="none " stroke-linecap="round " stroke-linejoin="round ">
                            <path stroke="none " d="M0 0h24v24H0z " fill="none "/>
                            <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2 " />
                            <path d="M7 12h14l-3 -3m0 6l3 -3 " />
                        </svg>
            </a>
        </p>
    </div>

    <main>
        <form class="formulario" style="position:relative; top:3rem;" method="POST" enctype="multipart/form-data">

            <div class="contenedor-campos">
                <div class="campo">
                    <label>Correo: </label>

                    <input class="input-text" type="text"  name= "nombre" required value="<?php echo $correo; ?>">
                </div>
                <div class="campo">
                    <label>Contraseña:</label>

                    <input class="input-text" type="text" name= "precio" required value="<?php echo $pass; ?>">
                </div>
                
                <div class="campo">
                    <label>Usuario:</label>

                    <input class="input-text" type="text" name= "precio" required value="<?php echo $usu; ?>">
                </div>
            </div>

            <div class="enviar">
                <input class="boton" type="submit" value="Actualizar">
            </div>
        </form>
    </main>
    <div class="overlay" id="overlay">
        <div class="popup" id="popup">
            <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
        </div>
    </div>
    <script src="popup.js"></script>
</body>

</html>