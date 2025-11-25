<?php
// Incluye la conexión a la base de datos


include 'conexion.php';


// Consulta productos
// Consulta con buscador
$busqueda = "";

if (isset($_GET['buscar']) && $_GET['buscar'] != "") {
    $valor = $conn->real_escape_string($_GET['buscar']);
    $busqueda = " WHERE nombre LIKE '%$valor%' OR tipo LIKE '%$valor%'";
}

$sql = "SELECT id, nombre, tipo, precio FROM productos" . $busqueda;
$resultado = $conn->query($sql);



?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Bienvenido | Electrodomésticos selud</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
  /* ===== NAVBAR CENTRADO DE VERDAD ===== */
.navbar {
    width: 100%;
    background: #ffffff;
    padding: 15px 0;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    position: sticky;
    top: 0;
    z-index: 1000;
    display: flex;
    justify-content: center;   /* Esto centra el bloque interno */
}

.nav-container {
    width: 70%;                 /* ACHICA el contenido para centrarlo */
    max-width: 900px;           /* Para que no sea gigante */
    display: flex;
    justify-content: center;    /* Centra el contenido */
}

.nav-links {
    list-style: none;
    display: flex;
    gap: 30px;
    margin: 0;
    padding: 0;
}

.nav-links a {
    text-decoration: none;
    padding: 10px 18px;
    color: #333;
    font-weight: 500;
    border: 2px solid #eaeaea;
    border-radius: 10px;
    transition: 0.25s;
}

.nav-links a:hover {
    border-color: #007bff;
    color: #007bff;
    background: #f0f7ff;
}


 

    body {
      font-family: Arial, sans-serif;
      
    background-color: #f7f7f7;


      /*background-color: white;*/
    }

    .hero {
      text-align: center;
      padding: 30px;
    }

    .tabla-productos {
      margin-top: 30px;
    }

    footer {
      margin-top: 40px;
      background-color: #343a40;
      color: white;
      text-align: center;
      padding: 15px;
    }

/* Botón Editar (warning) */
.btn-warning {
    background-color: #e5e112ff !important; /* Amarillo personalizado */
    border-color: #e5de12ff!important;
    color: #000 !important;
}

/* Botón Eliminar (danger) */
.btn-danger {
    background-color: #e63946 !important; /* Rojo suave */
    border-color: #cc2f3d !important;
    color: white !important;
}

/* Botón Excel / Agregar (success) */
.btn-success {
    background-color: #2a9d8f !important; /* Verde turquesa */
    border-color: #21867a !important;
    color: white !important;
}

/* Tamaño pequeño (opcional, para que se vea mejor) */
.btn-sm {
    padding: 5px 12px !important;
    border-radius: 6px !important;
}
.btn-logout {
  background-color:   #3795f9 !important;
    border-color: #3795f9 !important;
    color: white !important;
}
  
  </style>


</head>
<body>

<!-- Encabezado -->
<div class="hero">
   <nav class="navbar">
    
    <ul class="nav-links">
        <li><a href="index.html">Inicio</a></li>
        <li><a href="agregar.php">Agregar producto</a></li>
        <li><a href="eliminar.php">Eliminar</a></li>
        <li><a href="login.php">Salir</a></li>

    </ul>
</nav>
  <h1>Bienvenido a Electrodomésticos S.A.</h1>
  <p class="lead">Explora nuestra selección de productos de calidad</p>
</div>


<!-- Carrusel -->
<div id="carrusel" class="carousel slide w-75 mx-auto" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/lavadora.jpg" class="d-block mx-auto 50"alt="Lavadora">
    </div>
    <div class="carousel-item">
      <img src="img/refrigerador.jpg" class="d-block w-50"  alt="Refrigerador">
    </div>
    <div class="carousel-item">
      <img src="img/microondas.jpg" class="d-block w-50"alt="Microondas">
    </div>
      <div class="carousel-item">
      <img src="img/aireacondicionado.jpg" class="d-block w-50"alt="Aireacondicionado">
    </div>
      <div class="carousel-item">
      <img src="img/televisor.jpg" class="d-block w-50"alt="Televisor">
    </div>
      <div class="carousel-item">
      <img src="img/cafetera.jpg" class="d-block w-50"alt="Cafetera">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carrusel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carrusel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>
<p style="padding-bottom: 20px;"></p>

<form method="GET" class="d-flex mb-4" style="max-width: 400px; margin:auto;">
    <input type="text" name="buscar" class="form-control" placeholder="Buscar producto..." 
           value="<?php echo isset($_GET['buscar']) ? $_GET['buscar'] : ''; ?>">
    <button class="btn btn-primary ms-2">Buscar</button>
</form>

<!-- Tabla de productos -->
<div class="container tabla-productos">
  <h2 class="text-center mb-4">Lista de Productos</h2>

  <table class="table table-striped">
    <thead class="table-dark">
      <tr>
        <th>Nombre</th>
        <th>Tipo</th>
        <th>Precio ($)</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
          echo "<tr>
                  <td>{$row['nombre']}</td>
                  <td>{$row['tipo']}</td>
                  <td>{$row['precio']}</td>
                  <td>
                  <a href='agregar.php' class='btn btn-success'></a>
                <a href='editar.php?id={$row['id']}' class='btn btn-sm btn-warning'>Editar</a>
                 <a href='eliminar.php?id={$row['id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"¿Estás seguro de eliminar este producto?\")'>Eliminar</a>
                 <a href='exportar_pdf.php' class='btn btn-danger'>Exportar a PDF</a>
                 <a href='exportar_excel_xls.php' class='btn btn-success'>Exportar a Excel</a>


              </td>

                </tr>";
        }
      } else {
        echo "<tr><td colspan='3'>No hay productos disponibles.</td></tr>";
      }
      ?>
      
    </tbody>
  </table>
</div>

<!-- Botón de cerrar sesión -->
<div class="text-center mt-4">
  <a href="index.html" class="btn btn-logout">Cerrar sesión</a>
</div>

<!-- Footer -->
<footer>
  <p>© 2025 Electrodomésticos Selud. | Todos los derechos reservados</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
