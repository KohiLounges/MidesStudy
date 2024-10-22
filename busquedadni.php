<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busqueda por D.N.I</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #0B132B;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Buscar Personas por DNI</h1>
        <img src="images/logo.png" style="width: 100px; height: 100px" />

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
        <form method="post" action="buscar_persona.php">
            <label>Ingrese el DNI:</label>
            <input type="text" name="dni" required>
            <button type="submit">Buscar</button>
        </form>
        <?php
        if (isset($_POST['dni'])) {
        }
        ?>
    </div>
    <footer>
    <p>Created by Mides Study - Derechos reservados &copy; <?php echo date("Y"); ?></p>
    </footer>
</body>
</html>
