<!DOCTYPE html>
<html lang="en">

<?php
    require 'conexion.php';
    $conn = new mysqli('localhost', 'root', '12345678', 'resraurante1');
    $errores = [];
    
    $query = "SELECT * FROM login";
    $resultadoConsulta = mysqli_query($conn, $query);
    
    $resultado = $_GET['resultado'] ?? null;
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if($id) {
            $query = "SELECT login FROM login WHERE id = ${id}";
            $resultado = mysqli_query($conn, $query);
            $usuario = mysqli_fetch_assoc($resultado);
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
  
    <link rel="stylesheet" href="perfil.css">
    
    <meta name="viewport" content="width"=device=width,user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0 ">
</head>

<body body topmargin="0 " >

    <div class="ctn-welcome ">
        
        <img src="img/logo(1)_opt.png" style="float:left " alt=" " class="logo-welcome " class="title-welcome "><b>DATOS DEL ADMINISTRADOR</b>

        <a href="bienvenida.php " style="float:right ; margin-right: 20px ">
            <svg xmlns="http://www.w3.org/2000/svg " class="icon-tabler-logout " width="28 " height="28 " viewBox="0 0 24 24 " stroke-width="1.5 " stroke="#ffffff " fill="none " stroke-linecap="round " stroke-linejoin="round ">
                        <path stroke="none " d="M0 0h24v24H0z " fill="none "/>
                        <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2 " />
                        <path d="M7 12h14l-3 -3m0 6l3 -3 " />
            </svg>
        </a>

    </div>


  <div class="agregar">
        <p> 
        <a href="registrar.html" style="float:right ; margin-right: 20px " class="botton"> 
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-plus" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ff9300" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <circle cx="9" cy="7" r="4" />
                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                <path d="M16 11h6m-3 -3v6" />
            </svg>
        </a>
        </p>
        <p style="margin:2.8% 0; float:right" class="add"><b>Agregar nuevo administrador</b></p>
    </div>
    
   

     <main>

    <?php if( intval( $resultado ) == 1): ?>
        <p class="alerta_exito">Creado Correctamente</p>
    <?php elseif( intval( $resultado ) == 2): ?>
        <p class="alerta_exito">Actualizado Correctamente</p>
    <?php elseif( intval( $resultado ) == 3): ?>
        <p class="alerta_exito">Eliminado Correctamente</p>
    <?php endif; ?>

    <div style="position:relative; top:2rem;">
        <table class="datos" style="margin: 0 auto;" border="0.9999">
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
                            <a class="actualizar" href="actualizarDato.php?id=<?php echo $usuario['id']; ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ff9300" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                    <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                    <line x1="16" y1="5" x2="19" y2="8" />
                                </svg>
                            </a>
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