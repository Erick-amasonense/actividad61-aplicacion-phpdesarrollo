<?php
session_start();
include_once("config.php");

if (isset($_GET['id']) && isset($_SESSION['usuario_id'])) {
    $id = (int)$_GET['id'];
    $uid = $_SESSION['usuario_id'];

    // Solo borramos si pertenece al usuario logueado
    $sql = "DELETE FROM playlists WHERE playlist_id = '$id' AND usuario_id = '$uid'";
    mysqli_query($mysqli, $sql);
}

header("Location: home.php");
?>
