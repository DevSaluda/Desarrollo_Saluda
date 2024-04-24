
<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";


$sql = "SELECT AjustesDeInventarios.Folio_Ingreso,AjustesDeInventarios.ID_Prod_POS,AjustesDeInventarios.Fk_sucursal,AjustesDeInventarios.Existencias_R, 
AjustesDeInventarios.ExistenciaPrev,AjustesDeInventarios.Recibido,AjustesDeInventarios.AgregadoPor,AjustesDeInventarios.AgregadoEl, 
Productos_POS.ID_Prod_POS,Productos_POS.Cod_Barra,Productos_POS.Nombre_Prod,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal 
FROM AjustesDeInventarios,Productos_POS,SucursalesCorre WHERE AjustesDeInventarios.ID_Prod_POS = Productos_POS.ID_Prod_POS AND AjustesDeInventarios.Fk_sucursal = SucursalesCorre.ID_SucursalC AND 
AjustesDeInventarios.Fk_sucursal='".$row['Fk_Sucursal']."'";
 
$result = mysqli_query($conn, $sql);
 
$c=0;
 
while($fila=$result->fetch_assoc()){
 
    $data[$c]["FolioAjuste"] = $fila["Folio_Ingreso"];
    $data[$c]["Nombre_Prod"] = $fila["Nombre_Prod"];
    $data[$c]["Cod_Barra"] = $fila["Cod_Barra"];
    $data[$c]["Sucursal"] = $fila["Nombre_Sucursal"];
    $data[$c]["ExistenciaPrev"] = $fila["ExistenciaPrev"];
    $data[$c]["Recibido"] = $fila["Recibido"];
    $data[$c]["Existencias_R"] = $fila["Existencias_R"];
    $data[$c]["FechaAjuste"] = $fila["AgregadoEl"];
    
    
    $c++; 
 
}
 
$results = ["sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data ];
 
echo json_encode($results);
?>
