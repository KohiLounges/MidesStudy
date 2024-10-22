<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Notas- ENS N°10</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

</body>
</html>



<?php
//arreglo con mensajes que puede recibir
$messages = [
    "1" => "Credenciales incorrectas",
    "2" => "No ha iniciado sesión"
];
?>
<!DOCTYPE html>
<html>
<head>
<title>Login | Registro de Notas</title>
    <meta name="description" content="Registro de Notas de la E.N.S N°10" />
 <link rel="stylesheet" href="style.css">

 <style>
.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #0B132B;
  color: #fff;
}
</style>
<style>
.logo {
  position: right;
  top: 1px;
  right: 20px;
}
</style>

</head>

<body>
<div class="header">

        <h1>Registro de Notas - E.N.S N°10</h1>
        <img src="images/logo.png" style="width: 100px; height: 100px" />

</div>

<div class="body">
    <div class="panel-login">
            <h4>Inicio de Sesion</h4>
            <form method="post" class="form" action="login_post.php">
                <label>Usuario</label><br>
                <input type="text" name="username">
                <br>
                <label>Contraseña</label><br>
                <input type="password" name="password">
                <br><br>
                <button type="submit">Entrar</button>
            </form>
        <?php
        if(isset($_GET['err']) && is_numeric($_GET['err']) && $_GET['err'] > 0 && $_GET['err'] < 3 )
            echo '<span class="error">'.$messages[$_GET['err']].'</span>';
        ?>
        </div>
</div>

<footer>
    <p>Created by Mides Study - Derechos reservados &copy; <?php echo date("Y"); ?></p>
</footer>

</body>

</html>