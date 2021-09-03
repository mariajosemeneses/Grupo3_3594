<!DOCTYPE html>
<html lang="en">
<?php

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    //if(!$id) {
   //     header('Location: /admin');
   // }

   require 'inc/database.php';
    $db= conectarDB();
    $categoriaV="SELECT * FROM orders";
    $resultadoV= mysqli_query($db,$categoriaV);

    $consulta = "SELECT * FROM orders WHERE id = ${id}";
    $resultado = mysqli_query($db, $consulta);
    $propiedad = mysqli_fetch_assoc($resultado);

    $nombre = $propiedad['Nombre'];
    $apellido = $propiedad['Apellido'];
    $correo = $propiedad['Correo'];
    $direccion = $propiedad['Direccion'];
    $barrio = $propiedad['Barrio'];
    $lugar = $propiedad['Lugar'];
    $telefono = $propiedad['Telefono'];
    $preciototal = $propiedad['precio_total'];
    $orden = $propiedad['orden_estado'];
    $created = $propiedad['created_at'];
    $updated = $propiedad['updated_at'];
   

  if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $nombre = mysqli_real_escape_string($db, $_POST['nombre']);
    $apellido = mysqli_real_escape_string($db, $_POST['Apellido']);
    $correo = mysqli_real_escape_string($db, $_POST['Correo']);
    $direccion = mysqli_real_escape_string($db, $_POST['Direccion']);
    $barrio = mysqli_real_escape_string($db, $_POST['Barrio']);
    $lugar = mysqli_real_escape_string($db, $_POST['Lugar']);
    $telefono = mysqli_real_escape_string($db, $_POST['Telefono']);
    $preciototal = mysqli_real_escape_string($db, $_POST['precio_total']);
    $orden = mysqli_real_escape_string($db, $_POST['orden_estado']);
    $created = mysqli_real_escape_string($db, $_POST['created_at']);
    $updated = mysqli_real_escape_string($db, $_POST['updated_at']);
  }
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FACTURACIÓN</title>
    <link rel = "preland" href="styleCss.css" as = "styleCss">
    <link href="styleCss.css" rel = "stylesheet">
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
        <div class="contenedor"></div>
        
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
                    
                    <?php while($propiedad = mysqli_fetch_assoc($resultado)):?>
                    <tr>
                        <td><?php echo $propiedad['nombre']; ?></td>
                        <td><?php echo $propiedad['precio']; ?></td>
                        <td><?php echo $propiedad['categoriaId'];?></td>
                        <td><?php echo $propiedad['descripcion']; ?></td>
                        <th><img src="../../imagenes/<?php echo $propiedad['imagen']; ?>" class="imgtabla"></th>
                        <th>
                            <a class="actualizar" href="../../../MenuWeb/admin/propiedades/actualizar.php?id=<?php echo $propiedad['idpropiedades']; ?>">Actualizar</a>
                            <form method="POST">  
                                <input type="hidden" name="id" value="<?php echo $propiedad['idpropiedades']; ?>">
                                <input type="submit" class="eliminar" value="Eliminar">
                            </form>
                        </th>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
      </div>
    </main>
    <div class="overlay" id="overlay">
       
        <div class="popup" id="popup">
            <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
            <h3>Las Delicias de Alissson</h3>
            <h4>Agregar Plato la Menu</h4>
             <?php foreach ($errores as $error): ?>
            <div class="alerta-error">
            <?php echo $error; ?> 
            </div>
            <?php endforeach; ?>
            <form action="" method="POST" action="#" enctype="multipart/form-data">
                
                <div class="contenedor-inputs">
                    <input class="input-text" type="text"  name= "nombrePlato" placeholder="Nombre del Plato" required>
                    <input class="input-text" type="text" name= "precio" placeholder="Precio del Plato">
                    <div>
                       <label>Categorías</label>
                        <select name= "categoria"> 
                            <option value = "">Seleccione</option>
                            <option value = "Desayuno">Desayuno</option>
                            <option value = "Almuerzo">Almuerzo</option>
                            <option value = "Plato Fuerte">Plato Fuerte</option>
                        </select> 
                    </div>
                    <textarea class="input-text"  name= "descripcion" placeholder="Descripcion del Plato"></textarea>
                    <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen" />
                </div>
                <input type="submit" class="btn-submit" value="Agregar">
                <input type="submit" class="btn-submit" href="modificar.php" value="Cancelar">
            </form>
        </div>
    </div>
    <script src="popup.js"></script>
        
</body>
</html>
