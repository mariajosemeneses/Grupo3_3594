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
    $detallesP="SELECT * FROM order_details";

    $resultadoV= mysqli_query($db,$categoriaV);
    $detallesP= mysqli_query($db,$categoriaV);

    $consulta = "SELECT * FROM orders WHERE id = ${id}";
    $consultaP = "SELECT * FROM order_details WHERE id = ${id}";

    $resultado = mysqli_query($db, $consulta);
    $resultadoP = mysqli_query($db, $consultaP);

    $propiedad = mysqli_fetch_assoc($resultado);
    $propiedadP = mysqli_fetch_assoc($resultadoP);

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
    $cantidad = $propiedadP['qty'];
    $descripcion = $propiedadP['product_name'];
    $unidad = $propiedadP['product_price'];
    $preciototalU = $propiedadP['product_price'];
   

  if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $nombre = mysqli_real_escape_string($db, $_POST['nombre']);
    $apellido = mysqli_real_escape_string($db, $_POST['Apellido']);
    $correo = mysqli_real_escape_string($db, $_POST['Correo']);
    $direccion = mysqli_real_escape_string($db, $_POST['Direccion']);
    $barrio = mysqli_real_escape_string($db, $_POST['Barrio']);
    $lugar = mysqli_real_escape_string($db, $_POST['Lugar']);
    $telefono = mysqli_real_escape_string($db, $_POST['Telefono']);
    $preciototal = mysqli_real_escape_string($db, $_POST['precio_total']);
    $preciototalU = mysqli_real_escape_string($db, $_POST['precio_total']);
    $orden = mysqli_real_escape_string($db, $_POST['orden_estado']);
    $created = mysqli_real_escape_string($db, $_POST['created_at']);
    $updated = mysqli_real_escape_string($db, $_POST['updated_at']);
    $cantidad = mysqli_real_escape_string($db, $_POST['qty']);
    $descripcion = mysqli_real_escape_string($db, $_POST['product_name']);
    $unidad = mysqli_real_escape_string($db, $_POST['product_price']);
  }
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FACTURACIÓN</title>
    <link rel = "preland" href="styleCss.css" as = "styleCss">
    <link rel="stylesheet" href="pedido.css">
</head>

<body class="bodyF" body topmargin="0 ">
    
            <div class="ctn">
                <p>
                    <img src="../../img/logo.png" style="float:left " alt=" " class="logo" class="title"><b>FACTURA</b>
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
    
<body>
<div style="position:relative; top:3rem;">
    <form class="stylebody">
        <header>
        
            <div id="datos" style="position:relative; top:-3rem;">
                    <p style="text-align:center"><b>Las Delicias de Alisson</b></p>
                    <p style="text-align:center"><b>Leonidas Dubles Caupicho 00593 Quito, Ecuador</b></p>
                    <p style="text-align:center"><b>deliciasdeAlisoon@gmail.com</b></p>
                    <p style="text-align:center"><b>097 993 8251</b></p>
            </div>
            <hr style="position:relative; top:-2rem;" size="8px" color="black"/>
            <div id="fact" style="position:relative; top:-3rem;">
                <h2>FACTURAR</h2>
            </div>
        </header>
        <br>
        <section>
            <div>
                <table id="facliente" style="position:relative; top:-2rem;">
                    <thead>                        
                        <tr>
                            <th id="fac" >DATOS CLIENTES</th>
                        </tr>
                    </thead>
                    <tbody style="position:relative; top:1rem;">
                        <tr>
                            <th id="cliente">Nombre: <?php echo $nombre; ?><br> Apellido: <?php echo $apellido; ?><br>Teléfono: <?php echo $telefono; ?><br>Correo: <?php echo $correo; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <br>
        <section>
            <div>
                <table id="facvendedor">
                    <thead>
                        <tr id="fv">
                            <th>VENDEDOR</th>
                            <th>FECHA</th>
                            <th>FORMA DE PAGO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>vendedor</th>
                            <th><?php echo $created; ?></th>
                            <th><?php echo $preciototal; ?></th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <br>
        <section>
            <div>
                <table id="facarticulo">
                    <thead>
                        <tr id="fa">
                            <th>CANT</th>
                            <th>DESCRIPCION</th>
                            <th>PRECIO UNIT</th>
                            <th>PRECIO TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <?php  foreach ($detallesP as $propiedad){?>
                            <td><?php echo $propiedad["qty"];; ?></td>
                            <td><?php echo $propiedad['product_name']; ?></td>
                            <td><?php echo $propiedad['product_price']; ?></td>
                            <td><?php echo $propiedad['product_price']; ?></td>
                        <?php ; } ?>

                            

                        </tr>
                    </tbody>
                    <tfoot style="position:relative; top:1rem;">
                        <tr>
                            <th></th>
                            <th></th>
                            <th>IVA</th>
                            <?php $iva =  $preciototal*0.12?>
                            <th><?php echo $iva; ?></th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>TOTAL</th>
                            <th><?php echo $preciototal - $iva; ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </section>
        <br>
        <br>
        <footer>
            <div id="gracia">
                <p><b>Gracias por su compra!</b></p>
            </div>
        </footer>
        <form>
</div>
</body>
</body>
</html>
