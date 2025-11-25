<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    $sql = "SELECT contrasena FROM usuarios WHERE usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hash);
        $stmt->fetch();
        if (password_verify($contrasena, $hash)) {
            header("Location: bienvenida.php");
            exit();
        } else {
            echo "<p>Contraseña incorrecta.</p>";
        }
    } else {
        echo "<p>Usuario no encontrado.</p>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar Sesión</title>
  <style>
    body {
      font-family: Arial;
      background-color: #f0f0f0;
      text-align: center;
      padding: 40px;
    }

    form {
      background-color: white;
      display: inline-block;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
    }

    input[type="text"], input[type="password"] {
      width: 80%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 6px;
    }

    input[type="submit"] {
      background-color: #007bff;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #0056b3;
    }

    a {
      text-decoration: none;
      color: #007bff;
    }
  </style>
</head>
<body>
  <h2>Iniciar Sesión</h2>
  <form method="POST">
    <input type="text" name="usuario" placeholder="Usuario" required><br>
    <input type="password" name="contrasena" placeholder="Contraseña" required><br>
    <input type="submit" value="Entrar">
  </form>
  <p><a href="index.html">Volver al inicio</a></p>
</body>
</html>
