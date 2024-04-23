<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";


$sql = "SELECT Inserciones_Excel_inventarios.Id_Insert, Inserciones_Excel_inventarios.Cod_Barra, Inserciones_Excel_inventarios.Nombre_prod, Inserciones_Excel_inventarios.Cantidad_Ajuste, Inserciones_Excel_inventarios.Sucursal, Inserciones_Excel_inventarios.Tipo_ajuste, Inserciones_Excel_inventarios.Agrego, Inserciones_Excel_inventarios.Fecha_registro,
SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM Inserciones_Excel_inventarios, SucursalesCorre WHERE Inserciones_Excel_inventarios.Sucursal = SucursalesCorre.ID_SucursalC";
 
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
