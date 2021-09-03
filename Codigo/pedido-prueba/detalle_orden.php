<!DOCTYPE html>
<html lang="en">

<?php 
    session_start();
    require_once('./inc/config.php');    
    require_once('./inc/helpers.php');  

    $sql = "SELECT *from orders";
    $handle = $db->prepare($sql);
    $handle->execute();
    $getAllData = $handle->fetchAll(PDO::FETCH_ASSOC);

    $pageTitle = 'Cool T-Shirt Shop';
	$metaDesc = 'Demo PHP shopping cart get products from database';
    include('layouts/header.php');
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="index.php " charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle Orden| Las Delicias de Alissson</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
    <link rel="stylesheet" href="onclick-form-popup.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
    <link rel="stylesheet" href="detalle.css">
    
    <meta name="viewport" content="width"=device=width,user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0 ">
</head>

<body body topmargin="0 " >


     <main>


    <div style="position:relative; top:2rem;">
        <table class="datos" style="margin: 0 auto;" border="0.9999">
            <thead class="tab">
                <tr>
                    <td>Id</td>
                    <td>Cliente</td>
                    <td>Sector</td>
                    <td>Total</td>
                    <td>Fecha</td>
                    <td>ESTADO</td>
                </tr>
            </thead>
                <tbody id="tablita">
                    <?php
                     foreach($getAllData as $cliente)
                    {
                    ?>
                    <tr>
                        <td><?php echo $cliente['id'];?></td>
                        <td><?php echo $cliente['Nombre'];?></td>
                        <td><?php echo $cliente['Sector']; ?></td>
                        <td><?php echo $cliente['precio_total']; ?></td>
                        <td><?php echo $cliente['created_at']; ?></td>
                        <td><?php echo $cliente['orden_estado']; ?></td>
                        
                    </tr>
                    <?php 
                    }
                    ?>
                </tbody>
        </table>
    </div>
    </main>
</body>
</html>