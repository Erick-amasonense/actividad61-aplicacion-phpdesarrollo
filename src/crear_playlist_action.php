<?php
session_start();
include_once("config.php");

if (isset($_POST['nombre']) && isset($_SESSION['usuario_id'])) {
    $uid = $_SESSION['usuario_id'];
    $nombre = mysqli_real_escape_string($mysqli, $_POST['nombre']);

    // 1. Crear la Playlist
    $sql = "INSERT INTO playlists (usuario_id, nombre) VALUES ('$uid', '$nombre')";
    
    if (mysqli_query($mysqli, $sql)) {
        // Obtenemos el ID generado automáticamente
        $playlist_id = mysqli_insert_id($mysqli);

        // 2. Insertar las canciones seleccionadas
        if (!empty($_POST['canciones'])) {
            foreach ($_POST['canciones'] as $cancion_id) {
                $cid = (int)$cancion_id;
                $sql_item = "INSERT INTO playlist_canciones (playlist_id, cancion_id) VALUES ('$playlist_id', '$cid')";
                mysqli_query($mysqli, $sql_item);
            }
        }
        header("Location: home.php");
    } else {
        echo "Error: " . mysqli_error($mysqli);
    }
}
?>
