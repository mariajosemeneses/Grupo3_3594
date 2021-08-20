<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="bienvenida.php " charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login | Las Delicias de Alissson</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <SCRIPT language=JavaScript>
        function go() {

            if (document.form.password.value == 'L123456789' && document.form.login.value == 'LGUANOLUISA') {
                document.form.submit();
            } else {
                alert("Porfavor ingrese, nombre de usuario y contraseña correctos. ");
            }
        }
    </SCRIPT>

    <div class="login-box">
        <img src="img/logo.png" alt="Logo del restaurante">


        <form name=form action="bienvenida.php">
            <!--USERNAME-->
            <label for="username"> Usuario:</label>
            <input type=text name=login placeholder=" Ingrese su Usuario ">

            <!--PASSWORD-->
            <label for="password "> Contraseña:</label>
            <input type=password name=password placeholder=" Ingrese su Contraseña ">


            <input onclick=go() type=button value="Ingresar ">

            <a href="# ">¿Olvido su contraseña?</a>
        </form>
    </div>

</body>

</html>

</html>