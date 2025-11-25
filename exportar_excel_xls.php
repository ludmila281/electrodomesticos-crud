<?php
// Conexión a la base de datos (con puerto 3308)
$conexion = new PDO("mysql:host=localhost;port=3308;dbname=electrodomesticos;charset=utf8", "root", "");

// Consulta solo los precios
$sql = "SELECT precio FROM productos";
$stmt = $conexion->query($sql);

// Configurar cabeceras para Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=precios_productos.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Generar contenido (solo precios)
echo "<table border='1'>";
echo "<tr><th>Precio</th></tr>";

while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr><td>" . $fila['precio'] . "</td></tr>";
}

echo "</table>";
exit;
?>
