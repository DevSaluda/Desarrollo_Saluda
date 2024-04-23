<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";


$sql = "SELECT Productos_POS.ID_Prod_POS,Productos_POS.Nombre_Prod,Productos_POS.Cod_Barra,Productos_POS.Cod_Enfermeria,Productos_POS.Proveedor1,Productos_POS.Proveedor2,
Productos_POS.ID_H_O_D,Productos_POS.Clave_adicional,Productos_POS.Clave_Levic,Productos_POS.FkMarca,Productos_POS.FkCategoria,Productos_POS.FkPresentacion,Productos_POS.Tipo,
Productos_POS.Precio_Venta,Productos_POS.Precio_C,Productos_POS.Stock,Productos_POS.Saldo,Productos_POS.AgregadoPor,Productos_POS.Vendido,Productos_POS.Tipo_Servicio,
Servicios_POS.Servicio_ID,Servicios_POS.Nom_Serv,Productos_POS.AgregadoEl FROM Productos_POS,Servicios_POS where 
Servicios_POS.Servicio_ID = Productos_POS.Tipo_Servicio  AND Productos_POS.ID_H_O_D ='".$row['ID_H_O_D']."'";
 
$result = mysqli_query($conn, $sql);
 
$c=0;
 
while($fila=$result->fetch_assoc()){
    $data[$c]["IdbD"] = $fila["Cod_Barra"];
    $data[$c]["Cod_Barra"] = $fila["Nombre_prod"];
    $data[$c]["Nombre_Prod"] = $fila["Cantidad_Ajuste"];
    $data[$c]["Clave_interna"] = $fila["Nombre_Sucursal"];
    $data[$c]["Clave_Levic"] = $fila["Tipo_ajuste"];
    $data[$c]["Cod_Enfermeria"] = $fila["Agrego"];
   
   
   
    $c++; 
 
}
 
$results = ["sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data ];
 
echo json_encode($results);
?>
