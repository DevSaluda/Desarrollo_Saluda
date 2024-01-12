
<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";
include "Sesion.php";
include "mcript.php";

$sql = "SELECT ConteosDiarios.Cod_Barra,ConteosDiarios.Nombre_Producto,ConteosDiarios.Fk_sucursal,ConteosDiarios.Existencias_R, 
ConteosDiarios.ExistenciaFisica,ConteosDiarios.AgregadoPor,ConteosDiarios.AgregadoEl,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal,
 Stock_POS.Cod_Barra,Stock_POS.Fk_sucursal,Stock_POS.Existencias_R as ExistenciaNube FROM ConteosDiarios,SucursalesCorre,Stock_POS WHERE 
 ConteosDiarios.Fk_sucursal = SucursalesCorre.ID_SucursalC and ConteosDiarios.Cod_Barra = Stock_POS.Cod_Barra and 
 ConteosDiarios.Fk_sucursal = Stock_POS.Fk_sucursal AND ConteosDiarios.Fk_sucursal='".$row['Fk_Sucursal']."'";
 
$result = mysqli_query($conn, $sql);
 
$c=0;
 
while($fila=$result->fetch_assoc()){
 
    $data[$c]["Cod_Barra"] = $fila["Cod_Barra"];
    $data[$c]["Nombre_Prod"] = $fila["Nombre_Producto"];
    $data[$c]["Sucursal"] = $fila["Nombre_Sucursal"];
    $data[$c]["Existencias_R"] = $fila["Existencias_R"];
    $data[$c]["Existencias_F"] = $fila["ExistenciaFisica"];

    $data[$c]["Agrego"] = $fila["AgregadoPor"];
    $data[$c]["FechaAgrega"] = $fila["AgregadoEl"];
    $data[$c]["HoraAgrega"] = $fila["AgregadoEl"];
           $c++; 
 
}
 
$results = ["sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data ];
 
echo json_encode($results);
?>
