<?php
include 'conexion.php'; // <-- aquí usás $conn

// 1️⃣ Obtener el producto a editar (por GET)
$producto = null;
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];
    $sql = "SELECT * FROM productos WHERE id = $id";
    $resultado = $conn->query($sql);

    if ($resultado && $resultado->num_rows > 0) {
        $producto = $resultado->fetch_assoc();
    } else {
        // Si no existe el producto, redirigir o mostrar mensaje
        die("Producto no encontrado.");
    }
}

// 2️⃣ Actualizar producto al enviar el formulario (por POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Tomar valores del POST (validar/escapar)
    $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
    $nombre = isset($_POST['nombre']) ? $conn->real_escape_string(trim($_POST['nombre'])) : '';
    $tipo = isset($_POST['tipo']) ? $conn->real_escape_string(trim($_POST['tipo'])) : '';
    $precio = isset($_POST['precio']) ? (float) $_POST['precio'] : 0;

    // Validaciones básicas
    if ($id <= 0 || $nombre === '' || $tipo === '') {
        die("Datos incompletos.");
    }

    // UPDATE usando consulta preparada (recomendado)
    $stmt = $conn->prepare("UPDATE productos SET nombre = ?, tipo = ?, precio = ? WHERE id = ?");
    $stmt->bind_param("ssdi", $nombre, $tipo, $precio, $id);

    if ($stmt->execute()) {
        $stmt->close();
        header("Location: bienvenida.php");
        exit;
    } else {
        $error = $conn->error;
        $stmt->close();
        die("Error al actualizar producto: $error");
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Editar Producto</h2>

    <?php if ($producto): ?>
    <form method="post" action="editar.php">
        <!-- usar $producto (SIN S) -->
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($producto['id']); ?>">

        <div class="mb-3">
            <label class="form-label">Nombre:</label>
            <input type="text" name="nombre" class="form-control" value="<?php echo htmlspecialchars($producto['nombre']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tipo:</label>
            <input type="text" name="tipo" class="form-control" value="<?php echo htmlspecialchars($producto['tipo']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Precio:</label>
            <input type="number" step="0.01" name="precio" class="form-control" value="<?php echo htmlspecialchars($producto['precio']); ?>" required>
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="bienvenida.php" class="btn btn-secondary">Cancelar</a>
    </form>
    <?php else: ?>
        <div class="alert alert-warning">No se encontró el producto para editar.</div>
    <?php endif; ?>
</div>
</body>
</html>

