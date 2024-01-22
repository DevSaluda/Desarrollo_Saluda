<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";
include "Sesion.php";
include "mcript.php";


//user_id=null;
$sql1="SELECT 
AgendaCitas_EspecialistasExt.ID_Agenda_Especialista,
AgendaCitas_EspecialistasExt.Fk_Especialidad,
AgendaCitas_EspecialistasExt.Fk_Especialista,
AgendaCitas_EspecialistasExt.Fk_Sucursal,
AgendaCitas_EspecialistasExt.Fecha,AgendaCitas_EspecialistasExt.Hora,
AgendaCitas_EspecialistasExt.Nombre_Paciente,
AgendaCitas_EspecialistasExt.Telefono,
AgendaCitas_EspecialistasExt.Observaciones,
AgendaCitas_EspecialistasExt.ID_H_O_D,
Especialidades_Express.ID_Especialidad,
Especialidades_Express.Nombre_Especialidad,Personal_Medico_Express.Medico_ID,
Personal_Medico_Express.Nombre_Apellidos, 
Fechas_EspecialistasExt.ID_Fecha_Esp,
Fechas_EspecialistasExt.Fecha_Disponibilidad, 
Horarios_Citas_Ext.ID_Horario,
Horarios_Citas_Ext.Horario_Disponibilidad,
SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal 
FROM
AgendaCitas_EspecialistasExt,Especialidades_Express,
Personal_Medico_Express,Fechas_EspecialistasExt,
Horarios_Citas_Ext,SucursalesCorre 
WHERE
AgendaCitas_EspecialistasExt.Fk_Especialidad = Especialidades_Express.ID_Especialidad AND AgendaCitas_EspecialistasExt.Fk_Especialista = Personal_Medico_Express.Medico_ID 
 AND AgendaCitas_EspecialistasExt.Fk_Sucursal = SucursalesCorre.ID_SucursalC AND AgendaCitas_EspecialistasExt.Fecha =Fechas_EspecialistasExt.ID_Fecha_Esp AND 
 AgendaCitas_EspecialistasExt.Hora = Horarios_Citas_Ext.ID_Horario AND AgendaCitas_EspecialistasExt.Fk_Sucursal='".$row['Fk_Sucursal']."' AND 
AgendaCitas_EspecialistasExt.ID_H_O_D ='".$row['ID_H_O_D']."'";

$query = $conn->query($sql1);


$result = mysqli_query($conn, $sql1);
$data = array();
$contador = 0;

while($fila = $result->fetch_assoc()) {

    $data[$contador]["IdAgenda"] = $fila["ID_Agenda_Especialista"];
    $data[$contador]["Paciente"] = $fila["Nombre_Paciente"];
    $data[$contador]["Telefono"] = $fila["Telefono"];
    $data[$contador]["fecha"]    = $fila["Fecha_Disponibilidad"];
    $data[$contador]["horario"]  = $fila["Horario_Disponibilidad"];
    $data[$contador]["nombreApellidos"] = $fila["Nombre_Apellidos"];
    $data[$contador]["sucursal"] = $fila["Nombre_Sucursal"];
    $data[$contador]["observaciones"] = $fila["Observaciones"];

    $contador++; 
}

$results = ["sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data 
        ];
 
echo json_encode($results);
?>
