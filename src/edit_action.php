<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

include_once("config.php");

// Recibir datos del formulario
$id = $_POST['id'];
$titulo = $_POST['titulo'];
$album = $_POST['album'];
$duracion = $_POST['duracion_segundos'];
$anio = $_POST['anio_lanzamiento'];
$es_single = $_POST['es_single'];
$genero = $_POST['genero'];

// Ejecutar el UPDATE
$sql = "UPDATE canciones SET 
        titulo = '$titulo', 
        album = '$album', 
        duracion_segundos = $duracion, 
        anio_lanzamiento = $anio, 
        es_single = '$es_single', 
        genero = '$genero' 
        WHERE cancion_id = $id";

if ($mysqli->query($sql) === TRUE) {
    echo "<h3>¡Canción actualizada correctamente! 🎚️</h3>";
    echo "<a href='home.php'>Volver al inicio</a>";
} else {
    echo "Error al actualizar: " . $mysqli->error;
}

$mysqli->close();
?>
