<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";

include "mcript.php";


$sql1="SELECT 
Cancelaciones_Ext.ID_CancelacionExt,Cancelaciones_Ext.ID_Agenda_Especialista,
Cancelaciones_Ext.Fk_Especialidad,
Cancelaciones_Ext.Fk_Especialista,
Cancelaciones_Ext.Fk_Sucursal,
Cancelaciones_Ext.Fecha,
Cancelaciones_Ext.Hora,
Cancelaciones_Ext.Nombre_Paciente,Cancelaciones_Ext.ID_H_O_D,
Especialidades_Express.ID_Especialidad,
Especialidades_Express.Nombre_Especialidad,
Personal_Medico_Express.Medico_ID,
Personal_Medico_Express.Nombre_Apellidos,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal,
Fechas_EspecialistasExt.ID_Fecha_Esp,
Fechas_EspecialistasExt.Fecha_Disponibilidad, Horarios_Citas_Ext.ID_Horario,
Horarios_Citas_Ext.Horario_Disponibilidad 
FROM
Cancelaciones_Ext,Personal_Medico_Express,Especialidades_Express,SucursalesCorre,Horarios_Citas_Ext,Fechas_EspecialistasExt
 where
Cancelaciones_Ext.Fk_Especialidad = Especialidades_Express.ID_Especialidad AND Cancelaciones_Ext.Fk_Especialista = Personal_Medico_Express.Medico_ID AND 
Cancelaciones_Ext.Fk_Sucursal=SucursalesCorre.ID_SucursalC AND Cancelaciones_Ext.Fecha = Fechas_EspecialistasExt.ID_Fecha_Esp AND Cancelaciones_Ext.Hora = Horarios_Citas_Ext.ID_Horario AND Cancelaciones_Ext.Fk_Sucursal='".$row['Fk_Sucursal']."' 
AND Cancelaciones_Ext.ID_H_O_D ='".$row['ID_H_O_D']."'";

function fechaCastellano ($fecha) {
    $fecha = substr($fecha, 0, 10);
    $numeroDia = date('d', strtotime($fecha));
    $dia = date('l', strtotime($fecha));
    $mes = date('F', strtotime($fecha));
    $anio = date('Y', strtotime($fecha));
    $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
    $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
    $nombredia = str_replace($dias_EN, $dias_ES, $dia);
  $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
    return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
  }

$result = mysqli_query($conn, $sql1);
$c = 0;

while($fila=$result->fetch_assoc()){
 
    $data[$c]["Folio"] = $fila["ID_Agenda_Especialista"];
    $data[$c]["Nombre"] = $fila["Nombre_Paciente"];
    $data[$c]["Fecha"] = fechaCastellano($fila["Fecha_Disponibilidad"]);
    $data[$c]["hora"] = date('h:i A', strtotime($fila["Horario_Disponibilidad"])); 
    $data[$c]["especialidad"] = $fila["Nombre_Especialidad"];
    $data[$c]["nombreApellidos"] = $fila["Nombre_Apellidos"];
    $data[$c]["sucursal"] = $fila["Nombre_Sucursal"];
    $data[$c]["observaciones"] = $fila["Observaciones"];
    //$data[$c]["codigoBoton"] = '<td><button" type="button" class="btn-edit btn btn-success"> Cancelado</button></td>'; 
 
}

$results = ["sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data ];
 
echo json_encode($results);
?>
