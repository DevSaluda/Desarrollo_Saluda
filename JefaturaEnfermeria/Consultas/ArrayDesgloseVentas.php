
<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";


$sql = "
SELECT 
    Ventas_POS.Folio_Ticket,
    Ventas_POS.FolioSucursal,
    Ventas_POS.Fk_Caja,
    Ventas_POS.Venta_POS_ID,
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
    Ventas_POS.Identificador_tipo,
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
    Ventas_POS.DescuentoAplicado
FROM 
    Ventas_POS
JOIN 
    SucursalesCorre ON Ventas_POS.Fk_sucursal = SucursalesCorre.ID_SucursalC 
JOIN 
    Servicios_POS ON Ventas_POS.Identificador_tipo = Servicios_POS.Servicio_ID 
JOIN 
    Cajas_POS ON Cajas_POS.ID_Caja = Ventas_POS.Fk_Caja
WHERE 
    (
        (
            Ventas_POS.Fecha_venta >= DATE_FORMAT(NOW(), '%Y-%m-01') -- Primer día del mes en curso
            AND Ventas_POS.Fecha_venta <= LAST_DAY(NOW()) -- Último día del mes en curso
        )
        OR
        (
            Ventas_POS.Fecha_venta >= DATE_FORMAT(NOW() - INTERVAL 1 MONTH, '%Y-%m-01') -- Primer día del mes anterior
            AND Ventas_POS.Fecha_venta <= LAST_DAY(NOW() - INTERVAL 1 MONTH) -- Último día del mes anterior
        )
    )
    AND Ventas_POS.Fk_sucursal = '" . $row['Fk_Sucursal'] . "'
    AND Ventas_POS.ID_H_O_D = '" . $row['ID_H_O_D'] . "'
    AND Ventas_POS.Identificador_tipo = Servicios_POS.Servicio_ID
GROUP BY
    Ventas_POS.Folio_Ticket
ORDER BY
    Ventas_POS.AgregadoEl DESC;

";



$result = mysqli_query($conn, $sql);

 
$c=0;
 
while($fila=$result->fetch_assoc()){
 
    $data[$c]["Cod_Barra"] = $fila["Cod_Barra"];
    $data[$c]["Nombre_Prod"] = $fila["Nombre_Prod"];
    $data[$c]["FolioTicket"] = $fila["FolioSucursal"] . '' . $fila["Folio_Ticket"];
    $data[$c]["Sucursal"] = $fila["Nombre_Sucursal"];
    $data[$c]["Turno"] = $fila["Turno"];
    $data[$c]["Cantidad_Venta"] = $fila["Cantidad_Venta"];
    $data[$c]["Importe"] = $fila["Importe"];
    $data[$c]["Total_Venta"] = $fila["Total_Venta"];
    $data[$c]["Descuento"] = $fila["DescuentoAplicado"];
    $data[$c]["FormaPago"] = $fila["FormaDePago"];
    $data[$c]["Cliente"] = $fila["Cliente"];
    $data[$c]["FolioSignoVital"] = $fila["FolioSignoVital"];
    $data[$c]["NomServ"] = $fila["Nom_Serv"];
    $data[$c]["AgregadoEl"] = date("d/m/Y", strtotime($fila["Fecha_venta"]));
    $data[$c]["AgregadoEnMomento"] = $fila["AgregadoEl"];
    $data[$c]["AgregadoPor"] = $fila["AgregadoPor"];
    $data[$c]["Enfermero"] = $fila["EnfermeroEnturno"];
    $data[$c]["Doctor"] = $fila["MedicoEnturno"];
    $c++; 
 
}
 
$results = ["sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data ];
 
echo json_encode($results);
?>
