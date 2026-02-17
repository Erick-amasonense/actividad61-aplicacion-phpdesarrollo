<?php
include_once("config.php");

$user = mysqli_real_escape_string($mysqli, $_POST['username']);
$email = mysqli_real_escape_string($mysqli, $_POST['email']);
$pass = $_POST['password'];

// Encriptar contraseña
$pass_hash = password_hash($pass, PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (nombre_usuario, contrasena, correo) VALUES ('$user', '$pass_hash', '$email')";

if (mysqli_query($mysqli, $sql)) {
    header("Location: login.php?status=success");
} else {
    echo "Error: " . mysqli_error($mysqli);
}
?>
