<!DOCTYPE html>
<html lang="en">



<?php 
    session_start();

     if(!isset($_SESSION['confirm_order']) || empty($_SESSION['confirm_order']))
     {
         header('location:index.php');
         exit();
     }

    require_once('./inc/config.php');    
    require_once('./inc/helpers.php');  

    
	$pageTitle = 'Las Delicias de Alisson';
	$metaDesc = 'Las Delicias de Alisson';
	
    include('layouts/header.php');
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/normalize.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="pedido.css">
</head>

<body>
<div class="row">
    <div class="listo">
        <h1>¡GRACIAS POR PREFERIRNOS!</h1>
        <p>
            Su orden se envio con exito.
            <?php unset($_SESSION['confirm_order']);?>
        </p>
        <p>
            Tiempo aproximado de llegada:
        </p>
        <p>
            Sur: 30 min;
        </p>
        <p>
            Centro: 45 min;
        </p>
        <p>
            Norte: 60 min;
        </p>
        <p>
            Valle: 60 min
        </p>
    </div>
</div>
<?php include('layouts/footer.php'); ?>    

</body>

</html>