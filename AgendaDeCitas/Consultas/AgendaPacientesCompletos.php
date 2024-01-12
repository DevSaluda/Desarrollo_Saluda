<script type="text/javascript">
$(document).ready( function () {
$('#Campanas').DataTable({
      "order": [[ 0, "desc" ]],
      "lengthMenu": [[50,100,500, -1], [50,100,500, "Todos"]],   
        language: {
            "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
			     },
			     "sProcessing":"Procesando...",
            },
          
        //para usar los botones   
        responsive: "true",
        dom: "B<'#colvis row'><'row'><'row'<'col-md-6'l><'col-md-6'f>r>t<'bottom'ip><'clear'>'",
          buttons:[ 
			{
				extend:    'excelHtml5',
				text:      'Exportar a Excel  <i Exportar a Excel class="fas fa-file-excel"></i> ',
                titleAttr: 'Exportar a Excel',
                title: 'Citas completas en agenda ',
				className: 'btn btn-success'
			},
		,
			
          
            
        ],
   
	   
        	        
    }); });
</script>
<?php

include("db_connection.php");
include "Consultas.php";
include "Sesion.php";
include "../js/Fecha.php";

$user_id=null;
$sql1="SELECT AgendaCitas_EspecialistasV2.ID_Agenda_Especialista,AgendaCitas_EspecialistasV2.Fk_Especialidad,
AgendaCitas_EspecialistasV2.Fk_Especialista,AgendaCitas_EspecialistasV2.Fk_Sucursal,
AgendaCitas_EspecialistasV2.Fk_Fecha,AgendaCitas_EspecialistasV2.Fk_Hora,
AgendaCitas_EspecialistasV2.Tipo_Consulta,
AgendaCitas_EspecialistasV2.Estatus_pago,AgendaCitas_EspecialistasV2.Color_Pago,AgendaCitas_EspecialistasV2.Estatus_cita,
AgendaCitas_EspecialistasV2.Observaciones,AgendaCitas_EspecialistasV2.ColorEstatusCita,AgendaCitas_EspecialistasV2.Estatus_Seguimiento,
AgendaCitas_EspecialistasV2.Color_Seguimiento,AgendaCitas_EspecialistasV2.ID_H_O_D,AgendaCitas_EspecialistasV2.Folio_Paciente,
Data_Pacientes.ID_Data_Paciente,Data_Pacientes.Nombre_Paciente,Data_Pacientes.Telefono,Data_Pacientes.Correo,
EspecialidadesV2.ID_Especialidad,EspecialidadesV2.Nombre_Especialidad,EspecialistasV2.ID_Especialista,EspecialistasV2.Nombre_Apellidos,
Sucursales_CampañasV2.ID_SucursalC ,Sucursales_CampañasV2.Nombre_Sucursal,Fechas_EspecialistasV2.ID_Fecha_Esp,Fechas_EspecialistasV2.Fecha_Disponibilidad,
Horarios_Citas_especialistasV2.ID_Horario,Horarios_Citas_especialistasV2.Horario_Disponibilidad, Costos_EspecialistasV2.ID_Costo_Esp,Costos_EspecialistasV2.Costo_Especialista
FROM AgendaCitas_EspecialistasV2,EspecialidadesV2,EspecialistasV2,Sucursales_CampañasV2,Fechas_EspecialistasV2,Horarios_Citas_especialistasV2,
Costos_EspecialistasV2,Data_Pacientes WHERE
AgendaCitas_EspecialistasV2.Fk_Especialidad = EspecialidadesV2.ID_Especialidad AND AgendaCitas_EspecialistasV2.Fk_Especialista =EspecialistasV2.ID_Especialista AND
AgendaCitas_EspecialistasV2.Folio_Paciente=Data_Pacientes.ID_Data_Paciente AND
AgendaCitas_EspecialistasV2.Fk_Sucursal =Sucursales_CampañasV2.ID_SucursalC AND
AgendaCitas_EspecialistasV2.Fk_Fecha = Fechas_EspecialistasV2.ID_Fecha_Esp AND
AgendaCitas_EspecialistasV2.Fk_Hora = Horarios_Citas_especialistasV2.ID_Horario AND
AgendaCitas_EspecialistasV2.Fk_Costo =  Costos_EspecialistasV2.ID_Costo_Esp AND
AgendaCitas_EspecialistasV2.ID_H_O_D='".$row['ID_H_O_D']."' order by AgendaCitas_EspecialistasV2.ID_Agenda_Especialista DESC";

$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
    <div class="text-center">
	<div class="table-responsive">
	<table id="Campanas" class="table table-hover">
<thead>
<th>Folio cita</th>
    <th>Especialidad</th>
	<th>Paciente</th>
	
	<th>Sucursal</th>
    <th>Fecha | Hora</th>
    <th>Doctor</th>
 <!--    <th>Estatus</th>
    <th>Acciones</th> -->

	

	



</thead>
<?php while ($Especialista=$query->fetch_array()):?>
<tr>
 <td><?php echo $Especialista["ID_Agenda_Especialista"]; ?> </td>
    <td><?php echo $Especialista["Nombre_Especialidad"]; ?> </td>
	<td><?php echo $Especialista["Nombre_Paciente"]; ?></td>
	<td><?php echo $Especialista["Nombre_Sucursal"]; ?></td>

	<td><?php echo fechaCastellano($Especialista["Fecha_Disponibilidad"]); ?><br>
	<?php echo date('h:i A', strtotime($Especialista["Horario_Disponibilidad"])); ?>
</td>
<td><?php echo $Especialista["Nombre_Apellidos"]; ?></td>

	

	
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
  		$.post("https://controlfarmacia.com/ControldecitasV2/Modales/ContactoPaciente.php","id="+id,function(data){
              $("#form-edit").html(data);
              $("#Titulo").html("Medios disponibles para contacto a paciente");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-primary");
              $("#Di").addClass("modal-dialog modal-lg modal-notify modal-info");
  		});
  		$('#editModal').modal('show');
      });
      $(".btn-edit2").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/ControldecitasV2/Modales/CambioEstatusPaciente.php","id="+id,function(data){
              $("#form-edit").html(data);
              $("#Titulo").html("Cambio de estatus en cita");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Di").addClass("modal-dialog modal-lg modal-notify modal-primary");
  		});
  		$('#editModal').modal('show');
    });
    $(".btn-edit3").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/ControldecitasV2/Modales/Cancelaciones.php","id="+id,function(data){
              $("#form-edit").html(data);
              $("#Titulo").html("Cancelacion");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di").addClass("modal-dialog modal-lg modal-notify modal-danger");
  		});
  		$('#editModal').modal('show');
  	});
  </script>
  
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalLabel" aria-hidden="true">
  <div id="Di"class="modal-dialog modal-lg modal-notify modal-info">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="Titulo"></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
        <div id="Mensaje "class="alert alert-info alert-styled-left text-blue-800 content-group">
						                <span id="Aviso" class="text-semibold">Estimado usuario, 
                            Verifique los campos antes de realizar alguna accion</span>
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
	        <div class="modal-body">
          <div class="text-center">
        <div id="form-edit"></div>
        
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->