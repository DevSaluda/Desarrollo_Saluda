<?php
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

// Conexión a la base de datos
include("db_connection.php");
include "Consultas.php";

// Obtener las variables POST
if (isset($_POST['Mes']) && isset($_POST['anual'])) {
    $mes = $_POST['Mes'];
    $anual = $_POST['anual'];
} else {
    die("Error: Las variables 'Mes' y 'anual' no están definidas.");
}

// Consulta SQL
$query = "SELECT DISTINCT
Ventas_POS.Venta_POS_ID,
Ventas_POS.Folio_Ticket,
Ventas_POS.FolioSucursal,
Ventas_POS.Fk_Caja,
Ventas_POS.Identificador_tipo,
Ventas_POS.Fecha_venta, 
Ventas_POS.Total_Venta,
Ventas_POS.Importe,
Ventas_POS.Total_VentaG,
Ventas_POS.FormaDePago,
Ventas_POS.Turno,
Ventas_POS.FolioSignoVital,
Ventas_POS.Cliente,
Cajas_POS.ID_Caja,
Cajas_POS.Sucursal,
Cajas_POS.MedicoEnturno,
Cajas_POS.EnfermeroEnturno,
Ventas_POS.Cod_Barra,
Ventas_POS.Clave_adicional,
Ventas_POS.Nombre_Prod,
Ventas_POS.Cantidad_Venta,
Ventas_POS.Fk_sucursal,
Ventas_POS.AgregadoPor,
Ventas_POS.AgregadoEl,
Ventas_POS.Lote,
Ventas_POS.ID_H_O_D,
SucursalesCorre.ID_SucursalC, 
SucursalesCorre.Nombre_Sucursal,
Servicios_POS.Servicio_ID,
Servicios_POS.Nom_Serv,
Ventas_POS.DescuentoAplicado, -- Agregamos la columna DescuentoAplicado
Stock_POS.ID_Prod_POS,
Stock_POS.Precio_Venta,
Stock_POS.Precio_C
FROM 
Ventas_POS
INNER JOIN 
SucursalesCorre ON Ventas_POS.Fk_sucursal = SucursalesCorre.ID_SucursalC 
INNER JOIN 
Servicios_POS ON Ventas_POS.Identificador_tipo = Servicios_POS.Servicio_ID 
INNER JOIN 
Cajas_POS ON Cajas_POS.ID_Caja = Ventas_POS.Fk_Caja
INNER JOIN 
Stock_POS ON Stock_POS.ID_Prod_POS = Ventas_POS.ID_Prod_POS
WHERE 
Ventas_POS.Fecha_venta BETWEEN '$mes' AND '$anual'";

// Ejecutar la consulta
$resultado = $conn->query($query);

if (!$resultado) {
    die("Error en la consulta SQL: " . $conn->error);
}

// Crear un nuevo archivo CSV
$filename = 'registro_de_ventas_del_' . str_replace('-', '_', $mes) . '_al_' . str_replace('-', '_', $anual) . '.csv';
$output = fopen('php://output', 'w');

// Escribir la BOM para forzar la codificación UTF-8
fwrite($output, "\xEF\xBB\xBF");

$header = [
    "Cod_Barra",
    "Nombre_Prod",
    "PrecioCompra",
    "PrecioVenta",
    "FolioTicket",
    "Sucursal",
    "Turno",
    "Cantidad_Venta",
    "Importe",
    "Total_Venta",
    "Descuento",
    "FormaPago",
    "Cliente",
    "FolioSignoVital",
    "NomServ",
    "AgregadoEl",
    "AgregadoEnMomento",
    "AgregadoPor",
    "Enfermero",
    "Doctor"
];
fputcsv($output, $header);

// Escribir los datos en el archivo CSV
while ($row = $resultado->fetch_assoc()) {
    $data = [
        $row["Cod_Barra"],
        $row["Nombre_Prod"],
        $row["Precio_C"],
        $row["Precio_Venta"],
        $row["FolioSucursal"] . ' ' . $row["Folio_Ticket"],
        $row["Nombre_Sucursal"],
        $row["Turno"],
        $row["Cantidad_Venta"],
        $row["Importe"],
        $row["Total_Venta"],
        $row["DescuentoAplicado"],
        $row["FormaDePago"],
        $row["Cliente"],
        $row["FolioSignoVital"],
        $row["Nom_Serv"],
        date("d/m/Y", strtotime($row["Fecha_venta"])),
        $row["AgregadoEl"],
        $row["AgregadoPor"],
        $row["EnfermeroEnturno"],
        $row["MedicoEnturno"]
    ];
    fputcsv($output, $data);
}

// Cerrar el archivo CSV
fclose($output);

// Descargar el archivo CSV
header('Content-Type: text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Pragma: no-cache');
header('Expires: 0');
readfile($filename);
exit;
?>
