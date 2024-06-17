
<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";
include "Sesion.php";


$sql = "SELECT Ventas_POS_Sincronizacion.Folio_Ticket,Ventas_POS_Sincronizacion.Fk_Caja,Ventas_POS_Sincronizacion.Venta_POS_ID,Ventas_POS_Sincronizacion.Identificador_tipo,
Ventas_POS_Sincronizacion.Total_Venta,Ventas_POS_Sincronizacion.Importe,Ventas_POS_Sincronizacion.Total_VentaG,Ventas_POS_Sincronizacion.FormaDePago,Ventas_POS_Sincronizacion.Turno,
Ventas_POS_Sincronizacion.Cod_Barra,Ventas_POS_Sincronizacion.Clave_adicional, Ventas_POS_Sincronizacion.Identificador_tipo,
Ventas_POS_Sincronizacion.Nombre_Prod,Ventas_POS_Sincronizacion.Cantidad_Venta,Ventas_POS_Sincronizacion.Fk_sucursal,Ventas_POS_Sincronizacion.AgregadoPor,
Ventas_POS_Sincronizacion.AgregadoEl, Ventas_POS_Sincronizacion.Total_Venta,Ventas_POS_Sincronizacion.Lote,Ventas_POS_Sincronizacion.ID_H_O_D,SucursalesCorre.ID_SucursalC,
SucursalesCorre.Nombre_Sucursal,Servicios_POS.Servicio_ID,Servicios_POS.Nom_Serv FROM Ventas_POS_Sincronizacion,SucursalesCorre,Servicios_POS 
 WHERE DATE(Ventas_POS_Sincronizacion.AgregadoEl) = DATE_FORMAT(CURDATE(),'%Y-%m-%d') AND Ventas_POS_Sincronizacion.Fk_sucursal= SucursalesCorre.ID_SucursalC AND  Ventas_POS_Sincronizacion.Identificador_tipo = Servicios_POS.Servicio_ID";
 
$result = mysqli_query($conn, $sql);
 
$c=0;
 
while($fila=$result->fetch_assoc()){
 
    $data[$c]["Cod_Barra"] = $fila["Cod_Barra"];
    $data[$c]["Nombre_Prod"] = $fila["Nombre_Prod"];

    $data[$c]["Folio_Ticket"] = $fila["Folio_Ticket"];
    $data[$c]["Turno"] = $fila["Turno"];
    $data[$c]["Cantidad_Venta"] = $fila["Cantidad_Venta"];
    $data[$c]["Total_Venta"] = $fila["Total_Venta"];
    $data[$c]["Importe"] = $fila["Importe"];
    $data[$c]["DescuentoAplicado"] = $fila["DescuentoAplicado"];
    $data[$c]["FormaDePago"] = $fila["FormaDePago"];
    $data[$c]["Nom_Serv"] = $fila["Nom_Serv"];
    $data[$c]["AgregadoEl"] =$fila["AgregadoEl"];
  
    $data[$c]["AgregadoPor"] = $fila["AgregadoPor"];

    
    
    $c++;
 
}
 
$results = ["sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data ];
 
echo json_encode($results);
?>
