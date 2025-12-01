<?php

include("db_connection.php");
include "Consultas.php";

// Obtener parámetros de fecha
$fecha_inicio = isset($_GET['fecha_inicio']) ? $_GET['fecha_inicio'] : date('Y-01-01'); // Por defecto inicio del año actual
$fecha_fin = isset($_GET['fecha_fin']) ? $_GET['fecha_fin'] : date('Y-12-31'); // Por defecto fin del año actual

// Validar y formatear fechas
$fecha_inicio = date('Y-m-d', strtotime($fecha_inicio)) . ' 00:00:00';
$fecha_fin = date('Y-m-d', strtotime($fecha_fin)) . ' 23:59:59';

$user_id=null;
// Consulta actualizada con todos los campos y filtro por rango de fechas
$sql1="SELECT 
    Signos_VitalesV2.ID_SignoV,
    Signos_VitalesV2.FolioSignoVital,
    Signos_VitalesV2.Folio_Paciente,
    Signos_VitalesV2.Nombre_Paciente,
    Signos_VitalesV2.Edad,
    Signos_VitalesV2.Sexo,
    Signos_VitalesV2.Telefono,
    Signos_VitalesV2.Correo,
    Signos_VitalesV2.Peso,
    Signos_VitalesV2.Talla,
    Signos_VitalesV2.IMC,
    Signos_VitalesV2.Estatus_IMC,
    Signos_VitalesV2.Temp,
    Signos_VitalesV2.FC,
    Signos_VitalesV2.FR,
    Signos_VitalesV2.TA,
    Signos_VitalesV2.TA2,
    Signos_VitalesV2.Sa02,
    Signos_VitalesV2.DxTx,
    Signos_VitalesV2.Motivo_Consulta,
    Signos_VitalesV2.Nombre_Doctor,
    Signos_VitalesV2.Estatus,
    Signos_VitalesV2.CodigoEstatus,
    Signos_VitalesV2.Estado,
    Signos_VitalesV2.Municipio,
    Signos_VitalesV2.Localidad,
    Signos_VitalesV2.Fecha_Visita,
    Signos_VitalesV2.Alergias,
    Signos_VitalesV2.Fk_Sucursal,
    Signos_VitalesV2.ID_TURNO,
    Signos_VitalesV2.Enterado,
    Signos_VitalesV2.Visita,
    Signos_VitalesV2.Fk_Enfermero,
    Signos_VitalesV2.FK_ID_H_O_D,
    Signos_VitalesV2.Area,
    Signos_VitalesV2.Tratamiento,
    Signos_VitalesV2.Importe,
    Signos_VitalesV2.Fk_Ticket,
    Signos_VitalesV2.Contactado,
    SucursalesCorre.ID_SucursalC,
    SucursalesCorre.Nombre_Sucursal,
    Data_Pacientes.ID_Data_Paciente,
    Data_Pacientes.Fecha_Nacimiento 
FROM Signos_VitalesV2
LEFT JOIN SucursalesCorre ON Signos_VitalesV2.Fk_Sucursal = SucursalesCorre.ID_SucursalC
LEFT JOIN Data_Pacientes ON Data_Pacientes.ID_Data_Paciente = Signos_VitalesV2.Folio_Paciente
WHERE Signos_VitalesV2.Fecha_Visita BETWEEN '$fecha_inicio' AND '$fecha_fin'
ORDER BY Signos_VitalesV2.ID_SignoV DESC";  

$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table id="SignosVitales" class="table table-striped table-bordered">
<thead>
    <th>ID</th>
    <th>Folio Signo Vital</th>
    <th>Folio Paciente</th>
    <th>Nombre</th>
    <th>Edad</th>
    <th>Sexo</th>
    <th>Teléfono</th>
    <th>Correo</th>
    <th>Peso</th>
    <th>Talla</th>
    <th>IMC</th>
    <th>Estatus IMC</th>
    <th>Temp</th>
    <th>FC</th>
    <th>FR</th>
    <th>TA</th>
    <th>TA2</th>
    <th>SaO2</th>
    <th>DxTx</th>
    <th>Motivo Consulta</th>
    <th>Doctor</th>
    <th>Estatus</th>
    <th>Estado</th>
    <th>Municipio</th>
    <th>Localidad</th>
    <th>Fecha Visita</th>
    <th>Alergias</th>
    <th>Sucursal</th>
    <th>Turno</th>
    <th>Enfermero</th>
    <th>Área</th>
    <th>Tratamiento</th>
    <th>Importe</th>
    <th>Contactado</th>
</thead>
<tbody>
<?php while ($DataPacientes=$query->fetch_array()):?>
<tr>
    <td><?php echo $DataPacientes["ID_SignoV"]; ?></td>
    <td><?php echo $DataPacientes["FolioSignoVital"]; ?></td>
    <td><?php echo $DataPacientes["Folio_Paciente"]; ?></td>
    <td><?php echo $DataPacientes["Nombre_Paciente"]; ?></td>
    <td><?php echo $DataPacientes["Edad"]; ?></td>
    <td><?php echo $DataPacientes["Sexo"]; ?></td>
    <td><?php echo $DataPacientes["Telefono"]; ?></td>
    <td><?php echo $DataPacientes["Correo"]; ?></td>
    <td><?php echo $DataPacientes["Peso"]; ?></td>
    <td><?php echo $DataPacientes["Talla"]; ?></td>
    <td><?php echo $DataPacientes["IMC"]; ?></td>
    <td><?php echo $DataPacientes["Estatus_IMC"]; ?></td>
    <td><?php echo $DataPacientes["Temp"]; ?></td>
    <td><?php echo $DataPacientes["FC"]; ?></td>
    <td><?php echo $DataPacientes["FR"]; ?></td>
    <td><?php echo $DataPacientes["TA"]; ?></td>
    <td><?php echo $DataPacientes["TA2"]; ?></td>
    <td><?php echo $DataPacientes["Sa02"]; ?></td>
    <td><?php echo $DataPacientes["DxTx"]; ?></td>
    <td><?php echo $DataPacientes["Motivo_Consulta"]; ?></td>
    <td><?php echo $DataPacientes["Nombre_Doctor"]; ?></td>
    <td><button class="btn btn-default btn-sm" style="<?php echo $DataPacientes['CodigoEstatus'];?>"><?php echo $DataPacientes["Estatus"]; ?></button></td>
    <td><?php echo $DataPacientes["Estado"]; ?></td>
    <td><?php echo $DataPacientes["Municipio"]; ?></td>
    <td><?php echo $DataPacientes["Localidad"]; ?></td>
    <td><?php echo fechaCastellano($DataPacientes["Fecha_Visita"]); ?></td>
    <td><?php echo $DataPacientes["Alergias"]; ?></td>
    <td><?php echo $DataPacientes["Nombre_Sucursal"]; ?></td>
    <td><?php echo $DataPacientes["ID_TURNO"]; ?></td>
    <td><?php echo $DataPacientes["Fk_Enfermero"]; ?></td>
    <td><?php echo $DataPacientes["Area"]; ?></td>
    <td><?php echo $DataPacientes["Tratamiento"]; ?></td>
    <td><?php echo $DataPacientes["Importe"]; ?></td>
    <td><?php echo $DataPacientes["Contactado"]; ?></td>
</tr>
<?php endwhile;?>
</tbody>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">No hay registros de signos vitales para el rango de fechas seleccionado</p>
<?php endif;?>

<?php 
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
?>

