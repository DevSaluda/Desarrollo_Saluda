<script type="text/javascript">
$(document).ready( function () {
    $('#CitasExteriores').DataTable({
      "order": [[ 0, "desc" ]],
      bFilter: false,
      "info": false,
      "lengthMenu": [[10,50,200, -1], [10,50,200, "Todos"]],   
      "language": {
        "url": "Componentes/Spanish.json"
		},
 
    
		
	  } 
	  
	  );
} );
</script>
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
include("db_connection.php");
include "Consultas.php";

$user_id=null;
$sql1="SELECT Cancelaciones_AgendaSucursales.ID_Cancelacion,Cancelaciones_AgendaSucursales.ID_Agenda_Especialista,Cancelaciones_AgendaSucursales.Fk_Especialidad,
Cancelaciones_AgendaSucursales.Fk_Especialista,Cancelaciones_AgendaSucursales.Fk_Sucursal,Cancelaciones_AgendaSucursales.Fecha,Cancelaciones_AgendaSucursales.Hora, Cancelaciones_AgendaSucursales.ID_H_O_D,
Cancelaciones_AgendaSucursales.Nombre_Paciente,Cancelaciones_AgendaSucursales.Tipo_Consulta,Cancelaciones_AgendaSucursales.Observaciones,Cancelaciones_AgendaSucursales.ID_H_O_D,Personal_Medico.Medico_ID,Personal_Medico.Nombre_Apellidos, Roles_Puestos.ID_rol,Roles_Puestos.Nombre_rol, SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal,Fechas_Especialistas_Sucursales.ID_Fecha_Esp,Fechas_Especialistas_Sucursales.Fecha_Disponibilidad,
Horarios_Citas_Sucursales.ID_Horario,Horarios_Citas_Sucursales.Horario_Disponibilidad FROM Cancelaciones_AgendaSucursales,Roles_Puestos,Personal_Medico,SucursalesCorre,Fechas_Especialistas_Sucursales,Horarios_Citas_Sucursales WHERE
Cancelaciones_AgendaSucursales.Fk_Especialidad=Roles_Puestos.ID_rol AND Cancelaciones_AgendaSucursales.Fk_Especialista = Personal_Medico.Medico_ID AND 
Cancelaciones_AgendaSucursales.Fk_Sucursal= SucursalesCorre.ID_SucursalC AND Cancelaciones_AgendaSucursales.Fecha = Fechas_Especialistas_Sucursales.ID_Fecha_Esp AND Horarios_Citas_Sucursales.ID_Horario= Cancelaciones_AgendaSucursales.Hora AND Cancelaciones_AgendaSucursales.ID_H_O_D ='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="CitasExteriores" class="table table-hover">
<thead>
<th>Folio</th>
<th>Paciente</th>

<th>Fecha | Hora </th>
<th>Especialidad | Doctor</th>
<th>Sucursal</th>
<th>Observaciones</th>
<th>Estado</th>


</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>

    <td> <?php echo $Usuarios["ID_Agenda_Especialista"]; ?></td>
    <td> <?php echo $Usuarios["Nombre_Paciente"]; ?></td>
    <td> <?php echo fechaCastellano($Usuarios["Fecha_Disponibilidad"]); ?> <br>
    <?php echo date('h:i A', strtotime(($Usuarios["Horario_Disponibilidad"]))); ?></td>
    <td> <?php echo  $Usuarios["Nombre_Especialidad"]; ?> <br>
    <?php echo $Usuarios["Nombre_Apellidos"]; ?></td>
    <td> <?php echo $Usuarios["Nombre_Sucursal"]; ?></td>
    <td> <?php echo $Usuarios["Observaciones"]; ?></td>
    <td>
    <button class="btn btn-danger btn-sm">
Cancelado</button></td>

    
		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">No hay cancelaciones</p>
<?php endif;?>
  <!-- Modal -->
