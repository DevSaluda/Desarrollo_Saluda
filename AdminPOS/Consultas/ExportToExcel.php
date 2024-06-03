<?php
require 'https://saludapos.com/AdminPOS/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Conexión a la base de datos y consulta
$mes = $_POST['Mes'];
$anual = $_POST['anual'];
$conexion = new mysqli("localhost", "usuario", "contraseña", "base_de_datos");

$query = "SELECT * FROM ventas WHERE Mes = '$mes' AND Anual = '$anual'";
$resultado = $conexion->query($query);

// Crear un nuevo archivo de Excel
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Añadir encabezados
$encabezados = ["Cod_Barra", "Nombre_Prod", "PrecioCompra", "PrecioVenta", "FolioTicket", "Sucursal", "Turno", "Cantidad_Venta", "Total_Venta", "Importe", "Descuento", "FormaPago", "Cliente", "FolioSignoVital", "NomServ", "AgregadoEl", "AgregadoEnMomento", "AgregadoPor", "Enfermero", "Doctor"];
$sheet->fromArray($encabezados, NULL, 'A1');

// Añadir datos
$fila = 2;
while ($row = $resultado->fetch_assoc()) {
    $sheet->fromArray(array_values($row), NULL, 'A' . $fila);
    $fila++;
}

// Guardar el archivo
$writer = new Xlsx($spreadsheet);
$filename = 'registro_de_ventas.xlsx';
$writer->save($filename);

// Enviar el archivo al cliente
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Cache-Control: max-age=0');
readfile($filename);

// Eliminar el archivo temporal
unlink($filename);
?>
