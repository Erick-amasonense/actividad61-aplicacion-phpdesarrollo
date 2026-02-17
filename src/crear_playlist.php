<?php
session_start();
include_once("config.php");

if (!isset($_SESSION['usuario_id'])) header("Location: index.php");

// Obtenemos TODAS las canciones del sistema para mostrarlas
$canciones = mysqli_query($mysqli, "SELECT * FROM canciones ORDER BY album, titulo");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Playlist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
    <div class="container mt-5">
        <h2>Crear Nueva Playlist</h2>
        <form action="crear_playlist_action.php" method="POST">
            <div class="mb-4">
                <label class="form-label">Nombre de la Playlist:</label>
                <input type="text" name="nombre" class="form-control" placeholder="Ej: Favoritas, Gym, Relax..." required>
            </div>

            <h4>Selecciona las canciones:</h4>
            <div class="card text-dark p-3" style="max-height: 400px; overflow-y: scroll;">
                <?php while($c = mysqli_fetch_assoc($canciones)): ?>
                    <div class="form-check border-bottom py-2">
                        <input class="form-check-input" type="checkbox" name="canciones[]" value="<?php echo $c['cancion_id']; ?>" id="c_<?php echo $c['cancion_id']; ?>">
                        <label class="form-check-label" for="c_<?php echo $c['cancion_id']; ?>">
                            <strong><?php echo $c['titulo']; ?></strong> 
                            <small class="text-muted">- <?php echo $c['album']; ?> (<?php echo $c['duracion']; ?>)</small>
                        </label>
                    </div>
                <?php endwhile; ?>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary btn-lg">Guardar Playlist</button>
                <a href="home.php" class="btn btn-secondary btn-lg">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>
