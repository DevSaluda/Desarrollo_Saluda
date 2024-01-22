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

include ("db_connection.php");
include "Consultas.php";
include "Sesion.php";
include "../js/Fecha.php";

$user_id=null;
$sql1="SELECT AgendaCitas_EspecialistasV2.ID_Agenda_Especialista,AgendaCitas_EspecialistasV2.Fk_Especialidad,
AgendaCitas_EspecialistasV2.Fk_Especialista,AgendaCitas_EspecialistasV2.Fk_Sucursal,
AgendaCitas_EspecialistasV2.Fk_Fecha,AgendaCitas_EspecialistasV2.Fk_Hora,AgendaCitas_EspecialistasV2.Nombre_Paciente,
AgendaCitas_EspecialistasV2.Tipo_Consulta,





AgendaCitas_EspecialistasV2.Estatus_pago,AgendaCitas_EspecialistasV2.Color_Pago,AgendaCitas_EspecialistasV2.Estatus_cita,
AgendaCitas_EspecialistasV2.Observaciones,AgendaCitas_EspecialistasV2.ColorEstatusCita,AgendaCitas_EspecialistasV2.Estatus_Seguimiento,
AgendaCitas_EspecialistasV2.Color_Seguimiento,AgendaCitas_EspecialistasV2.ID_H_O_D,AgendaCitas_EspecialistasV2.AgendadoPor,AgendaCitas_EspecialistasV2.Sistema,AgendaCitas_EspecialistasV2.Folio_Paciente,
EspecialidadesV2.ID_Especialidad,EspecialidadesV2.Nombre_Especialidad,EspecialistasV2.ID_Especialista,EspecialistasV2.Nombre_Apellidos,
Sucursales_CampañasV2.ID_SucursalC ,Sucursales_CampañasV2.Nombre_Sucursal,Fechas_EspecialistasV2.ID_Fecha_Esp,Fechas_EspecialistasV2.Fecha_Disponibilidad,
Horarios_Citas_especialistasV2.ID_Horario,Horarios_Citas_especialistasV2.Horario_Disponibilidad, Costos_EspecialistasV2.ID_Costo_Esp,Costos_EspecialistasV2.Costo_Especialista
FROM AgendaCitas_EspecialistasV2,EspecialidadesV2,EspecialistasV2,Sucursales_CampañasV2,Fechas_EspecialistasV2,Horarios_Citas_especialistasV2,
Costos_EspecialistasV2 WHERE
AgendaCitas_EspecialistasV2.Fk_Especialidad = EspecialidadesV2.ID_Especialidad AND AgendaCitas_EspecialistasV2.Fk_Especialista =EspecialistasV2.ID_Especialista AND
AgendaCitas_EspecialistasV2.Fk_Sucursal =Sucursales_CampañasV2.ID_SucursalC AND
AgendaCitas_EspecialistasV2.Fk_Fecha = Fechas_EspecialistasV2.ID_Fecha_Esp AND
AgendaCitas_EspecialistasV2.Fk_Hora = Horarios_Citas_especialistasV2.ID_Horario AND
AgendaCitas_EspecialistasV2.Fk_Costo =  Costos_EspecialistasV2.ID_Costo_Esp AND 
 Fechas_EspecialistasV2.Fecha_Disponibilidad BETWEEN CURDATE() and CURDATE() + INTERVAL 1 DAY AND

AgendaCitas_EspecialistasV2.ID_H_O_D='".$row['ID_H_O_D']."'  order by Horarios_Citas_especialistasV2.Horario_Disponibilidad ASC";

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
    <th>Estatus</th>
    <th>Acciones</th>

  

  



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
     <!-- Basic dropdown -->
<button class="btn btn-info dropdown-toggle " type="button" data-toggle="dropdown"
  aria-haspopup="true" aria-expanded="false"><i class="fas fa-info-circle"></i></button>

<div class="dropdown-menu">
    <div class="text-center">
<a class="dropdown-item" >Cita</a>
<button class="btn btn-default btn-sm" style="<?echo $Especialista['ColorEstatusCita'];?>"><?php echo $Especialista["Estatus_cita"]; ?></button> 
<div class="dropdown-divider"></div>
<a class="dropdown-item" >Pago</a>
<button class="btn btn-default btn-sm" style="<?echo $Especialista['Color_Pago'];?>"><?php echo $Especialista["Estatus_pago"]; ?></button>
</div>
</div>
<!-- Basic dropdown -->
   </td>
     <td>
     <!-- Basic dropdown -->
<button class="btn btn-primary dropdown-toggle " type="button" data-toggle="dropdown"
  aria-haspopup="true" aria-expanded="false"><i class="fas fa-th-list fa-1x"></i></button>

<div class="dropdown-menu">
<a data-id="<?php echo $Especialista["ID_Agenda_Especialistas"];?>" class="btn-edit1 dropdown-item" >Contacto a paciente <i class="fas fa-id-card-alt"></i></a>
  <a data-id="<?php echo $Especialista["ID_Agenda_Especialista"];?>" class="btn-edit2 dropdown-item" >Tomar signos vitales <i class="fas fa-file-medical"></i></a>

 
</div>
<!-- Basic dropdown -->
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
      $.post("https://controlfarmacia.com/JefaturaEnfermeria/Modales/ContactoPaciente.php","id="+id,function(data){
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
      $.post("https://controlfarmacia.com/JefaturaEnfermeria/Modales/AgendaSignosVitalIndex.php","id="+id,function(data){
              $("#form-edit").html(data);
              $("#Titulo").html("Captura de signos vitales");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Di").addClass("modal-dialog modal-lg modal-notify modal-info");
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