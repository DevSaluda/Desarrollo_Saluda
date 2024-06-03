<?php
require '../vendor/autoload.php';

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

// Establecer las cabeceras HTTP para un archivo CSV
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="registro_de_ventas_del_' . str_replace('-', '_', $mes) . '_al_' . str_replace('-', '_', $anual) . '.csv"');
header('Cache-Control: max-age=0');

// Abrir el puntero de archivo de salida
$output = fopen('php://output', 'w');

// Escribir los encabezados del archivo CSV
$encabezados = ["Cod_Barra", "Nombre_Prod", "PrecioCompra", "PrecioVenta", "FolioTicket", "Sucursal", "Turno", "Cantidad_Venta", "Total_Venta", "Importe", "Descuento", "FormaPago", "Cliente", "FolioSignoVital", "NomServ", "AgregadoEl", "AgregadoEnMomento", "AgregadoPor", "Enfermero", "Doctor"];
fputcsv($output, $encabezados);

// Escribir los datos del archivo CSV
while ($row = $resultado->fetch_assoc()) {
    fputcsv($output, $row);
}

// Cerrar el puntero de archivo de salida
fclose($output);

// Limpiar el buffer de salida y enviar al navegador
ob_end_flush();
?>
