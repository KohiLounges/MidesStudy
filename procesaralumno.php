<?php
if (!$_POST) {
    header('location: alumnos.view.php');
} else {
    // Incluimos el archivo funciones que tiene la conexión
    require 'functions.php';
    
    // Recuperamos los valores que vamos a llenar en la BD
    $nombres = htmlentities($_POST['nombres']);
    $apellidos = htmlentities($_POST['apellidos']);
    $genero = htmlentities($_POST['genero']);
    $numlista = htmlentities($_POST['numlista']);
    $idgrado = htmlentities($_POST['grado']);
    $idseccion = htmlentities($_POST['seccion']);
    $dni = htmlentities($_POST['dni']); // Recuperamos el D.N.I
    
    // Insertar es el nombre del botón "Guardar" que está en el archivo alumnos.view.php
    if (isset($_POST['insertar'])) {
        $result = $conn->query("INSERT INTO alumnos (num_lista, nombres, apellidos, genero, id_grado, id_seccion, dni) VALUES ('$numlista', '$nombres', '$apellidos', '$genero', '$idgrado', '$idseccion', '$dni')");
        
        if (isset($result)) {
            header('location:alumnos.view.php?info=1');
        } else {
            header('location:alumnos.view.php?err=1');
        }
    } elseif (isset($_POST['modificar'])) {
        // Capturamos el ID del alumno a modificar
        $id_alumno = htmlentities($_POST['id']);
        $result = $conn->query("UPDATE alumnos SET num_lista = '$numlista', nombres = '$nombres', apellidos = '$apellidos', genero = '$genero', id_grado = '$idgrado', id_seccion = '$idseccion', dni = '$dni' WHERE id = $id_alumno");
        
        if (isset($result)) {
            header('location:alumnoedit.view.php?id=' . $id_alumno . '&info=1');
        } else {
            header('location:alumnoedit.view.php?id=' . $id_alumno . '&err=1');
        }
    }
}
?>
