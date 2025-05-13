<script type="text/javascript">
$(document).ready( function () {
    $('#Horarios').DataTable({
      "lengthMenu": [[50,100,200 -1], [50,100,200]],   
      "language": {
        "url": "Componentes/Spanish.json"
        }
      } );
} );
</script>
<?php

include ("db_connection.php");
include "Consultas.php";
include "Sesion.php";

$user_id=null;
$sql1="SELECT Horarios_Citas_especialistasV2.ID_Horario,Horarios_Citas_especialistasV2.Horario_Disponibilidad,Horarios_Citas_especialistasV2.Fk_Fecha,
Horarios_Citas_especialistasV2.ID_H_O_D,Horarios_Citas_especialistasV2.FK_Especialista,Horarios_Citas_especialistasV2.Estatus_Horario,
Horarios_Citas_especialistasV2.CodigoColorHo, EspecialistasV2.ID_Especialista,
EspecialistasV2.Nombre_Apellidos,Fechas_EspecialistasV2.ID_Fecha_Esp,Fechas_EspecialistasV2.Fecha_Disponibilidad FROM Horarios_Citas_especialistasV2,EspecialistasV2,Fechas_EspecialistasV2 where 
Horarios_Citas_especialistasV2.FK_Especialista = EspecialistasV2.ID_Especialista AND Horarios_Citas_especialistasV2.Estatus_Horario='Vigente' AND
Horarios_Citas_especialistasV2.Fk_Fecha = Fechas_EspecialistasV2.ID_Fecha_Esp
 AND Horarios_Citas_especialistasV2.ID_H_O_D ='".$row['ID_H_O_D']."'";
 

$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table id="Horarios" class="table table-hover">
<thead>
	<th>Folio</th>
    <th>Nombre especialista</th>
  <th>Horario</th>
  <th>Fecha</th>
	<th>Estatus</th>

	


</thead>
<?php while ($Horario=$query->fetch_array()):?>
<tr>
	<td><?php echo $Horario["ID_Horario"]; ?></td>
    <td><?php echo $Horario["Nombre_Apellidos"]; ?></td>
    <td><?php echo date('h:i A', strtotime($Horario["Horario_Disponibilidad"])); ?></td>
    <td><?php echo fechaCastellano($Horario["Fecha_Disponibilidad"]); ?></td>
    
  
		<td><button class="btn btn-default btn-sm" style="<?echo $Horario['CodigoColorHo'];?>"><?php echo $Horario["Estatus_Horario"]; ?></button></td>

		
</tr>
<?php endwhile;?>
</table>
</div></div>
<?php else:?>
	<p class="alert alert-warning">No hay resultados</p>
<?php endif;?>
  <!-- Modal -->
  
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
		<h4 class="modal-title">Editar Horario</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      
		</div>
		<span id="error_actualiza" class="alert alert-danger" style="display: none"></span>
        <p id="show_message" style="display: none">Form data sent. Thanks for your comments.We will update you within 24 hours. </p>
        <p id="show_error"  class="alert alert-danger" style="display: none">Algo salio mal </p>
        <div class="modal-body">
        <div id="form-edit"></div>
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <?

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