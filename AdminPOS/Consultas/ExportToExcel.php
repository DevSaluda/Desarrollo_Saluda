<?php
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

$query = "SELECT DISTINCT
Ventas_POS.Cod_Barra,
Ventas_POS.Nombre_Prod,
Stock_POS.Precio_C AS PrecioCompra,
Stock_POS.Precio_Venta AS PrecioVenta
CONCAT(Ventas_POS.FolioSucursal, Ventas_POS.Folio_Ticket) AS FolioTicket,
SucursalesCorre.Nombre_Sucursal AS Sucursal,
Ventas_POS.Turno,
Ventas_POS.Cantidad_Venta,
Ventas_POS.Importe,
Ventas_POS.Total_Venta,
Ventas_POS.DescuentoAplicado AS Descuento,
CONVERT(Ventas_POS.FormaDePago USING utf8) AS FormaPago,
CONVERT(Ventas_POS.Cliente USING utf8) AS Cliente,
Ventas_POS.FolioSignoVital,
Servicios_POS.Nom_Serv AS NomServ,
Ventas_POS.Fecha_venta AS AgregadoEl,
Ventas_POS.AgregadoEl AS AgregadoEnMomento,
Ventas_POS.AgregadoPor,
CONVERT(Cajas_POS.EnfermeroEnturno USING utf8) AS Enfermero,
CONVERT(Cajas_POS.MedicoEnturno USING utf8) AS Doctor
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

// Establecer las cabeceras HTTP para un archivo CSV
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="registro_de_ventas_del_' . str_replace('-', '_', $mes) . '_al_' . str_replace('-', '_', $anual) . '.csv"');
header('Cache-Control: max-age=0');

// Abrir el puntero de archivo de salida
$output = fopen('php://output', 'w');

// Escribir los encabezados en el archivo CSV
$encabezados = ["Codigo de Barras", "Nombre del Producto", "# de Ticket", "Sucursal", "Turno", "Cantidad", "P.U", "Importe", "Descuento", "Forma de Pago", "Cliente", "FolioSignoVital", "Servicio", "Fecha de venta", "Fecha y hora", "Vendedor", "Enfermero", "Doctor","PrecioCompra", "PrecioVenta" ];
fputcsv($output, $encabezados);

// Escribir los datos del archivo CSV
while ($fila = $resultado->fetch_assoc()) {
    // Convertir los caracteres HTML codificados a UTF-8
    array_walk($fila, function (&$value) {
        $value = utf8_decode($value);
    });

       // Formatear la fecha en 'dd/mm/yyyy'
       $date = new DateTime($fila["AgregadoEl"]);
       $formattedDate = $date->format('d/m/Y');
   
    // Construir una fila con los datos específicos
    $data = [
        $fila["Cod_Barra"],
        $fila["Nombre_Prod"],
      
        $fila["FolioTicket"],
        $fila["Sucursal"],
        $fila["Turno"],
        $fila["Cantidad_Venta"],
       
        $fila["Total_Venta"],
        $fila["Importe"],
        $fila["Descuento"],
        $fila["FormaPago"],
        $fila["Cliente"],
        $fila["FolioSignoVital"],
        $fila["NomServ"],
        $formattedDate,
        $fila["AgregadoEnMomento"],
        $fila["AgregadoPor"],
        $fila["Enfermero"],
        $fila["Doctor"],
        $fila["PrecioCompra"],
        $fila["PrecioVenta"],
        $fila["Proveedor1"],
        $fila["Proveedor2"],
    ];
    // Escribir la fila en el archivo CSV
    fputcsv($output, $data);
}

// Cerrar el puntero de archivo de salida
fclose($output);

// Limpiar el buffer de salida y enviar al navegador
ob_end_flush();
?>
