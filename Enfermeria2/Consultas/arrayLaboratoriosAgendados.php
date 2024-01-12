
<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";
include "Sesion.php";


$sql = "SELECT Agenda_Labs.Id_genda,
               Agenda_Labs.Nombres_Apellidos,
               Agenda_Labs.Telefono,
               Agenda_Labs.Fk_sucursal,
               Agenda_Labs.Turno,
               Agenda_Labs.Fecha,
               Agenda_Labs.LabAgendado,
               Agenda_Labs.Agrego,
               Agenda_Labs.Indicaciones,
               Agenda_Labs.AgregadoEl
               SucursalesCorre.ID_SucursalC,
               SucursalesCorre.Nombre_Sucursal 
        FROM
               Agenda_Labs,
               SucursalesCorre
        WHERE
               SucursalesCorre.ID_SucursalC = Agenda_revaloraciones.Fk_sucursal AND Agenda_revaloraciones.Fk_Sucursal='".$row['Fk_Sucursal']."'";
 
$result = mysqli_query($conn, $sql);
 
$c=0;
 
while($fila=$result->fetch_assoc()){
 
    $data[$c]["Folio"] = $fila["Id_genda"];
    $data[$c]["Nombre"] = $fila["Nombres_Apellidos"];
    $data[$c]["Telefono"] = $fila["Telefono"];
    $data[$c]["Sucursal"] = $fila["Fk_sucursal"];
    $data[$c]["Turno"] = $fila["Turno"];
    $data[$c]["Fecha"] = $fila["Fecha"];
    $data[$c]["laboratorio"] = $fila["LabAgendado"];
    $data[$c]["agrego"] = $fila["Agrego"];
    $data[$c]["Agrego2"] = $fila["AgregadoEl"];
    $data[$c]["Indicaciones"] = $fila["Indicaciones"];

    $c++; 
 
}
 
$results = ["sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data ];
 
echo json_encode($results);
?>