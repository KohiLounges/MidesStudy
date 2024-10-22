<!DOCTYPE html>
<?php
require 'functions.php';
$permisos = ['Administrador','Profesor','Padre'];
permisos($permisos);
?>
<html>
<head>
<title>Inicio | Registro de Notas</title>
    <meta name="description" content="Registro de Notas de la E.N.S N°10" />
    <link rel="stylesheet" href="css/style.css">
</head>

<style>
.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #0B132B;
  color: #fff;
}
</style>

<body>
<div class="header">
  <h1>Registro de Notas - E.N.S N°10</h1>
  <h3>Usuario:  <?php echo $_SESSION["username"] ?> </h3>
  <img src="images/logo.png" style="width: 100px; height: 100px" />
</div>

<nav>
    <ul>
      <p>
        <li class="active"><a href="inicio.view.php">Inicio</a> </li>
        <li><a href="alumnos.view.php">Registro de Alumnos</a> </li>
        <li><a href="listadoalumnos.view.php">Listado de Alumnos</a> </li>
        <li><a href="notas.view.php">Registro de Notas</a> </li>
        <li><a href="listadonotas.view.php">Consulta de Notas</a> </li>
        <li><a href="busquedadni.php">Busqueda por D.N.I</a> </li>
        <li class="right"><a href="logout.php">Salir</a></li>
      </p>
    </ul>
</nav>

<div class="body">
    <div class="panel">
           <h1 class="text-center">E.N.S N°10</h1>
        <?php
        if(isset($_GET['err'])){
            echo '<h3 class="error text-center">ERROR: Usuario no autorizado</h3>';
        }
        ?>
        <br>
        <hr>
        <p class="text-center"><strong>Alumnos:</strong><br><br>Gareca, Maximiliano Nahuel <br>Santino Gregoret <br>Krasuchi Leonardo</p>
        <br> 
        <br>
        
    </div>
</div>

<footer>
  <p>Created by Mides Study - Derechos reservados &copy; <?php echo date("Y"); ?></p>
</footer>

</body>
</html>
