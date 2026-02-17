<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

include_once("config.php");

// Obtener el ID que viene por la URL (ej: delete.php?id=5)
$id = $_GET['id'];

// Ejecutar la eliminación
$resultado = $mysqli->query("DELETE FROM canciones WHERE cancion_id = $id");

// Redirigir al home inmediatamente
header("Location: home.php");
?>
