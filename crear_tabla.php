<?php
include 'conexion.php';

$sql = "CREATE TABLE IF NOT EXISTS productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    tipo VARCHAR(50),
    precio DECIMAL(10,2)
)";
$conn->query($sql);
?>
