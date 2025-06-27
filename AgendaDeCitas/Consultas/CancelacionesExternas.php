<script type="text/javascript">
$(document).ready( function () {
    $('#CancelacionesExteriores').DataTable({
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


$user_id = null;
$sql1 = "SELECT
    AgendaCitas_EspecialistasExt.ID_Agenda_Especialista,
    Especialidades_Express.ID_Especialidad,
    Especialidades_Express.Nombre_Especialidad,
    Personal_Medico_Express.Medico_ID,
    Personal_Medico_Express.Nombre_Apellidos,
    SucursalesCorre.ID_SucursalC,
    SucursalesCorre.Nombre_Sucursal,
    Fechas_EspecialistasExt.ID_Fecha_Esp,
    Fechas_EspecialistasExt.Fecha_Disponibilidad,
    Horarios_Citas_Ext.ID_Horario,
    Horarios_Citas_Ext.Horario_Disponibilidad,
    AgendaCitas_EspecialistasExt.AgendadoPor,
    AgendaCitas_EspecialistasExt.Nombre_Paciente,
    AgendaCitas_EspecialistasExt.Telefono,
    AgendaCitas_EspecialistasExt.Observaciones,
    AgendaCitas_EspecialistasExt.Fecha_Hora,
    AgendaCitas_EspecialistasExt.Tipo_Consulta,
    AgendaCitas_EspecialistasExt.Estatus_cita,
    AgendaCitas_EspecialistasExt.ID_H_O_D
FROM
    AgendaCitas_EspecialistasExt
    INNER JOIN Especialidades_Express ON AgendaCitas_EspecialistasExt.Fk_Especialidad = Especialidades_Express.ID_Especialidad
    INNER JOIN Personal_Medico_Express ON AgendaCitas_EspecialistasExt.Fk_Especialista = Personal_Medico_Express.Medico_ID
    INNER JOIN SucursalesCorre ON AgendaCitas_EspecialistasExt.Fk_Sucursal = SucursalesCorre.ID_SucursalC
    INNER JOIN Fechas_EspecialistasExt ON AgendaCitas_EspecialistasExt.Fecha = Fechas_EspecialistasExt.ID_Fecha_Esp
    INNER JOIN Horarios_Citas_Ext ON AgendaCitas_EspecialistasExt.Hora = Horarios_Citas_Ext.ID_Horario
WHERE
    AgendaCitas_EspecialistasExt.Estatus_cita = 'Cancelado'
    AND AgendaCitas_EspecialistasExt.ID_H_O_D ='".$row['ID_H_O_D']."'
    AND YEAR(Fechas_EspecialistasExt.Fecha_Disponibilidad) = YEAR(CURDATE())";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="CancelacionesExteriores" class="table table-hover">
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
	<p class="alert alert-warning">No hay caja abierta</p>
<?php endif;?>
  <!-- Modal -->
  <script>
  	
    $(".btn-Detalles").click(function(){
  		id = $(this).data("id");
  		$.post("https://saludapos.com/AgendaDeCitas/Modales/DetallesCitaSucursalExt.php","id="+id,function(data){
              $("#form-editExt").html(data);
              $("#TituloExt").html("Detalles de cita");
              $("#DiExt").removeClass("modal-dialog modal-notify modal-success");
              $("#DiExt").addClass("modal-dialog modal-lg modal-notify modal-success");
  		});
  		$('#editModalExt').modal('show');
    });


    $(".btn-Cancela").click(function(){
  		id = $(this).data("id");
  		$.post("https://saludapos.com/AgendaDeCitas/Modales/CancelaCitaExt.php","id="+id,function(data){
              $("#form-editExt").html(data);
              $("#TituloExt").html("Cancelación");
              $("#DiExt").removeClass("modal-dialog modal-lg modal-notify modal-success");
              $("#DiExt").addClass("modal-dialog modal-lg modal-notify modal-success");
  		});
  		$('#editModalExt').modal('show');
    });
    
  </script>
  <div class="modal fade" id="editModalExt" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalExtLabel" aria-hidden="true">
  <div id="DiExt"class="modal-dialog  modal-notify modal-success">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="TituloExt"></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
        <div id="Mensaje "class="alert alert-info alert-styled-left text-blue-800 content-group">
						                <span id="Aviso" class="text-semibold"><?php echo $row['Nombre_Apellidos']?>
                            Verifique los campos antes de realizar alguna accion</span>
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
	        <div class="modal-body">
          <div class="text-center">
        <div id="form-editExt"></div>
        
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->