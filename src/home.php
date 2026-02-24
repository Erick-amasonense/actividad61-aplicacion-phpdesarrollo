<?php
session_start();
include_once("config.php");

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}

$uid = $_SESSION['usuario_id'];
$nombre = $_SESSION['nombre_usuario'];

$sql = "SELECT * FROM playlists WHERE usuario_id = '$uid' ORDER BY fecha_creacion DESC";
$result = mysqli_query($mysqli, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Playlists</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
    <nav class="navbar navbar-dark bg-black p-3">
        <div class="container">
            <span class="navbar-brand mb-0 h1">🎧 Daft Punk Manager</span>
            <span class="text-white">Hola, <?php echo $nombre; ?> | <a href="logout.php" class="text-danger">Salir</a></span>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Mis Playlists</h2>
            <a href="crear_playlist.php" class="btn btn-success">+ Nueva Playlist</a>
        </div>

        <?php if(mysqli_num_rows($result) == 0): ?>
            <div class="alert alert-info">Aún no tienes playlists. ¡Crea una!</div>
        <?php else: ?>
            <table class="table table-dark table-hover">
                <thead>
                    <tr>
                        <th>Nombre de la Lista</th>
                        <th>Creada el</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['nombre']; ?></td>
                        <td><?php echo date("d/m/Y", strtotime($row['fecha_creacion'])); ?></td>
                        <td>
                            <a href="ver_playlist.php?id=<?php echo $row['playlist_id']; ?>" class="btn btn-sm btn-info">Ver Canciones</a>
                            <a href="editar_playlist.php?id=<?php echo $row['playlist_id']; ?>" class="btn btn-sm btn-warning text-dark">Editar</a>
                            <a href="borrar_playlist.php?id=<?php echo $row['playlist_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro?')">Eliminar</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>