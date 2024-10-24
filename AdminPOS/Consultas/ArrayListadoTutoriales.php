
<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";



$sql = "SELECT tutoriales_vistos.id,tutoriales_vistos.nombre,tutoriales_vistos.sucursal,tutoriales_vistos.tutorial,
tutoriales_vistos.fecha_visto, SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM
tutoriales_vistos,SucursalesCorre WHERE tutoriales_vistos.sucursal = SucursalesCorre.ID_SucursalC;";
 
$result = mysqli_query($conn, $sql);
 
$c=0;
 
while($fila=$result->fetch_assoc()){
 
 $data[$c]["Folio"] = $fila["id"];
 $data[$c]["Nombre_Paciente"] = $fila["nombre"];
$data[$c]["Edad"] = $fila["Nombre_Sucursal"];
 $data[$c]["Sexo"] = $fila["Tutorial"];
 $data[$c]["Fecha_Nacimiento"] = $fila["fecha_visto"];
   

    
    
    $c++; 
 
}
 
$results = ["sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data ];
 
echo json_encode($results);
?>
