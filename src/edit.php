<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

include_once("config.php");

// 1. Obtener el ID de la canción a editar
$id = $_GET['id'];

// 2. Buscar los datos actuales de esa canción
$resultado = $mysqli->query("SELECT * FROM canciones WHERE cancion_id = $id");

while($fila = $resultado->fetch_assoc()) {
    $titulo = $fila['titulo'];
    $album = $fila['album'];
    $duracion = $fila['duracion_segundos'];
    $anio = $fila['anio_lanzamiento'];
    $es_single = $fila['es_single'];
    $genero = $fila['genero'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Canción - Daft Punk</title>
</head>
<body style="padding: 20px;">
    <h2>Editar Canción: <?php echo $titulo; ?></h2>
    
    <form action="edit_action.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <label>Título:</label><br>
        <input type="text" name="titulo" value="<?php echo $titulo; ?>" required><br><br>

        <label>Álbum:</label><br>
        <input type="text" name="album" value="<?php echo $album; ?>" required><br><br>

        <label>Duración (segundos):</label><br>
        <input type="number" name="duracion_segundos" value="<?php echo $duracion; ?>" required><br><br>

        <label>Año:</label><br>
        <input type="number" name="anio_lanzamiento" value="<?php echo $anio; ?>" required><br><br>

        <label>¿Es Single?</label><br>
        <select name="es_single">
            <option value="Si" <?php if($es_single == 'Si') echo 'selected'; ?>>Sí</option>
            <option value="No" <?php if($es_single == 'No') echo 'selected'; ?>>No</option>
        </select><br><br>

        <label>Género:</label><br>
        <input type="text" name="genero" value="<?php echo $genero; ?>"><br><br>

        <input type="submit" value="Actualizar Canción" style="background-color: #4CAF50; color: white; padding: 10px;">
    </form>
    <br>
    <a href="home.php">Cancelar y volver</a>
</body>
</html>
