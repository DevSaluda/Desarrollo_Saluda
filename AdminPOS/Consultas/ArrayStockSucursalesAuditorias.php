
<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";


$sql = "SELECT 
    Stock_POS_Audita.Folio_Prod_Stock,
    Stock_POS_Audita.Clave_adicional,
    Stock_POS_Audita.ID_Prod_POS,
    Stock_POS_Audita.AgregadoEl,
    Stock_POS_Audita.Clave_adicional,
    Stock_POS_Audita.Clave_Levic,
    Stock_POS_Audita.Cod_Barra,
    Stock_POS_Audita.Nombre_Prod,
    Stock_POS_Audita.Tipo_Servicio,
    Stock_POS_Audita.Tipo,
    Stock_POS_Audita.Fk_sucursal,
    Stock_POS_Audita.Max_Existencia,
    Stock_POS_Audita.Min_Existencia, 
    Stock_POS_Audita.Existencias_R,
    Stock_POS_Audita.Proveedor1,
    Stock_POS_Audita.Proveedor2,
    Stock_POS_Audita.CodigoEstatus,
    Stock_POS_Audita.Estatus,
    Stock_POS_Audita.ID_H_O_D, 
    SucursalesCorre.ID_SucursalC,
    SucursalesCorre.Nombre_Sucursal,
    Servicios_POS.Servicio_ID,
    Servicios_POS.Nom_Serv, 
    Productos_POS.ID_Prod_POS,
    Productos_POS.Precio_Venta,
    Productos_POS.Precio_C 
FROM 
    Stock_POS_Audita,
    SucursalesCorre,
    Servicios_POS,
    Productos_POS 
WHERE 
    Stock_POS_Audita.Fk_Sucursal = SucursalesCorre.ID_SucursalC 
    AND Stock_POS_Audita.Tipo_Servicio = Servicios_POS.Servicio_ID 
    AND Productos_POS.ID_Prod_POS = Stock_POS_Audita.ID_Prod_POS 
    AND Stock_POS_Audita.ID_H_O_D = '".$row['ID_H_O_D']."' 
    AND Stock_POS_Audita.Fk_Sucursal = '".$row['Fk_Sucursal']."'
    AND MONTH(Stock_POS_Audita.AgregadoEl) = MONTH(CURDATE())
    AND YEAR(Stock_POS_Audita.AgregadoEl) = YEAR(CURDATE())";
 
$result = mysqli_query($conn, $sql);
 
$c=0;
 
while($fila=$result->fetch_assoc()){
 
    $data[$c]["Cod_Barra"] = $fila["Cod_Barra"];
    $data[$c]["Nombre_Prod"] = $fila["Nombre_Prod"];
    $data[$c]["Precio_Venta"] = $fila["Precio_Venta"];
    $data[$c]["Nom_Serv"] = $fila["Nom_Serv"];
    $data[$c]["Tipo"] = $fila["Tipo"];
    $data[$c]["Proveedor1"] = $fila["Proveedor1"];
    $data[$c]["Proveedor2"] = $fila["Proveedor2"];
    $data[$c]["Sucursal"] = $fila["Nombre_Sucursal"];
    $data[$c]["UltimoMovimiento"] = $fila["AgregadoEl"];
    $data[$c]["Existencias_R"] = $fila["Existencias_R"];
    
    $data[$c]["Min_Existencia"] = $fila["Min_Existencia"];
    $data[$c]["Max_Existencia"] = $fila["Max_Existencia"];
   

    $data[$c]["Coincidencias"] = ["<a  href=https://saludapos.com/AdminPOS/CoincidenciaSucursales?Disid=".base64_encode($fila["ID_Prod_POS"])." type='button' class='btn btn-info  btn-sm '><i class='fas fa-capsules'></i></a> "];
       $data[$c]["Ingreso"] = ["<a href=https://saludapos.com/AdminPOS/ActualizaOne?idProd=".base64_encode($fila["Folio_Prod_Stock"])." type='button' class='btn btn-info  btn-sm '><i class='fas fa-capsules'></i></a> "];
       $data[$c]["Auditoria"] = ["<a href=https://saludapos.com/AdminPOS/HistorialProductoAudita?idProd=".base64_encode($fila["Cod_Barra"])." type='button' class='btn btn-primary  btn-sm '><i class='fas fa-history'></i></a> "];
    $c++; 
 
}
 
$results = ["sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data ];
 
echo json_encode($results);
?>
