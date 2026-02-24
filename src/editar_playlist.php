<?php
session_start();
include_once("config.php");

// 1. Verificación de sesión
if (!isset($_SESSION['usuario_id'])) { 
    header("Location: index.php"); 
    exit(); 
}

// 2. Validar ID de playlist y Usuario (Sanitización)
$pid = isset($_GET['id']) ? intval($_GET['id']) : 0;
$uid = $_SESSION['usuario_id'];

// --- ACCIONES ---

// A. Actualizar nombre
if (isset($_POST['update_name'])) {
    $nuevo_nombre = mysqli_real_escape_string($mysqli, $_POST['nombre']);
    mysqli_query($mysqli, "UPDATE playlists SET nombre = '$nuevo_nombre' WHERE playlist_id = $pid AND usuario_id = $uid");
    header("Location: editar_playlist.php?id=$pid");
    exit();
}

// B. Añadir canción (Añadido redirección para que se vea el cambio al instante)
if (isset($_POST['add_song'])) {
    $cid = intval($_POST['cancion_id']);
    mysqli_query($mysqli, "INSERT IGNORE INTO playlist_canciones (playlist_id, cancion_id) VALUES ($pid, $cid)");
    header("Location: editar_playlist.php?id=$pid");
    exit();
}

// C. Quitar canción
if (isset($_GET['remove_song'])) {
    $cid = intval($_GET['remove_song']);
    mysqli_query($mysqli, "DELETE FROM playlist_canciones WHERE playlist_id = $pid AND cancion_id = $cid");
    header("Location: editar_playlist.php?id=$pid");
    exit();
}

// 3. Obtener datos de la playlist (Solo si pertenece al usuario logueado)
$res_p = mysqli_query($mysqli, "SELECT * FROM playlists WHERE playlist_id = $pid AND usuario_id = $uid");
$playlist = mysqli_fetch_assoc($res_p);

// Si la playlist no existe o no es del usuario, redirigir al home
if (!$playlist) {
    header("Location: home.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Playlist | <?php echo htmlspecialchars($playlist['nombre']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card { border-radius: 12px; overflow: hidden; }
        .table-dark { --bs-table-bg: #1a1a1a; }
    </style>
</head>
<body class="bg-dark text-white">
    <nav class="navbar navbar-dark bg-black p-3 shadow">
        <div class="container">
            <span class="navbar-brand mb-0 h1">🎧 Daft Punk Manager</span>
            <a href="home.php" class="btn btn-outline-light btn-sm">Volver al Inicio</a>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card bg-black border-secondary p-3 mb-4">
                    <h5 class="text-warning">Nombre de la Playlist</h5>
                    <form method="POST">
                        <input type="text" name="nombre" class="form-control mb-2 bg-dark text-white border-secondary" 
                               value="<?php echo htmlspecialchars($playlist['nombre']); ?>" required>
                        <button type="submit" name="update_name" class="btn btn-warning w-100 fw-bold">Guardar Cambios</button>
                    </form>
                </div>

                <div class="card bg-black border-secondary p-3">
                    <h5 class="text-success">Añadir Nueva Canción</h5>
                    <form method="POST">
                        <select name="cancion_id" class="form-select mb-2 bg-dark text-white border-secondary" required>
                            <option value="" selected disabled>Selecciona una del catálogo...</option>
                            <?php
                            $cat = mysqli_query($mysqli, "SELECT * FROM canciones ORDER BY titulo ASC");
                            while($s = mysqli_fetch_assoc($cat)) {
                                echo "<option value='{$s['cancion_id']}'>".htmlspecialchars($s['titulo'])."</option>";
                            }
                            ?>
                        </select>
                        <button type="submit" name="add_song" class="btn btn-success w-100 fw-bold">Añadir a la lista</button>
                    </form>
                </div>
            </div>

            <div class="col-md-8">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="text-info"><?php echo htmlspecialchars($playlist['nombre']); ?></h2>
                    <span class="badge bg-secondary"><?php echo mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM playlist_canciones WHERE playlist_id = $pid")); ?> canciones</span>
                </div>

                <div class="table-responsive">
                    <table class="table table-dark table-hover align-middle">
                        <thead class="table-black">
                            <tr>
                                <th>Título</th>
                                <th>Plataforma</th>
                                <th class="text-end">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $res_c = mysqli_query($mysqli, "SELECT c.cancion_id, c.titulo, c.soundcloud_url 
                                                            FROM canciones c 
                                                            JOIN playlist_canciones pc ON c.cancion_id = pc.cancion_id 
                                                            WHERE pc.playlist_id = $pid");
                            
                            if(mysqli_num_rows($res_c) > 0):
                                while($c = mysqli_fetch_assoc($res_c)): ?>
                                <tr>
                                    <td><strong><?php echo htmlspecialchars($c['titulo']); ?></strong></td>
                                    <td>
                                        <?php if(!empty($c['soundcloud_url'])): ?>
                                            <a href="<?php echo $c['soundcloud_url']; ?>" target="_blank" class="btn btn-sm btn-outline-warning">Reproducir 🔗</a>
                                        <?php else: ?>
                                            <span class="text-muted small italic">No disponible</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end">
                                        <a href="editar_playlist.php?id=<?php echo $pid; ?>&remove_song=<?php echo $c['cancion_id']; ?>" 
                                           class="btn btn-sm btn-danger" 
                                           onclick="return confirm('¿Quitar canción de la lista?')">Quitar</a>
                                    </td>
                                </tr>
                                <?php endwhile; 
                            else: ?>
                                <tr><td colspan="3" class="text-center text-muted p-5">Esta playlist está vacía. ¡Añade música desde el panel izquierdo!</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>