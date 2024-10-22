<!DOCTYPE html>
<?php
require 'functions.php';

$permisos = ['Administrador','Profesor','Padre'];
permisos($permisos);

$materias = $conn->prepare("select * from materias");
$materias->execute();
$materias = $materias->fetchAll();

$grados = $conn->prepare("select * from grados");
$grados->execute();
$grados = $grados->fetchAll();

$secciones = $conn->prepare("select * from secciones");
$secciones->execute();
$secciones = $secciones->fetchAll();
?>
<html>
<head>
    <title>Notas | Registro de Notas</title>
    <meta name="description" content="Registro de Notas de la E.N.S N°10" />
    <link rel="stylesheet" href="css/style.css" />
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
    <h3>Usuario:  <?php echo $_SESSION["username"] ?></h3>
    <img src="images/logo.png" style="width: 100px; height: 100px" />
</div>
<nav>
    <ul>
        <li><a href="inicio.view.php">Inicio</a> </li>
        <li><a href="alumnos.view.php">Registro de Alumnos</a> </li>
        <li><a href="listadoalumnos.view.php">Listado de Alumnos</a> </li>
        <li><a href="notas.view.php">Registro de Notas</a> </li>
        <li class="active"><a href="listadonotas.view.php">Consulta de Notas</a> </li>
        <li><a href="busquedadni.php">Busqueda por D.N.I</a> </li>
        <li class="right"><a href="logout.php">Salir</a> </li>
    </ul>
</nav>

<div class="body">
    <div class="panel">
        <h3>Consulta de Notas</h3>
        <?php
        if(!isset($_GET['consultar'])){
            ?>
            <p>Seleccione el grado, la materia y la sección</p>
            <form method="get" class="form" action="listadonotas.view.php">
                <label>Seleccione el Grado</label><br>
                <select name="grado" required>
                    <?php foreach ($grados as $grado):?>
                        <option value="<?php echo $grado['id'] ?>"><?php echo $grado['nombre'] ?></option>
                    <?php endforeach;?>
                </select>
                <br><br>
                <label>Seleccione la Materia</label><br>
                <select name="materia" required>
                    <?php foreach ($materias as $materia):?>
                        <option value="<?php echo $materia['id'] ?>"><?php echo $materia['nombre'] ?></option>
                    <?php endforeach;?>
                </select>

                <br><br>
                <label>Seleccione la Sección</label><br><br>

                <?php foreach ($secciones as $seccion):?>
                    <input type="radio" name="seccion" required value="<?php echo $seccion['id'] ?>">Sección <?php echo $seccion['nombre'] ?>
                <?php endforeach;?>

                <br><br>
                <button type="submit" name="consultar" value="1">Consultar Notas</button></a>
                <br><br>
            </form>
            <?php
        }
        ?>
        <hr>

        <?php
        if(isset($_GET['consultar'])){
            $id_materia = $_GET['materia'];
            $id_grado = $_GET['grado'];
            $id_seccion = $_GET['seccion'];

            $num_eval = $conn->prepare("select num_evaluaciones from materias where id = ".$id_materia);
            $num_eval->execute();
            $num_eval = $num_eval->fetch();
            $num_eval = $num_eval['num_evaluaciones'];

            $sqlalumnos = $conn->prepare("select a.id, a.num_lista, a.apellidos, a.nombres, b.nota,b.observaciones, avg(b.nota) as promedio from alumnos as a left join notas as b on a.id = b.id_alumno
            where id_grado = ".$id_grado." and id_seccion = ".$id_seccion." group by a.id");
            $sqlalumnos->execute();
            $alumnos = $sqlalumnos->fetchAll();
            ?>
            <br>
            <a href="listadonotas.view.php"><strong><< Volver</strong></a>
            <br>
            <br>

            <table class="table" cellpadding="0" cellspacing="0">
                <tr>
                    <th>No de lista</th><th>Apellidos</th><th>Nombres</th>
                    <?php
                    for($i = 1; $i <= $num_eval; $i++){
                        echo '<th>Nota '.$i .'</th>';
                    }
                    ?>
                    <th>Promedio</th>
                    <th>Observaciones</th>
                </tr>
                <?php foreach ($alumnos as $index => $alumno) :?>
                    <tr>
                        <td align="center"><?php echo $alumno['num_lista'] ?></td>
                        <td><?php echo $alumno['apellidos'] ?></td>
                        <td><?php echo $alumno['nombres'] ?></td>
                        <?php
                            $notas = $conn->prepare("SELECT nota FROM notas WHERE id_alumno = ".$alumno['id']." AND id_materia = ".$id_materia);
                            $notas->execute();
                            $notas = $notas->fetchAll(PDO::FETCH_COLUMN);

                            for($i = 0; $i < $num_eval; $i++) {
                                $nota = isset($notas[$i]) ? $notas[$i] : '0.00';
                                echo '<td align="center"><input type="hidden" name="nota'.$i.'" value="'. $nota . '" >'. $nota . '</td>';
                            }

                            echo '<td align="center">'.number_format($alumno['promedio'], 2).'</td>';
                            echo '<td>'. $alumno['observaciones']. '</td>';
                        ?>
                    </tr>
                <?php endforeach;?>
            </table>

            <br>
        <?php
        }
        ?>
    </div>
</div>

<footer>
    <p>Created by Mides Study - Derechos reservados &copy; 2024</p>
</footer>

</body>
<script>
    <?php
    for($i = 0; $i < $num_eval; $i++){
        echo 'var values'.$i.' = [];
        var promedio'.$i.';
        var valor'.$i.' = 0;
        var nota'.$i.' = document.getElementsByName("nota'.$i.'");
        for(var j = 0; j < nota'.$i.'.length; j++) {
            valor'.$i.' += parseFloat(nota'.$i.'[j].value);
        }
        promedio'.$i.' = (valor'.$i.' / parseFloat(nota'.$i.'.length));
        document.getElementById("promedio'.$i.'").innerHTML = promedio'.$i.'.toFixed(2);';
    }
    ?>
</script>
</html>
