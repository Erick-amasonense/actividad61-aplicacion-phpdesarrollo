<?php
// Configuración de conexión usando variables de entorno
$db_host = getenv('MARIADB_HOST') ?: 'mariadb';
$db_name = getenv('MARIADB_DATABASE') ?: 'daftpunk_db';
$db_user = getenv('MARIADB_USER') ?: 'root';
$db_pass = getenv('MARIADB_PASSWORD') ?: 'root';

$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($mysqli->connect_error) {
    die("Error de conexión a la Base de Datos: " . $mysqli->connect_error);
}
?>
