<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";
include "Sesion.php";
include "mcript.php";

$sql1="SELECT Agenda_revaloraciones.Id_genda,
              Agenda_revaloraciones.Nombres_Apellidos,
              Agenda_revaloraciones.Telefono,
              Agenda_revaloraciones.Fk_sucursal,
              Agenda_revaloraciones.Medico,
              Agenda_revaloraciones.Fecha,
              Agenda_revaloraciones.Turno,Agenda_revaloraciones.Motivo_Consulta,
              Agenda_revaloraciones.Agrego,Agenda_revaloraciones.AgregadoEl, 
              SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal 
        FROM
              Agenda_revaloraciones, 
              SucursalesCorre
        WHERE SucursalesCorre.ID_SucursalC = Agenda_revaloraciones.Fk_sucursal 
        AND Agenda_revaloraciones.Fk_Sucursal='".$row['Fk_Sucursal']."'";

$result = mysqli_query($conn, $sql1);
$data = array();



$c=0;
 
while($fila=$result->fetch_assoc()){
 
    $data[$c]["Folio"] = $fila["Id_genda"];
    $data[$c]["Nombre"] = $fila["Nombres_Apellidos"];
    $data[$c]["Edad"] = $fila["Telefono"];
    $data[$c]["Sexo"] = $fila["Fecha"];
    $data[$c]["sucursal"] = $fila["Nombre_Sucursal"];
    $data[$c]["medico"] = $fila["Medico"];
    $data[$c]["turno"] = $fila["Turno"];
    $data[$c]["motivo"] = $fila["Motivo_Consulta"];
    $c++; 
 
}

$results = ["sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data ];
 
echo json_encode($results);
?>
