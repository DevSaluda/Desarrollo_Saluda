
<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";
include "Sesion.php";
include "mcript.php";

$sql = "SELECT Stock_Enfermeria.Folio_Prod_Stock,Stock_Enfermeria.Clave_adicional,Stock_Enfermeria.ID_Prod_POS,Stock_Enfermeria.AgregadoEl,Stock_Enfermeria.Clave_adicional,
Stock_Enfermeria.Cod_Barra,Stock_Enfermeria.Nombre_Prod,Stock_Enfermeria.Tipo_Servicio,Stock_Enfermeria.Fk_sucursal,
Stock_Enfermeria.Max_Existencia,Stock_Enfermeria.Min_Existencia, Stock_Enfermeria.Existencias_R,Stock_Enfermeria.Proveedor1,
Stock_Enfermeria.Proveedor2,Stock_Enfermeria.CodigoEstatus,Stock_Enfermeria.Estatus,Stock_Enfermeria.ID_H_O_D, SucursalesCorre.ID_SucursalC,
SucursalesCorre.Nombre_Sucursal,Servicios_POS.Servicio_ID,Servicios_POS.Nom_Serv, Productos_POS.ID_Prod_POS,
Productos_POS.Precio_Venta,Productos_POS.Precio_C FROM Stock_Enfermeria,SucursalesCorre,Servicios_POS,Productos_POS WHERE 
Stock_Enfermeria.Fk_Sucursal = SucursalesCorre.ID_SucursalC AND Stock_Enfermeria.Tipo_Servicio= Servicios_POS.Servicio_ID AND Productos_POS.ID_Prod_POS =Stock_Enfermeria.ID_Prod_POS AND
 Stock_Enfermeria.ID_H_O_D ='".$row['ID_H_O_D']."' AND Stock_Enfermeria.Fk_Sucursal='".$row['Fk_Sucursal']."'";
 
$result = mysqli_query($conn, $sql);
 
$c=0;
 
while($fila=$result->fetch_assoc()){
 
    $data[$c]["Cod_Barra"] = $fila["Cod_Barra"];
    $data[$c]["Clave_adicional"] = $fila["Clave_adicional"];
    $data[$c]["Clave_Levic"] = $fila["Clave_Levic"];
    $data[$c]["Nombre_Prod"] = $fila["Nombre_Prod"];
    $data[$c]["Precio_Venta"] = $fila["Precio_Venta"];
    $data[$c]["Nom_Serv"] = $fila["Nom_Serv"];
   
    $data[$c]["Sucursal"] = $fila["Nombre_Sucursal"];
    $data[$c]["UltimoMovimiento"] = $fila["AgregadoEl"];
    $data[$c]["Existencias_R"] = $fila["Existencias_R"];
    
    $data[$c]["Min_Existencia"] = $fila["Min_Existencia"];
    $data[$c]["Max_Existencia"] = $fila["Max_Existencia"];
   
    
       $data[$c]["Ingreso"] = ["<a href=https://saludapos.com/AdminPOS/ActualizaOne?idProd=".base64_encode($fila["Folio_Prod_Stock"])." type='button' class='btn btn-info  btn-sm '><i class='fas fa-capsules'></i></a> "];
       $data[$c]["Auditoria"] = ["<a href=https://saludapos.com/AdminPOS/HistorialProductoAudita?idProd=".base64_encode($fila["Folio_Prod_Stock"])." type='button' class='btn btn-primary  btn-sm '><i class='fas fa-history'></i></a> "];
    $c++; 
 
}
 
$results = ["sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data ];
 
echo json_encode($results);
?>
