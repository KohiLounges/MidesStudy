<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "libreta";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_POST['dni'])) {
    $dni = mysqli_real_escape_string($conn, $_POST['dni']); 

    $sql = "SELECT alumnos.nombres, grados.nombre AS curso, secciones.nombre AS seccion FROM alumnos
            INNER JOIN grados ON alumnos.id_grado = grados.id
            INNER JOIN secciones ON alumnos.id_seccion = secciones.id
            WHERE dni = '$dni'";

    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $nombres = $row["nombres"];
            $curso = $row["curso"];
            $seccion = $row["seccion"];
        } else {
            echo "No se encontró ninguna coincidencia para el D.N.I ingresado.";
        }
    } else {
        echo "Error en la consulta SQL: " . $conn->error;
    }

    $notas_query = "SELECT materias.nombre AS materia, notas.nota, notas.observaciones
               FROM notas
               INNER JOIN materias ON notas.id_materia = materias.id
               INNER JOIN alumnos ON notas.id_alumno = alumnos.id
               WHERE alumnos.dni = '$dni'";

    $notas_result = $conn->query($notas_query);

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de Búsqueda</title>
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
        <h1>Resultados de Búsqueda</h1>
    </div>
    <nav>
        <ul>
            <li><a href="inicio.view.php">Inicio</a> </li>
            <li><a href="alumnos.view.php">Registro de Alumnos</a> </li>
            <li><a href="listadoalumnos.view.php">Listado de Alumnos</a> </li>
            <li><a href="notas.view.php">Registro de Notas</a> </li>
            <li><a href="listadonotas.view.php">Consulta de Notas</a> </li>
            <li class="active"><a href="busquedadni.php">Busqueda por D.N.I</a> </li>
            <li class="right"><a href="logout.php">Salir</a> </li>
        </ul>
    </nav>
    <div class="body">
        <?php
        if (isset($nombres)) {
            echo "<p>Nombre: $nombres</p>";
            echo "<p>Curso: $curso</p>";
            echo "<p>División: $seccion</p>";
        }
        ?>

        <!-- Tabla de notas -->
        <h2>Notas del Alumno</h2>
        <table border="1" cellpadding="5" cellspacing="0">
            <tr>
                <th>Materia</th>
                <th>Nota 1</th>
                <th>Nota 2</th>
                <th>Nota 3</th>
                <th>Nota 4</th>
                <th>Promedio</th>
                <th>Observaciones</th>
            </tr>
            <?php
            if (isset($notas_result) && $notas_result->num_rows > 0) {
                $notas_por_materia = [];
                while ($row = $notas_result->fetch_assoc()) {
                    $materia = $row["materia"];
                    if (!isset($notas_por_materia[$materia])) {
                        $notas_por_materia[$materia] = [
                            'notas' => [],
                            'observaciones' => $row['observaciones']
                        ];
                    }
                    $notas_por_materia[$materia]['notas'][] = $row['nota'];
                }

                foreach ($notas_por_materia as $materia => $datos) {
                    $notas = $datos['notas'];
                    $observaciones = $datos['observaciones'];
                    $promedio = array_sum($notas) / count($notas);

                    echo "<tr>";
                    echo "<td>$materia</td>";
                    echo "<td>" . (isset($notas[0]) ? $notas[0] : '0.00') . "</td>";
                    echo "<td>" . (isset($notas[1]) ? $notas[1] : '0.00') . "</td>";
                    echo "<td>" . (isset($notas[2]) ? $notas[2] : '0.00') . "</td>";
                    echo "<td>" . (isset($notas[3]) ? $notas[3] : '0.00') . "</td>";
                    echo "<td>" . number_format($promedio, 2) . "</td>";
                    echo "<td>$observaciones</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No se encontraron notas para este alumno.</td></tr>";
            }
            ?>
        </table>
    </div>
    <footer>
        <p>Created by Mides Study - Derechos reservados &copy; <?php echo date("Y"); ?></p>
    </footer>
</body>
</html>
