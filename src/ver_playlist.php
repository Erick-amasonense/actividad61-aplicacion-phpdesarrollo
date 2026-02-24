<?php
session_start();
include_once("config.php");

if (!isset($_SESSION['usuario_id'])) { header("Location: index.php"); exit(); }

$pid = $_GET['id'];
$sql_p = "SELECT nombre FROM playlists WHERE playlist_id = '$pid'";
$res_p = mysqli_query($mysqli, $sql_p);
$p_info = mysqli_fetch_assoc($res_p);

$sql_c = "SELECT c.* FROM canciones c 
          JOIN playlist_canciones pc ON c.cancion_id = pc.cancion_id 
          WHERE pc.playlist_id = '$pid'";
$result_c = mysqli_query($mysqli, $sql_c);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title><?php echo $p_info['nombre']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
    <div class="container mt-4">
        <h1>Playlist: <?php echo $p_info['nombre']; ?></h1>
        <a href="home.php" class="btn btn-secondary mb-3">Volver</a>

        <table class="table table-dark">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Álbum</th>
                    <th>Escuchar</th>
                </tr>
            </thead>
            <tbody>
                <?php while($c = mysqli_fetch_assoc($result_c)): ?>
                <tr>
                    <td><?php echo $c['titulo']; ?></td>
                    <td><?php echo $c['album']; ?></td>
                    <td>
                        <?php if(!empty($c['soundcloud_url'])): ?>
                            <a href="<?php echo $c['soundcloud_url']; ?>" target="_blank" class="btn btn-sm btn-warning">SoundCloud</a>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>