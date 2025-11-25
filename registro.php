<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (usuario, contrasena) VALUES (?, ?)";
     $stmt= $conn->prepare($sql);
     $stmt->bind_param("ss", $usuario, $contrasena);
$stmt->execute();

    if (!$stmt) {
        die("Error en prepare: " . $conn->error);
      
    }

    $stmt->bind_param("ss", $usuario, $contrasena);

    if ($stmt->execute()) {
        echo "<p>Registro exitoso. <a href='login.php'>Iniciar sesión</a></p>";
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro</title>
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
      background-color: #28a745;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #218838;
    }

    a {
      text-decoration: none;
      color: #007bff;
    }
  </style>
</head>
<body>
  <h2>Registro de Usuario</h2>
  <form method="POST">
    <input type="text" name="usuario" placeholder="Usuario" required><br>
    <input type="password" name="contrasena" placeholder="Contraseña" required><br>
    <input type="submit" value="Registrar">
  </form>
  <p><a href="index.html">Volver al inicio</a></p>
</body>
</html>
