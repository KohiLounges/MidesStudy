<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resoluciones</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <div class="Resolucion">
        <div class="Computadora">
</div>
</body>
</html>




<?php
require 'functions.php';

$permisos = ['Administrador','Profesor'];
permisos($permisos);
//consulta los alumnos para el listaddo de alumnos
$alumnos = $conn->prepare("select a.id, a.num_lista, a.nombres, a.apellidos, a.genero, b.nombre as grado, c.nombre as seccion from alumnos as a inner join grados as b on a.id_grado = b.id inner join secciones as c on a.id_seccion = c.id order by a.apellidos");
$alumnos->execute();
$alumnos = $alumnos->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
<title>Listado de Alumnos | Registro de Notas</title>
    <meta name="description" content="Registro de Notas de la E.N.S N°10" />
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="header">
        <h1>Registro de Notas - E.N.S N°10</h1>
        <h3>Usuario:  <?php echo $_SESSION["username"] ?></h3>
        <img src="images/logo.png" style="width: 100px; height: 100px" />
</div>

<style>
.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #0B132B;
  color: #fff;
}
</style>

<nav>
    <ul>
        <li><a href="inicio.view.php">Inicio</a> </li>
        <li><a href="alumnos.view.php">Registro de Alumnos</a> </li>
        <li class="active"><a href="listadoalumnos.view.php">Listado de Alumnos</a> </li>
        <li><a href="notas.view.php">Registro de Notas</a> </li>
        <li><a href="listadonotas.view.php">Consulta de Notas</a> </li>
        <li><a href="busquedadni.php">Busqueda por D.N.I</a> </li>
        <li class="right"><a href="logout.php">Salir</a> </li>

    </ul>
</nav>

<div class="body">
    <div class="panel">

    <?php if(isset($_SESSION['message'])) {?>
        <div class="alert alert-<?= $_SESSION ['message_type']; ?> alert-dismissible fade show" role="alert">
                                    <?= $_SESSION ['message'] ?>
                                   
                                    </div>
                                  
                                <?php session_unset();  } ?>

            <h4>Listado de Alumnos</h4>
            <table class="table" cellspacing="0" cellpadding="0">
                <tr>
                    <th>N° de<br>lista</th><th>Apellidos</th><th>Nombres</th><th>Género</th><th>Curso</th><th>Sección</th>
                    <th>Editar</th><th>Eliminar</th>
                </tr>
                <?php foreach ($alumnos as $alumno) :?>
                <tr>
                    <td align="center"><?php echo $alumno['num_lista'] ?></td><td><?php echo $alumno['apellidos'] ?></td>
                    <td><?php echo $alumno['nombres'] ?></td><td align="center"><?php echo $alumno['genero'] ?></td>
                    <td align="center"><?php echo $alumno['grado'] ?></td><td align="center"><?php echo $alumno['seccion'] ?></td>
                    <td><a href="alumnoedit.view.php?id=<?php echo $alumno['id'] ?>">Editar</a> </td>
                    <td><a href="alumnodelete.php?id=<?php echo $alumno['id'] ?>">Eliminar</a> </td>
                </tr>
                <?php endforeach;?>
            </table>
                <br><br>

                <a class="btn-link" href="alumnos.view.php">Agregar Alumno</a>
                <br><br>
                <!--mostrando los mensajes que recibe a traves de los parametros en la url-->
                <?php
                if(isset($_GET['err']))
                    echo '<span class="error">Error al almacenar el registro</span>';
                if(isset($_GET['info']))
                    echo '<span class="success">Registro almacenado correctamente!</span>';
                ?>


        </div>
</div>

<footer>
    <p>Created by Mides Study - Derechos reservados &copy; <?php echo date("Y"); ?></p>
</footer>

</body>

</html>