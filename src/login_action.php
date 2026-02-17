<?php
session_start();
include_once("config.php");

$user = mysqli_real_escape_string($mysqli, $_POST['username']);
$pass = $_POST['password'];

$sql = "SELECT * FROM usuarios WHERE nombre_usuario = '$user'";
$result = mysqli_query($mysqli, $sql);

if ($row = mysqli_fetch_assoc($result)) {
    if (password_verify($pass, $row['contrasena'])) {
        // Guardamos ID y Nombre en sesión
        $_SESSION['usuario_id'] = $row['usuario_id'];
        $_SESSION['nombre_usuario'] = $row['nombre_usuario'];
        header("Location: home.php");
    } else {
        echo "Contraseña incorrecta. <a href='login.php'>Intentar de nuevo</a>";
    }
} else {
    echo "Usuario no encontrado. <a href='registro.php'>Regístrate</a>";
}
?>
