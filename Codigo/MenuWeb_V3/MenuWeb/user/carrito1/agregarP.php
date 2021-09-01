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

    $consulta = "SELECT * FROM propiedades WHERE idpropiedades = ${id}";
    $resultado = mysqli_query($db, $consulta);
    $propiedad = mysqli_fetch_assoc($resultado);

    $errores = [];

    $nombre = $propiedad['nombre'];
    $precio = $propiedad['precio'];
    $categoria = $propiedad['categoriaId'];
    $descripcion = $propiedad['descripcion'];
    $imagen = $propiedad['imagen'];
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

            <div class="contenedor-campos">
                <div class="campo">
                    <label>Nombre  Plato:</label>
                    <td><?php echo $nombre; ?><td\>
                    
                </div>
                <div class="campo">
                    <label>Precio</label>
                    <th><?php echo $precio; ?><th\>
                    
                </div>
                 <div class="campo w-100">
                    <label>Categorías</label>
                    
                        <th> <?php echo $categoria; ?></th>
                    
                </div> 

                <div class="campo w-100">
                    <label>Descripción:</label>

                    <ht> <?php echo $descripcion; ?> </th>
                </div>

                <div class="img-act">
                    <label>Imagen:</label>
                    <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen" />
                    <img src="../../imagenes/<?php echo $propiedad['imagen']; ?>" class="imagen">
                </div>
            </div>

            <div class="enviar">
                <input class="boton" type="submit" value="Actualizar">
            </div>
        </form>
    </main>
    <div class="overlay" id="overlay">
        <div class="popup" id="popup">
            <a href="" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
        </div>
    </div>
    <script src="admin/propiedades/popup.js"></script>
</body>

</html>