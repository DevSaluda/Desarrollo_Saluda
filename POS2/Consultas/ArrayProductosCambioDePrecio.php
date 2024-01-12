
<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";
include "Sesion.php";
include "mcript.php";

$sql = "SELECT ID_Notificacion,Encabezado, Tipo_Notificacion, Mensaje_Notificacion,
 Registrado, Sucursal, Estado FROM Area_De_Notificaciones WHERE Sucursal=".$row['Fk_Sucursal']." AND Estado=1";
 
$result = mysqli_query($conn, $sql);
 
$c=0;
 
while($fila=$result->fetch_assoc()){
 
    $data[$c]["IDNotificacion"] = $fila["ID_Notificacion"];
    $data[$c]["Encabezado"] = $fila["Encabezado"];
    $data[$c]["TipoNotificacion"] = $fila["Tipo_Notificacion"];
    $data[$c]["MensajeNotificacion"] = $fila["Mensaje_Notificacion"];
    
    $c++; 
 
}
 
$results = ["sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data ];
 
echo json_encode($results);
?>
