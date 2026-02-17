<?php
session_start();
include_once("config.php");

if (!isset($_GET['id'])) header("Location: home.php");

$playlist_id = (int)$_GET['id'];
$uid = $_SESSION['usuario_id'];

// 1. Obtener info de la playlist (y verificar que sea del usuario)
$sql_info = "SELECT * FROM playlists WHERE playlist_id = '$playlist_id' AND usuario_id = '$uid'";
$res_info = mysqli_query($mysqli, $sql_info);
$playlist = mysqli_fetch_assoc($res_info);

if (!$playlist) die("Playlist no encontrada o acceso denegado.");

// 2. Obtener las canciones de esa playlist haciendo JOIN
$sql_canciones = "SELECT c.* FROM canciones c 
                  JOIN playlist_canciones pc ON c.cancion_id = pc.cancion_id 
                  WHERE pc.playlist_id = '$playlist_id'";
$canciones = mysqli_query($mysqli, $sql_canciones);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contenido Playlist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
    <div class="container mt-5">
        <h1>📀 Playlist: <?php echo $playlist['nombre']; ?></h1>
        <a href="home.php" class="btn btn-outline-light mb-4">&larr; Volver</a>

        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Álbum</th>
                    <th>Duración</th>
                    <th>Año</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($canciones)): ?>
                <tr>
                    <td><?php echo $row['titulo']; ?></td>
                    <td><?php echo $row['album']; ?></td>
                    <td><?php echo $row['duracion']; ?></td>
                    <td><?php echo $row['anio']; ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
