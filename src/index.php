<?php
session_start();
if (isset($_SESSION['usuario_id'])) {
    header("Location: home.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido Daft Punk App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white text-center d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div>
        <h1 class="display-1">DAFT PUNK PLAYLISTS</h1>
        <p class="lead">Crea tus propias listas con lo mejor de la música electrónica.</p>
        <div class="mt-4">
            <a href="login.php" class="btn btn-primary btn-lg mx-2">Iniciar Sesión</a>
            <a href="registro.php" class="btn btn-outline-light btn-lg mx-2">Registrarse</a>
        </div>
    </div>
</body>
</html>
