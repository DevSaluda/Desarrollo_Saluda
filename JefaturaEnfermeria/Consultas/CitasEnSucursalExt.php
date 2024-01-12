<script type="text/javascript">
$(document).ready( function () {
    $('#CitasExpress').DataTable({
      "order": [[ 0, "desc" ]],
      bFilter: true,
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
$fcha = date("Y-m-d");
include("db_connection.php");
include "Consultas.php";
include "Sesion.php";

$user_id=null;
$sql1="SELECT AgendaCitas_EspecialistasExt.ID_Agenda_Especialista,AgendaCitas_EspecialistasExt.Fk_Especialidad,AgendaCitas_EspecialistasExt.Fk_Especialista,
AgendaCitas_EspecialistasExt.Fk_Sucursal,AgendaCitas_EspecialistasExt.Fecha,AgendaCitas_EspecialistasExt.Hora,
AgendaCitas_EspecialistasExt.Nombre_Paciente,AgendaCitas_EspecialistasExt.Telefono,AgendaCitas_EspecialistasExt.Observaciones,AgendaCitas_EspecialistasExt.ID_H_O_D, Especialidades_Express.ID_Especialidad,Especialidades_Express.Nombre_Especialidad,Personal_Medico_Express.Medico_ID,
Personal_Medico_Express.Nombre_Apellidos, Fechas_EspecialistasExt.ID_Fecha_Esp,Fechas_EspecialistasExt.Fecha_Disponibilidad, Horarios_Citas_Ext.ID_Horario,Horarios_Citas_Ext.Horario_Disponibilidad,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM AgendaCitas_EspecialistasExt,Especialidades_Express,Personal_Medico_Express,Fechas_EspecialistasExt,Horarios_Citas_Ext,SucursalesCorre WHERE AgendaCitas_EspecialistasExt.Fk_Especialidad = Especialidades_Express.ID_Especialidad AND AgendaCitas_EspecialistasExt.Fk_Especialista = Personal_Medico_Express.Medico_ID AND AgendaCitas_EspecialistasExt.Fk_Sucursal = SucursalesCorre.ID_SucursalC AND AgendaCitas_EspecialistasExt.Fecha =Fechas_EspecialistasExt.ID_Fecha_Esp AND AgendaCitas_EspecialistasExt.Hora = Horarios_Citas_Ext.ID_Horario AND 
AgendaCitas_EspecialistasExt.ID_H_O_D ='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="CitasExpress" class="table table-hover">
<thead>
<th>Folio</th>
<th>Paciente</th>
<th>Telefono</th>
<th>Fecha | Hora </th>
<th>Especialidad | Doctor</th>
<th>Sucursal</th>
<th>Observaciones</th>
<th>Acciones</th>


</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>

    <td> <?php echo $Usuarios["ID_Agenda_Especialista"]; ?></td>
    <td> <?php echo $Usuarios["Nombre_Paciente"]; ?></td>
    <td> <?php echo $Usuarios["Telefono"]; ?></td>
    <td> <?php echo fechaCastellano($Usuarios["Fecha_Disponibilidad"]); ?> <br>
    <?php echo date('h:i A', strtotime(($Usuarios["Horario_Disponibilidad"]))); ?></td>
    <td> <?php echo  $Usuarios["Nombre_Especialidad"]; ?> <br>
    <?php echo $Usuarios["Nombre_Apellidos"]; ?></td>
    <td> <?php echo $Usuarios["Nombre_Sucursal"]; ?></td>
    <td> <?php echo $Usuarios["Observaciones"]; ?></td>

    <td>
		 <!-- Basic dropdown -->
<button class="btn btn-primary dropdown-toggle " type="button" data-toggle="dropdown"
  aria-haspopup="true" aria-expanded="false"><i class="fas fa-th-list fa-1x"></i></button>

<div class="dropdown-menu">
<a data-id="<?php echo $Usuarios["ID_Agenda_Especialista"];?>" class="btn-DetallesExt dropdown-item" >Detalles <i class="fas fa-calendar-week"></i></a>
  
  <a data-id="<?php echo $Usuarios["ID_Agenda_Especialista"];?>" class="btn-CancelaExt dropdown-item" >Cancelar <i class="fas fa-ban"></i></a>
   
  <a style=<?if($Usuarios['Fecha_Disponibilidad'] >= $fcha){
   
   echo "display:block;";
} else {
  echo "display:none;";
}
?> data-id="<?php echo $Usuarios["ID_Agenda_Especialista"];?>" class="btn-WhatsExt dropdown-item" >Whatsapp <i class="fab fa-whatsapp"></i></a>
</div>
<!-- Basic dropdown -->
	 </td>
	
		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">Por el momento no hay citas</p>
<?php endif;?>
  <!-- Modal -->
  <script>
  	
    $(".btn-DetallesExt").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/AgendaDeCitas/Modales/DetallesCitaSucursalExt.php","id="+id,function(data){
              $("#form-editExt").html(data);
              $("#TituloExt").html("Detalles de cita");
              $("#DiExt").removeClass("modal-dialog modal-notify modal-success");
              $("#DiExt").addClass("modal-dialog modal-lg modal-notify modal-success");
  		});
  		$('#editModalExt').modal('show');
    });


    $(".btn-CancelaExt").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/AgendaDeCitas/Modales/CancelaCitaExt.php","id="+id,function(data){
              $("#form-editExt").html(data);
              $("#TituloExt").html("Cancelación");
              $("#DiExt").removeClass("modal-dialog modal-lg modal-notify modal-success");
              $("#DiExt").addClass("modal-dialog modal-lg modal-notify modal-success");
  		});
  		$('#editModalExt').modal('show');
    });
    $(".btn-WhatsExt").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/AgendaDeCitas/Modales/ContactaWhatsSucursalesExt.php","id="+id,function(data){
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
						                <span id="Aviso" class="text-semibold"><?echo $row['Nombre_Apellidos']?>
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