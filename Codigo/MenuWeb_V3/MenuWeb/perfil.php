<!DOCTYPE html>
<html lang="en">

<?php
    require 'conexion.php';
    $conn = new mysqli("localhost","root","","base");
    $errores = [];
    
    $query = "SELECT * FROM login";
    $resultadoConsulta = mysqli_query($conn, $query);
    
    $resultado = $_GET['resultado'] ?? null;
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if($id) {
            $query = "SELECT imagen FROM login WHERE id = ${id}";
            $resultado = mysqli_query($conn, $query);
            $usuario = mysqli_fetch_assoc($resultado);
           // unlink('/' . $propiedad['imagen']);
            $query = "DELETE FROM login WHERE id= ${id}";
            $resultado = mysqli_query($conn, $query);
            if($resultado) {
                header('Location: perfil.php');
            }
        }
    }



?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="index.php " charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador| Las Delicias de Alissson</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
    <link rel="stylesheet" href="onclick-form-popup.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/login.css">
    <link rel = "preland" href="../../css/styleCss.css" as = "styleCss">
    <link href="../../css/styleCss.css" rel = "stylesheet">
    <meta name="viewport" content="width"=device=width,user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0 ">
</head>

<body body topmargin="0 " >

    <div class="ctn-welcome ">
        
        <img src="images/logo(1)_opt.png" style="float:left " alt=" " class="logo-welcome " class="title-welcome "><b>PERFIL DEL ADMINISTRADOR</b>

        <a href="bienvenida.php " style="float:right ; margin-right: 20px ">
            <svg xmlns="http://www.w3.org/2000/svg " class="icon-tabler-logout " width="28 " height="28 " viewBox="0 0 24 24 " stroke-width="1.5 " stroke="#ffffff " fill="none " stroke-linecap="round " stroke-linejoin="round ">
                        <path stroke="none " d="M0 0h24v24H0z " fill="none "/>
                        <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2 " />
                        <path d="M7 12h14l-3 -3m0 6l3 -3 " />
            </svg>
        </a>

    </div>

    <button id="btn-abrir-popup" class="btn-abrir-popup">Agregar</button>

     <main>

    <?php if( intval( $resultado ) == 1): ?>
        <p class="alerta_exito">Creado Correctamente</p>
    <?php elseif( intval( $resultado ) == 2): ?>
        <p class="alerta_exito">Actualizado Correctamente</p>
    <?php elseif( intval( $resultado ) == 3): ?>
        <p class="alerta_exito">Eliminado Correctamente</p>
    <?php endif; ?>

     <div style="position:relative; top:2rem;">
         <table class="platos" style="margin: 0 auto;" border="0.9999">
            <thead class="tab">
                <tr>
                    <td>Id</td>
                    <td>Usuario</td>
                    <td>Correo</td>
                    <td>Contraseña</td>
                    <th>OPERACIÓN</th>
                </tr>
            </thead>
                <tbody id="tablita">
                    
                    <?php while($usuario = mysqli_fetch_assoc($resultadoConsulta)):?>
                    <tr>
                        <td><?php echo $usuario['id'];?></td>
                        <td><?php echo $usuario['usu'];?></td>
                        <td><?php echo $usuario['correo']; ?></td>
                        <td><?php echo $usuario['pass']; ?></td>
                        
                        <th>
                            <a class="actualizar" href="actualizarDato.php?id=<?php echo $usuario['id']; ?>">Actualizar</a>
                            <form method="POST">  
                                <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
                                <input type="submit" class="eliminar" value="Eliminar">
                            </form>
                        </th>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
      </div>
    </main>
</body>
</html>