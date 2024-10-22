<?php
session_start();
if ( isset($_COOKIE["activo"]) && isset($_SESSION['username'])) {
    setcookie("activo", 1, time() + 3600);
} else {
    http_response_code(403);
    header('location:index.php?err=2');
}
require 'database/connection.php';

function permisos($permisos){
    if (!in_array($_SESSION['rol'], $permisos)) {
        http_response_code(403);
        header('location:inicio.view.php?err=1');
    }
}

function existeNota($id_alumno, $id_materia, $conn){
    $nota = $conn->prepare("select * from notas where id_materia = '$id_materia' and id_alumno = '$id_alumno'");
    $nota->execute();
    $nota = $nota->rowCount();
    return $nota;
}

?>