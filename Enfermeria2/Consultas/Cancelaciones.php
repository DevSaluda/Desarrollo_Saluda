<script type="text/javascript">
$(document).ready( function () {
    $('#Campanas').DataTable({
		
      "language": {
        "url": "Componentes/Spanish.json"
        }
      } );
} );
</script>
<?php

include("db_connection.php");
include "Consultas.php";
include "Sesion.php";
include "../js/Fecha.php";

$user_id=null;
$sql1="SELECT Cancelaciones_Agenda.ID_Agenda_Especialista,Cancelaciones_Agenda.Fk_Especialidad,
Cancelaciones_Agenda.Fk_Especialista,Cancelaciones_Agenda.Fk_Sucursal,
Cancelaciones_Agenda.Fk_Fecha,Cancelaciones_Agenda.Fk_Hora,
Cancelaciones_Agenda.Tipo_Consulta,
Cancelaciones_Agenda.Estatus_pago,Cancelaciones_Agenda.Color_Pago,Cancelaciones_Agenda.Estatus_cita,
Cancelaciones_Agenda.Observaciones,Cancelaciones_Agenda.ColorEstatusCita,Cancelaciones_Agenda.Estatus_Seguimiento,
Cancelaciones_Agenda.Color_Seguimiento,Cancelaciones_Agenda.ID_H_O_D,Cancelaciones_Agenda.Folio_Paciente,
Data_Pacientes.ID_Data_Paciente,Data_Pacientes.Nombre_Paciente,Data_Pacientes.Telefono,Data_Pacientes.Correo,
EspecialidadesV2.ID_Especialidad,EspecialidadesV2.Nombre_Especialidad,EspecialistasV2.ID_Especialista,EspecialistasV2.Nombre_Apellidos,
Sucursales_CampañasV2.ID_SucursalC ,Sucursales_CampañasV2.Nombre_Sucursal,Fechas_EspecialistasV2.ID_Fecha_Esp,Fechas_EspecialistasV2.Fecha_Disponibilidad,
Horarios_Citas_especialistasV2.ID_Horario,Horarios_Citas_especialistasV2.Horario_Disponibilidad, Costos_EspecialistasV2.ID_Costo_Esp,Costos_EspecialistasV2.Costo_Especialista
FROM Cancelaciones_Agenda,EspecialidadesV2,EspecialistasV2,Sucursales_CampañasV2,Fechas_EspecialistasV2,Horarios_Citas_especialistasV2,
Costos_EspecialistasV2,Data_Pacientes WHERE
Cancelaciones_Agenda.Fk_Especialidad = EspecialidadesV2.ID_Especialidad AND Cancelaciones_Agenda.Fk_Especialista =EspecialistasV2.ID_Especialista AND
Cancelaciones_Agenda.Folio_Paciente=Data_Pacientes.ID_Data_Paciente AND
Cancelaciones_Agenda.Fk_Sucursal =Sucursales_CampañasV2.ID_SucursalC AND
Cancelaciones_Agenda.Fk_Fecha = Fechas_EspecialistasV2.ID_Fecha_Esp AND
Cancelaciones_Agenda.Fk_Hora = Horarios_Citas_especialistasV2.ID_Horario AND
Cancelaciones_Agenda.Fk_Costo =  Costos_EspecialistasV2.ID_Costo_Esp AND  Cancelaciones_Agenda.Fk_Sucursal='".$row['Fk_Sucursal']."' AND  
Cancelaciones_Agenda.ID_H_O_D='".$row['ID_H_O_D']."' order by Cancelaciones_Agenda.ID_Agenda_Especialista DESC";

$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
    <div class="text-center">
	<div class="table-responsive">
	<table id="Campanas" class="table table-hover">
<thead>
   
    <th>Especialidad</th>
	<th>Paciente</th>
	
	<th>Sucursal</th>
    <th>Fecha | Hora</th>
    <th style="background-color: #FF0000 !important;">Estatus</th>
    <th>Detalles</th>

	

	



</thead>
<?php while ($Especialista=$query->fetch_array()):?>
<tr>
    <td><?php echo $Especialista["Nombre_Especialidad"]; ?> </td>
	<td><?php echo $Especialista["Nombre_Paciente"]; ?></td>
	<td><?php echo $Especialista["Nombre_Sucursal"]; ?></td>

	<td><?php echo fechaCastellano($Especialista["Fecha_Disponibilidad"]); ?><br>
	<?php echo date('h:i A', strtotime($Especialista["Horario_Disponibilidad"])); ?>
</td>

<td>
<button class="btn btn-default btn-sm" style="<?echo $Especialista['ColorEstatusCita'];?>"><?php echo $Especialista["Estatus_cita"]; ?></button> 
<!-- Basic dropdown -->
   </td>
 
     <td>
		 <!-- Basic dropdown -->
     <button data-id="<?php echo $Especialista["ID_Agenda_Especialista"];?>" class="btn-edit1  btn-info dropdown-item" ><i class="fas fa-info-circle"></i></button>
	 </td>
	

	
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">No hay resultados</p>
<?php endif;?>
  <!-- Modal -->
 <!-- Modal -->
 <script>
  	$(".btn-edit1").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlconsulta.com/Enfermeria2/Modales/DetallesCancelacion.php","id="+id,function(data){
              $("#form-edit").html(data);
              
  		});
  		$('#editModal').modal('show');
      });
      
  </script>
  
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalLabel" aria-hidden="true">
  <div id="Di"class="modal-dialog modal-lg modal-notify modal-info">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="Titulo">Detalles de cita cancelada</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
       
	        <div class="modal-body">
          <div class="text-center">
        <div id="form-edit"></div>
        
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->