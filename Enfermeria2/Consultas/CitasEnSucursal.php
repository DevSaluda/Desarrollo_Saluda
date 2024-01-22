<script type="text/javascript">
$(document).ready( function () {
    $('#CajasSucursales').DataTable({
      "order": [[ 0, "desc" ]],
 
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
$sql1="SELECT AgendaCitas_EspecialistasSucursales.ID_Agenda_Especialista,AgendaCitas_EspecialistasSucursales.Fk_Especialidad,AgendaCitas_EspecialistasSucursales.Fk_Especialista,
AgendaCitas_EspecialistasSucursales.Fk_Sucursal,AgendaCitas_EspecialistasSucursales.Fecha,AgendaCitas_EspecialistasSucursales.ID_H_O_D,
AgendaCitas_EspecialistasSucursales.Hora,AgendaCitas_EspecialistasSucursales.Nombre_Paciente,AgendaCitas_EspecialistasSucursales.Telefono,AgendaCitas_EspecialistasSucursales.Observaciones,
SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal,Roles_Puestos.ID_rol,Roles_Puestos.Nombre_rol,
Personal_Medico.Medico_ID,Personal_Medico.Nombre_Apellidos,Fechas_Especialistas_Sucursales.ID_Fecha_Esp,Fechas_Especialistas_Sucursales.Fecha_Disponibilidad,Horarios_Citas_Sucursales.ID_Horario,Horarios_Citas_Sucursales.Horario_Disponibilidad FROM AgendaCitas_EspecialistasSucursales,SucursalesCorre,Roles_Puestos,Personal_Medico,Fechas_Especialistas_Sucursales,Horarios_Citas_Sucursales 
where AgendaCitas_EspecialistasSucursales.Fk_Especialidad = Roles_Puestos.ID_rol AND 
AgendaCitas_EspecialistasSucursales.Fk_Especialista= Personal_Medico.Medico_ID AND AgendaCitas_EspecialistasSucursales.Fk_Sucursal= SucursalesCorre.ID_SucursalC 
AND AgendaCitas_EspecialistasSucursales.Fecha = Fechas_Especialistas_Sucursales.ID_Fecha_Esp AND AgendaCitas_EspecialistasSucursales.Fk_Sucursal='".$row['Fk_Sucursal']."' AND AgendaCitas_EspecialistasSucursales.Hora = Horarios_Citas_Sucursales.ID_Horario  AND  AgendaCitas_EspecialistasSucursales.ID_H_O_D='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="CajasSucursales" class="table table-hover">
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
    <td> <?php echo  $Usuarios["Nombre_rol"]; ?> <br>
    <?php echo $Usuarios["Nombre_Apellidos"]; ?></td>
    <td> <?php echo $Usuarios["Nombre_Sucursal"]; ?></td>
    <td> <?php echo $Usuarios["Observaciones"]; ?></td>

    <td>
		 <!-- Basic dropdown -->
<button class="btn btn-primary dropdown-toggle " type="button" data-toggle="dropdown"
  aria-haspopup="true" aria-expanded="false"><i class="fas fa-th-list fa-1x"></i></button>

<div class="dropdown-menu">
<a data-id="<?php echo $Usuarios["ID_Agenda_Especialista"];?>" class="btn-Detalles dropdown-item" >Detalles <i class="fas fa-calendar-week"></i></a>
  
  <a data-id="<?php echo $Usuarios["ID_Agenda_Especialista"];?>" class="btn-Cancela dropdown-item" >Cancelar <i class="fas fa-ban"></i></a>
 
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
  	
    $(".btn-Detalles").click(function(){
  		id = $(this).data("id");
  		$.post("https://saludapos.com/Enfermeria2/Modales/DetallesCitaSucursal.php","id="+id,function(data){
              $("#form-edit").html(data);
              $("#Titulo").html("Detalles de cita");
              $("#Di").removeClass("modal-dialog modal-notify modal-success");
              $("#Di").addClass("modal-dialog modal-lg modal-notify modal-success");
  		});
  		$('#editModal').modal('show');
    });


    $(".btn-Cancela").click(function(){
  		id = $(this).data("id");
  		$.post("https://saldudapos.com/Enfermeria2/Modales/CancelaCita.php","id="+id,function(data){
              $("#form-edit").html(data);
              $("#Titulo").html("Cancelación");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-success");
              $("#Di").addClass("modal-dialog modal-lg modal-notify modal-success");
  		});
  		$('#editModal').modal('show');
    });
    
  </script>
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalLabel" aria-hidden="true">
  <div id="Di"class="modal-dialog  modal-notify modal-success">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="Titulo"></p>

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
        <div id="form-edit"></div>
        
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->