<!DOCTYPE html>
<html lang="en">

<?php
  require '../../includes/config/database.php';
  $db= conectarDB();
  $errores = [];

  if($_SERVER['REQUEST_METHOD'] === 'POST')
  {
      //echo "<pre>";
      //var_dump($_POST);
      //echo "</pre>";

     //echo "<pre>";
     //var_dump($_FILES);
      //echo "</pre>";
      $nombrePlato = $_POST['nombrePlato'];
      $precio = $_POST['precio'];
      $categoria = $_POST['categoria'];
      $descripcion = $_POST['descripcion'];

      //Agregar files hacia una variavle
      $imagen = $_FILES['imagen'];
      //var_dump($imagen['name']);

      if(!$nombrePlato){
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

      if(!$imagen['name']){
        $errores[] = "La imagen es obligatoria";
      }

     //echo "<pre>";
     //var_dump($errores);
     //echo "</pre>";

      //Revisar Errores
      if(empty($errores)) {

            //Subida de Archivos
             //Crear Carpeta
             $carpetaImagenes = '../../imagenes';
             if(!is_dir($carpetaImagenes)){
                 mkdir($carpetaImagenes);
             }
            //nombreUnico
             $nombreImagen = md5( uniqid( rand(), true)) . ".jpg" ;

             //Subir imagen
             move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);

            //insertar en la base de datos
            $query = "INSERT INTO propiedades (plato, precio, categoria, descripcion, imagen)
            VALUES ( '$nombrePlato', '$precio', '$categoria', '$descripcion', '$nombreImagen' )";

            // echo $query;
            $resultado = mysqli_query($db, $query);

            if($resultado){
             //echo "Insertado Correctamente";
            }
        }
      
    }
?>


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso Platos</title>
    <link rel="stylesheet" href="../../css/normalize.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link rel="preload" href="../../css/styles.css" as="style">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <link href="../../css/styles.css" rel="stylesheet">
</head>

<body>
    <div class=" nav-bg">
        <nav class="nav-principal contenedor">
            <a href="bienvenida.html">Inicio</a>
            <a href="#">Modificar Plato</a>
            <a href="#">Eliminar Plato</a>
            <a href="#">Buscar</a>
        </nav>
    </div>

    <div id="contacto" class="contacto">


        <section class="hero">
            <div class="contenido-hero">
                <h1>Ingresar Platos</h1>
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-tools-kitchen-2" width="56" height="56" viewBox="0 0 24 24" stroke-width="2" stroke="#ff9300" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M19 3v12h-5c-.023 -3.681 .184 -7.406 5 -12zm0 12v6h-1v-3m-10 -14v17m-3 -17v3a3 3 0 1 0 6 0v-3" />
                      </svg>
            </div>
        </section>

        <section>

            <?php foreach ($errores as $error): ?>
            <div class="alerta-error">
             <?php echo $error; ?> 
            </div>
            <?php endforeach; ?>
            <form class="formulario" method="POST" action="#" enctype="multipart/form-data">
                <legend>Ingresa los platos llenando todos los campos</legend>

                <div class="contenedor-campos">
                    <div class="campo">
                        <label>Nombre  Plato:</label>

                        <input class="input-text" type="text"  name= "nombrePlato" placeholder="Nombre del Plato" required>
                    </div>
                    <div class="campo">
                        <label>Precio</label>

                        <input class="input-text" type="text" name= "precio" placeholder="Precio del plato">
                    </div>
                    <div class="campo w-100">
                        <label>Categorías</label>
                        <select name= "categoria"> 
                            <option value = "">Seleccione</option>
                            <option value = "Desayuno">Desayuno</option>
                            <option value = "Almuerzo">Almuerzo</option>
                            <option value = "Plato Fuerte">Plato Fuerte</option>
                        </select>
                    </div>
                    <div class="campo w-100">
                        <label>Descripción:</label>

                        <textarea class="input-text"  name= "descripcion"></textarea>
                    </div>

                    <div class="campo w-100">
                        <label>Subir imagen del plato:</label>
                        <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen" />
                    </div>
                </div>
                <!--.contenedor-campos-->
                <div class="enviar">
                    <input class="boton" type="submit" value="Agregar">
                    
                </div>
            </form>
        </section>
    </div>
    </div>
    <div class="overlay" id="overlay">
        <div class="popup" id="popup">
            <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
            <h3>Se agregado corectamente!!</h3>
        </div>
    </div>
    <script src="popup.js"></script>
</body>

</html>