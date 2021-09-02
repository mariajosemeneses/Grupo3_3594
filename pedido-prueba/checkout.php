<!DOCTYPE html>
<html lang="en">
<?php 
    session_start();

    if(!isset($_SESSION['cart_items']) || empty($_SESSION['cart_items']))
    {
        header('location:index.php');
        exit();
    }

    require_once('./inc/config.php');    
    require_once('./inc/helpers.php');  
    $cartItemCount = count($_SESSION['cart_items']);

    //pre($_SESSION);

    if(isset($_POST['submit']))
    {
        if(isset($_POST['Nombre'],$_POST['Apellido'],$_POST['Correo'],$_POST['Direccion'],$_POST['Sector'],$_POST['Lugar'],$_POST['Telefono']) && !empty($_POST['Nombre']) && !empty($_POST['Apellido']) && !empty($_POST['Correo']) && !empty($_POST['Direccion']) && !empty($_POST['Sector']) && !empty($_POST['Lugar']) && !empty($_POST['Telefono']))
        {
           $Nombre = $_POST['Nombre'];

           if(filter_var($_POST['Correo'],FILTER_VALIDATE_EMAIL) == false)
           {
                 $errorMsg[] = 'Porfavor ingrese un correo valído';
           }
           else
           {
               //validate_input is a custom function
               //you can find it in helpers.php file
                $Nombre  = validate_input($_POST['Nombre']);
                $Apellido   = validate_input($_POST['Apellido']);
                $Correo      = validate_input($_POST['Correo']);
                $Direccion    = validate_input($_POST['Direccion']);
                $Barrio   = (!empty($_POST['Direccion'])?validate_input($_POST['Direccion']):'');
                $Sector    = validate_input($_POST['Sector']);
                $Lugar      = validate_input($_POST['Lugar']); 
                $Telefono    = validate_input($_POST['Telefono']);

                $sql = 'insert into orders (Nombre, Apellido, Correo, Direccion, Barrio, Sector, Lugar, Telefono, orden_estado,created_at, updated_at) values (:nombre, :apellido, :Correo, :Direccion, :Barrio, :Sector, :Lugar, :Telefono, :orden_estado,:created_at, :updated_at)';
                $Lugarment = $db->prepare($sql);
                $params = [
                    'nombre' => $Nombre,
                    'apellido' => $Apellido,
                    'Correo' => $Correo,
                    'Direccion' => $Direccion,
                    'Barrio' => $Barrio,
                    'Sector' => $Sector,
                    'Lugar' => $Lugar,
                    'Telefono' => $Telefono,
                    'orden_estado' => 'confirmed',
                    'created_at'=> date('Y-m-d H:i:s'),
                    'updated_at'=> date('Y-m-d H:i:s')
                ];

                $Lugarment->execute($params);
                if($Lugarment->rowCount() == 1)
                {
                    
                    $getOrderID = $db->lastInsertId();

                    if(isset($_SESSION['cart_items']) || !empty($_SESSION['cart_items']))
                    {
                        $sqlDetails = 'insert into order_details (order_id, product_id, product_name, product_price, qty, precio_total) values(:order_id,:product_id,:product_name,:product_price,:qty,:precio_total)';
                        $orderDetailStmt = $db->prepare($sqlDetails);

                        $totalPrice = 0;
                        foreach($_SESSION['cart_items'] as $item)
                        {
                            $totalPrice+=$item['precio_total'];

                            $paramOrderDetails = [
                                'order_id' =>  $getOrderID,
                                'product_id' =>  $item['product_id'],
                                'product_name' =>  $item['product_name'],
                                'product_price' =>  $item['product_price'],
                                'qty' =>  $item['qty'],
                                'precio_total' =>  $item['precio_total']
                            ];

                            $orderDetailStmt->execute($paramOrderDetails);
                        }
                        
                        $updateSql = 'update orders set precio_total = :total where id = :id';

                        $rs = $db->prepare($updateSql);
                        $prepareUpdate = [
                            'total' => $totalPrice,
                            'id' =>$getOrderID
                        ];

                        $rs->execute($prepareUpdate);
                        
                        unset($_SESSION['cart_items']);
                        $_SESSION['confirm_order'] = true;
                        header('location:thank-you.php');
                        exit();
                    }
                }
                else
                {
                    $errorMsg[] = 'Unable to save your order. Please try again';
                }
           }
        }
        else
        {
            $errorMsg = [];

            if(!isset($_POST['Nombre']) || empty($_POST['Nombre']))
            {
                $errorMsg[] = 'Nombre es necesario';
            }
            else
            {
                $nombreValue = $_POST['Nombre'];
            }

            if(!isset($_POST['Apellido']) || empty($_POST['Apellido']))
            {
                $errorMsg[] = 'Apellido es necesario';
            }
            else
            {
                $apellidoValue = $_POST['Apellido'];
            }

            if(!isset($_POST['Correo']) || empty($_POST['Correo']))
            {
                $errorMsg[] = 'Correo es necesario';
            }
            else
            {
                $CorreoValue = $_POST['Correo'];
            }

            if(!isset($_POST['Direccion']) || empty($_POST['Direccion']))
            {
                $errorMsg[] = 'Direccion es necesaria';
            }
            else
            {
                $DireccionValue = $_POST['Direccion'];
            }

            if(!isset($_POST['Sector']) || empty($_POST['Sector']))
            {
                $errorMsg[] = 'Sector es necesaria';
            }
            else
            {
                $SectorValue = $_POST['Sector'];
            }

            if(!isset($_POST['Lugar']) || empty($_POST['Lugar']))
            {
                $errorMsg[] = 'Lugar es necesario';
            }
            else
            {
                $LugarValue = $_POST['Lugar'];
            }

            if(!isset($_POST['Telefono']) || empty($_POST['Telefono']))
            {
                $errorMsg[] = 'Telefono es necesario';
            }
            else
            {
                $TelefonoValue = $_POST['Telefono'];
            }


            if(isset($_POST['Barrio']) || !empty($_POST['Barrio']))
            {
                $BarrioValue = $_POST['Barrio'];
            }

        }
    }
	
	$pageTitle = 'Pedir Ahora';
	$metaDesc = 'Pedir Ahora';
	
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
<div class="row mt-3">
        <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted"><h4 class="mb">Resumen de la Orden </h4></span>
            <span class="badge badge-secondary badge-pill"><?php echo $cartItemCount;?></span>
          </h4>
          <ul class="list-group mb-3">
            <?php
                $total = 0;
                foreach($_SESSION['cart_items'] as $cartItem)
                {
                    $total+=$cartItem['precio_total'];
                ?>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0"><?php echo $cartItem['product_name'] ?></h6>
                            <small class="text-muted">Cantidad: <?php echo $cartItem['qty'] ?> X Precio: <?php echo $cartItem['product_price'] ?></small>
                        </div>
                        <span class="text-muted">$<?php echo $cartItem['precio_total'] ?></span>
                    </li>
            <?php
                }
            ?>
           
            <li class="list-group-item d-flex justify-content-between">
              <span>Total (USD)</span>
              <strong>$<?php echo number_format($total,2);?></strong>
            </li>
          </ul>
        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb">Completar Pedido</h4>
          <?php 
            if(isset($errorMsg) && count($errorMsg) > 0)
            {
                foreach($errorMsg as $error)
                {
                    echo '<div class="alert alert-danger">'.$error.'</div>';
                }
            }
          ?>
          <form class="needs-validation" method="POST">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="Nombre">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="rgb(228, 135, 29)" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <circle cx="12" cy="7" r="4" />
                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                  </svg> Nombre</label>
                <input type="text" class="form-control" id="Nombre" name="Nombre" placeholder="Nombre" value="<?php echo (isset($nombreValue) && !empty($nombreValue)) ? $nombreValue:'' ?>" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="Apellido">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="rgb(228, 135, 29)" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <circle cx="12" cy="7" r="4" />
                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                  </svg> Apellido</label>
                <input type="text" class="form-control" id="Apellido" name="Apellido" placeholder="Apellido" value="<?php echo (isset($apellidoValue) && !empty($apellidoValue)) ? $apellidoValue:'' ?>" required>
              </div>
            </div>

            <div class="mb-3">
              <label for="Correo">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="rgb(228, 135, 29)" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                  <rect x="3" y="5" width="18" height="14" rx="2" />
                  <polyline points="3 7 12 13 21 7" />
                </svg> Correo</label>
              <input type="email" class="form-control" id="Correo" name="Correo" placeholder="cliente@gmail.com" value="<?php echo (isset($CorreoValue) && !empty($CorreoValue)) ? $CorreoValue:'' ?>" required>
            </div>

            <div class="mb-3">
              <label for="Direccion">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-2" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="rgb(228, 135, 29)" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <line x1="18" y1="6" x2="18" y2="6.01" />
                        <path d="M18 13l-3.5 -5a4 4 0 1 1 7 0l-3.5 5" />
                        <polyline points="10.5 4.75 9 4 3 7 3 20 9 17 15 20 21 17 21 15" />
                        <line x1="9" y1="4" x2="9" y2="17" />
                        <line x1="15" y1="15" x2="15" y2="20" />
                      </svg> Dirección</label>
              <input type="text" class="form-control" id="Direccion" name="Direccion" placeholder=" Calle Principal, # ,Calle Secundaria" value="<?php echo (isset($DireccionValue) && !empty($DireccionValue)) ? $DireccionValue:'' ?>" required>
            </div>

            <div class="mb-3">
              <label for="Barrio">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-pin" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="rgb(228, 135, 29)" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                  <circle cx="12" cy="11" r="3" />
                  <path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z" />
                </svg> Barrio <span class="text-muted" colo="white">(referencia)</span></label>
              <input type="text" class="form-control" id="Barrio" name="Barrio" placeholder="Barrio o lugar de referencia" value="<?php echo (isset($BarrioValue) && !empty($BarrioValue)) ? $BarrioValue:'' ?>" required>
            </div>

            <div class="row">
              <div class="col-md-5 mb-3">
                <label for="Sector"> 
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-current-location" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="rgb(228, 135, 29)" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <circle cx="12" cy="12" r="3" />
                    <circle cx="12" cy="12" r="8" />
                    <line x1="12" y1="2" x2="12" y2="4" />
                    <line x1="12" y1="20" x2="12" y2="22" />
                    <line x1="20" y1="12" x2="22" y2="12" />
                    <line x1="2" y1="12" x2="4" y2="12" />
                  </svg>Sector</label>
                <select class="custom-select d-block w-100" name="Sector" id="Sector" required >
                  <option value="">Seleccionar...</option>
                  <option value="Norte" >Norte</option>
                  <option value="Centro">Centro</option>
                  <option value="Sur">Sur</option>
                  <option value="Valle">Valle</option>
                </select>
              </div>
              <div class="col-md-4 mb-3">
                <label for="Lugar"> 
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-warehouse" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="rgb(228, 135, 29)" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M3 21v-13l9 -4l9 4v13" />
                    <path d="M13 13h4v8h-10v-6h6" />
                    <path d="M13 21v-9a1 1 0 0 0 -1 -1h-2a1 1 0 0 0 -1 1v3" />
                  </svg>Lugar</label>
                <select class="custom-select d-block w-100" name="Lugar" id="Lugar" >
                  <option value="">Seleccionar...</option>
                  <option value="Casa">Casa</option>
                  <option value="Trabajo">Trabajo</option>
                  <option value="Otro">Otro</option>
                </select>
              </div>
              <div class="col-md-3 mb-3">
                <label for="Telefono">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="rgb(228, 135, 29)" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                  </svg>Teléfono</label>
                <input type="text" class="form-control" id="Telefono" name="Telefono" placeholder="ej. 091234567 o 2076345" value="<?php echo (isset($TelefonoValue) && !empty($TelefonoValue)) ? $TelefonoValue:'' ?>"  required>
              </div>
            </div>
            <hr class="mb-4">

            <h4 class="mb-3">Pago</h4>

            <div class="d-block my-3">
              <div class="custom-control custom-radio">
                <input id="efectivo" name="efectivo" type="radio" class="custom-control-input" checked="" >
                <label class="custom-control-label" for="efectivo">Solo en efectivo</label>
              </div>
            </div>
           
            <hr class="mb-4">
            <button class="btn" type="submit" name="submit" value="submit">Enviar Pedido</button>
          </form>
        </div>
      </div>
<?php include('layouts/footer.php'); ?>

</body>

</html>