<!DOCTYPE html>
<html lang="en">

<?php
    require '../../includes/config/database.php';
    $db= conectarDB();
    $errores = [];
    
    $query = "SELECT * FROM propiedades";
    $resultadoConsulta = mysqli_query($db, $query);
    
    $resultado = $_GET['resultado'] ?? null;
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if($id) {
            $query = "SELECT imagen FROM propiedades WHERE idpropiedades = ${id}";
            $resultado = mysqli_query($db, $query);
            $propiedad = mysqli_fetch_assoc($resultado);
           // unlink('/' . $propiedad['imagen']);
            $query = "DELETE FROM propiedades WHERE idpropiedades= ${id}";
            $resultado = mysqli_query($db, $query);
            if($resultado) {
                header('Location: ../../admin/propiedades/modificar.php');
            }
        }
    }
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MENU DEL DÍA</title>
    <link rel = "preland" href="../../css/styleCss.css" as = "styleCss">
    <link href="../../css/styleCss.css" rel = "stylesheet">
</head>
<body class="stylebody" body topmargin="0 ">
    
            <div class="ctn">
                <p>
                    <img src="../../img/logo.png" style="float:left " alt=" " class="logo" class="title"><b>MENU DE PLATOS</b>
                    <a href="crear.php" style="float:right ; margin-right: 20px ">
                        <svg xmlns="http://www.w3.org/2000/svg " class="icon-tabler-logout " width="28 " height="28 " viewBox="0 0 24 24 " stroke-width="1.5 " stroke="#ffffff " fill="none " stroke-linecap="round " stroke-linejoin="round ">
                                    <path stroke="none " d="M0 0h24v24H0z " fill="none "/>
                                    <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2 " />
                                    <path d="M7 12h14l-3 -3m0 6l3 -3 " />
                        </svg>
                    </a>
                </p>
            </div>
 
    <main>


     <div style="position:relative; top:2rem;">
         <table class="platos" style="margin: 0 auto;" border="0.9999">
            <thead class="tab">
                <tr>
                    <td>NOMBRE DEL PLATO</td>
                    <td>PRECIO   </td>
                    <td>CATEGORIA</td>
                    <td>DESCRIPCIÓN</td>
                    <td>IMAGEN</td>
                    <th>OPERACIÓN</th>
                </tr>
             </thead>
            
                <tbody id="tablita">
                    
                    <?php while($propiedad = mysqli_fetch_assoc($resultadoConsulta)):?>
                    <tr>
                        <td><?php echo $propiedad['nombre']; ?></td>
                        <td><?php echo $propiedad['precio']; ?></td>
                        <td><?php echo $propiedad['categoriaId'];?></td>
                        <td><?php echo $propiedad['descripcion']; ?></td>
                        <th><img src="../../imagenes/<?php echo $propiedad['imagen']; ?>" class="imgtabla"></th>
                        <th>
                         <button id="btn-abrir-popup" class="btn-abrir-popup">Agregar</button>
                        </th>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
      </div>
      <div class="popup" id="popup"> 
       <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
        <form  action="" class="formulario" action="#" style="position:relative; top:3rem;" method="POST" enctype="multipart/form-data">

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
               <input type="submit" class="btn-submit" value="Agregar Carrito">
               <input type="submit" class="btn-submit" href="modificar.php" value="Cancelar">
            </div>
        </form>
     </div>
     <script src="popup.js"></script>
    </main>
   