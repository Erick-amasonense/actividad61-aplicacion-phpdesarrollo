<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Añadir Canción - Daft Punk</title>
</head>
<body style="padding: 20px;">
    <h2>Añadir Nueva Canción 🎵</h2>
    
    <form action="add_action.php" method="POST">
        <label>Título de la canción:</label><br>
        <input type="text" name="titulo" required><br><br>

        <label>Álbum:</label><br>
        <input type="text" name="album" required><br><br>

        <label>Duración (en segundos):</label><br>
        <input type="number" name="duracion_segundos" required><br><br>

        <label>Año de lanzamiento:</label><br>
        <input type="number" name="anio_lanzamiento" required><br><br>

        <label>¿Es Single?</label><br>
        <select name="es_single">
            <option value="Si">Sí</option>
            <option value="No">No</option>
        </select><br><br>

        <label>Género (ej. French House, Disco):</label><br>
        <input type="text" name="genero" value="House"><br><br>

        <input type="submit" value="Guardar Canción" style="background-color: gold; font-weight: bold; padding: 10px;">
    </form>
    <br>
    <a href="home.php">Volver a la lista</a>
</body>
</html>
