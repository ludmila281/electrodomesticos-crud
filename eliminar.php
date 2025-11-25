<?php
include 'conexion.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM productos WHERE id=$id";
    $conn->query($sql);
}

// Redirige a la página principal después de eliminar
header("Location: bienvenida.php"); // o index.php si ese es tu principal
exit;
?>
