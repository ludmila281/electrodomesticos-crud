<?php
$host = "localhost";
$usuario = "root";
$contrasena = "";
$baseDeDatos = "electrodomesticos";
$puerto = 3308; // cambia si tu MySQL usa otro puerto

$conn = new mysqli($host, $usuario, $contrasena, $baseDeDatos, $puerto);


if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}


?>

