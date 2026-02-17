<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

include_once("config.php");

// Recibir los datos del formulario
$titulo = $_POST['titulo'];
$album = $_POST['album'];
$duracion = $_POST['duracion_segundos'];
$anio = $_POST['anio_lanzamiento'];
$es_single = $_POST['es_single'];
$genero = $_POST['genero'];

// ⚠️ REQUISITO: Validación UNIQUE (Comprobar si el título ya existe)
$sql_check = "SELECT titulo FROM canciones WHERE titulo = '$titulo'";
$resultado_check = $mysqli->query($sql_check);

if ($resultado_check->num_rows > 0) {
    // Si ya existe, mostramos un error y detenemos el proceso
    echo "<h3>Error: La canción '$titulo' ya existe en la base de datos.</h3>";
    echo "<p>Los títulos deben ser únicos.</p>";
    echo "<a href='javascript:self.history.back();'>Volver al formulario</a>";
} else {
    // Si no existe, procedemos a hacer el INSERT
    $sql_insert = "INSERT INTO canciones (titulo, album, duracion_segundos, anio_lanzamiento, es_single, genero) 
                   VALUES ('$titulo', '$album', $duracion, $anio, '$es_single', '$genero')";

    if ($mysqli->query($sql_insert) === TRUE) {
        echo "<h3>¡Canción añadida con éxito! 🎧</h3>";
        echo "<a href='home.php'>Ver lista de canciones</a>";
    } else {
        echo "Error al guardar: " . $mysqli->error;
    }
}

$mysqli->close();
?>
