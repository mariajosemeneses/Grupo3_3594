
<!DOCTYPE html>
<html lang="en">

<?php

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    //if(!$id) {
   //     header('Location: /admin');
   // }

   

   require '../../includes/config/database.php';
    $db= conectarDB();

    

    $consulta = "SELECT * FROM propiedades WHERE id = ${id}";
    $resultado = mysqli_query($db, $consulta);
    $propiedad = mysqli_fetch_assoc($resultado);

    

    $errores = [];

    $nombre = $propiedad['nombre'];
    $precio = $propiedad['precio'];
    $categoria = $propiedad['categoria'];
    $descripcion = $propiedad['descripcion'];
    $imagen = $propiedad['imagen'];

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        //echo "<pre>";
        //var_dump($_POST);
        //echo "</pre>";
  
       //echo "<pre>";
       //var_dump($_FILES);
        //echo "</pre>";
  
  
      $nombre = mysqli_real_escape_string($db, $_POST['nombre']);
      $precio = mysqli_real_escape_string($db, $_POST['precio']);
      $categoria = mysqli_real_escape_string($db, $_POST['categoria']);
      $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
      //$imagen = mysqli_real_escape_string($db, $_POST['imagen']);
  
        //Agregar files hacia una variavle
        //$imagen = $propiedad['imagen'];
        //var_dump($imagen['name']);
  
        if(!$nombre){
          $errores[] = "Debe añadir un nombre";
        }
        if(!$precio){
          $errores[] = "Debe añadir un precio";
        }
        if(!$categoria){
          $errores[] = "Elija una categoria";
        }
        if(!$descripcion){
          $errores[] = "Debe añadir una descripcion";
        }
  
      
  
       echo "<pre>";
       var_dump($errores);
       echo "</pre>";
  
        //Revisar Errores
        if(empty($errores)) 
        {
              //Subida de Archivos
               //Crear Carpeta
               //$carpetaImagenes = '../../imagenes';
               //if(!is_dir($carpetaImagenes)){
                   //mkdir($carpetaImagenes);
               //}
  
               //$nombreImagen = '';
  
             // if($imagen['name']){
                  //unlink($carpetaImagenes . $propiedad['imagen']);
                  //nombreUnico
                 // $nombreImagen = md5( uniqid( rand(), true)) . ".jpg" ;
  
                  //Subir imagen
                 // move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
              //}else{
                 // $nombreImagen = $propiedad['imagen'];
              //}
  
              
              //insertar en la base de datos
              $query = "UPDATE propiedades SET nombre = '${nombre}', precio = ${precio}, categoria = '${categoria}', descripcion = '${descripcion}' WHERE id = ${id}";
  
              echo $query;
              $resultado = mysqli_query($db, $query);
  
              if($resultado){
                  header('Location: ../../admin/propiedades/modificar.php');
              }
          }
        
      }

?>


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar</title>
    <link rel = "preland" href="../../css/styleCss.css" as = "styleCss">
    <link href="../../css/styleCss.css" rel = "stylesheet">
</head>
<body class="stylebody" body topmargin="0 ">
    <div class="ctn">
        <p>
            <img src="../../img/logo.png" style="float:left " alt=" " class="logo" class="title"><b>ACTUALIZAR</b>
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

            <div >
                <div class="campo">
                    <label>Nombre  Plato:</label>

                    <input class="input-text" type="text"  name= "nombre" required value="<?php echo $nombre; ?>">
                </div>
                <div class="campo">
                    <label>Precio</label>

                    <input  class="input-text" type="text" name= "precio" required value="<?php echo $precio; ?>">
                </div>
                <div class="campo w-100">
                    <label>Categorías</label>
                    <select name= "categoria"> 
                        <option><?php echo $categoria; ?></option>
                            <option value = "Desayuno">Desayuno</option>
                            <option value = "Almuerzo">Almuerzo</option>
                            <option value = "Plato Fuerte">Plato a la Carta</option>
                    </select>
                </div>
                <div class="campo w-100">
                    <label>Descripción:</label>

                    <textarea class="input-des"  name= "descripcion"> <?php echo $descripcion; ?> </textarea>
                </div>

                <div class="img-act">
                    <label>Imagen:</label>
                    <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen" />
                    <img src="../../imagenes/<?php echo $imagenPropiedad; ?>" class="imagen">
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