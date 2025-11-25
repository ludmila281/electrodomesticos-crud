<?php
require('fpdf/fpdf.php');
include 'conexion.php';

// Crear PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);

// Encabezados de la tabla
$pdf->Cell(60,10,'Nombre',1);
$pdf->Cell(60,10,'Tipo',1);
$pdf->Cell(30,10,'Precio',1);
$pdf->Ln();

// Obtener productos
$resultado = $conn->query("SELECT nombre, tipo, precio FROM productos");
while($row = $resultado->fetch_assoc()){
    $pdf->Cell(60,10,$row['nombre'],1);
    $pdf->Cell(60,10,$row['tipo'],1);
    $pdf->Cell(30,10,$row['precio'],1);
    $pdf->Ln();
}

// Descargar PDF
$pdf->Output('D','productos.pdf');
?>
