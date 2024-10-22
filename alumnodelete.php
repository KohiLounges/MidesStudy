<?php
require 'functions.php';

if ($_SESSION['rol'] == 'Administrador') {
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        try {
            $id_alumno = $_GET['id'];

            // Elimina las notas asociadas al alumno
            $stmtDeleteNotas = $conn->prepare("DELETE FROM notas WHERE id_alumno = :id_alumno");
            $stmtDeleteNotas->bindParam(':id_alumno', $id_alumno);
            $stmtDeleteNotas->execute();

            // Luego, elimina al alumno
            $stmtDeleteAlumno = $conn->prepare("DELETE FROM alumnos WHERE id = :id_alumno");
            $stmtDeleteAlumno->bindParam(':id_alumno', $id_alumno);
            $stmtDeleteAlumno->execute();

            header('location:listadoalumnos.view.php');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    } else {
        die('Ha ocurrido un error');
    }
} else {
    header('location:inicio.view.php?err=1');
}
?>
