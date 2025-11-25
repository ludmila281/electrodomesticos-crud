<form action="" method="post"> 
    Nombre: <input type="text" name="nombre"><br> 
    Tipo: <input type="text" name="tipo"><br> 
    Precio: <input type="number" step="0.01" name="precio"><br> 
    <input type="submit" value="Agregar"> 
</form>

<?php 
include 'conexion.php'; // Aquí está $conn

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nombre = $_POST['nombre'];
    $tipo = $_POST['tipo'];
    $precio = $_POST['precio'];

    $sql = "INSERT INTO productos (nombre, tipo, precio) 
            VALUES ('$nombre', '$tipo', '$precio')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('✅ Producto registrado con éxito');
                window.location = 'bienvenida.php';
              </script>";
    } else {
        echo "<script>
                alert('❌ Error al registrar producto: ".mysqli_error($conn)."');
              </script>";
    }
}
?>
<style>
    body {
        background: #f4f6f9;
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .form-container {
        background: #fff;
        padding: 30px;
        width: 400px;
        border-radius: 15px;
        box-shadow: 0px 8px 20px rgba(0,0,0,0.1);
        animation: fadeIn 0.6s ease-in-out;
    }

    .form-container h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
        font-weight: bold;
    }

    label {
        font-weight: bold;
        color: #444;
        margin-bottom: 5px;
        display: block;
    }

    input[type="text"],
    input[type="number"] {
        width: 100%;
        padding: 10px;
        border-radius: 10px;
        border: 1px solid #ccc;
        margin-bottom: 15px;
        font-size: 15px;
        transition: 0.2s;
    }

    input[type="text"]:focus,
    input[type="number"]:focus {
        border-color: #6c63ff;
        box-shadow: 0 0 5px rgba(108, 99, 255, 0.5);
        outline: none;
    }

    .btn {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 10px;
        background: #6c63ff;
        color: white;
        font-size: 16px;
        cursor: pointer;
        transition: 0.3s;
        margin-top: 10px;
    }

    .btn:hover {
        background: #5849ff;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
