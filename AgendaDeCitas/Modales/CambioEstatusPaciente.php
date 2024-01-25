<?php
include "../Consultas/db_connection.php";

$user_id=null;
$sql1= "SELECT AgendaCitas_EspecialistasV3.ID_Agenda_Especialista,AgendaCitas_EspecialistasV3.Fk_Especialidad,
AgendaCitas_EspecialistasV3.Fk_Especialista,AgendaCitas_EspecialistasV3.Fk_Sucursal,
AgendaCitas_EspecialistasV3.Fk_Fecha,AgendaCitas_EspecialistasV3.Fk_Hora,
AgendaCitas_EspecialistasV3.Tipo_Consulta,
AgendaCitas_EspecialistasV3.Estatus_pago,AgendaCitas_EspecialistasV3.Color_Pago,AgendaCitas_EspecialistasV3.Estatus_cita,
AgendaCitas_EspecialistasV3.Observaciones,AgendaCitas_EspecialistasV3.ColorEstatusCita,AgendaCitas_EspecialistasV3.Estatus_Seguimiento,
AgendaCitas_EspecialistasV3.Color_Seguimiento,AgendaCitas_EspecialistasV3.ID_H_O_D,AgendaCitas_EspecialistasV3.Nombre_Paciente,
EspecialidadesV2.ID_Especialidad,EspecialidadesV2.Nombre_Especialidad,EspecialistasV2.ID_Especialista,EspecialistasV2.Nombre_Apellidos,
Sucursales_CampañasV2.ID_SucursalC ,Sucursales_CampañasV2.Nombre_Sucursal,Fechas_EspecialistasV2.ID_Fecha_Esp,Fechas_EspecialistasV2.Fecha_Disponibilidad,
Horarios_Citas_especialistasV2.ID_Horario,Horarios_Citas_especialistasV2.Horario_Disponibilidad, Costos_EspecialistasV2.ID_Costo_Esp,Costos_EspecialistasV2.Costo_Especialista
FROM AgendaCitas_EspecialistasV3,EspecialidadesV2,EspecialistasV2,Sucursales_CampañasV2,Fechas_EspecialistasV2,Horarios_Citas_especialistasV2,
Costos_EspecialistasV2 WHERE
AgendaCitas_EspecialistasV3.Fk_Especialidad = EspecialidadesV2.ID_Especialidad AND AgendaCitas_EspecialistasV3.Fk_Especialista =EspecialistasV2.ID_Especialista AND
AgendaCitas_EspecialistasV3.Fk_Sucursal =Sucursales_CampañasV2.ID_SucursalC AND
AgendaCitas_EspecialistasV3.Fk_Fecha = Fechas_EspecialistasV2.ID_Fecha_Esp AND
AgendaCitas_EspecialistasV3.Fk_Hora = Horarios_Citas_especialistasV2.ID_Horario AND
AgendaCitas_EspecialistasV3.Fk_Costo =  Costos_EspecialistasV2.ID_Costo_Esp  AND AgendaCitas_EspecialistasV3.ID_Agenda_Especialista = ".$_POST["id"];
$query = $conn->query($sql1);
$Especialidades = null;
if($query->num_rows>0){
while ($r=$query->fetch_object()){
  $Especialidades=$r;
  break;
}

  }
?>

<?php if($Especialidades!=null):?>

<form action="javascript:void(0)" method="post" id="Actualizacita">
  <div class="form-row">
    <div class="col">
      <label for="exampleFormControlInput1">Especialidad </label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">

          <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
        </div>
        <input type="text" class="form-control" readonly value="<?php echo $Especialidades->Nombre_Especialidad; ?>" aria-describedby="basic-addon1">
      </div>
    </div>
    <div class="col">
      <label for="exampleFormControlInput1">Paciente</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">

          <span class="input-group-text" id="Tarjeta"><i class="fas fa-hospital-user"></i></span>
        </div>
        <input type="text" class="form-control" readonly value="<?php echo $Especialidades->Nombre_Paciente; ?>" aria-describedby="basic-addon1">
      </div>
    </div>
    
  </div>

  <div class="form-row">
    <div class="col">
      <label for="exampleFormControlInput1">Estatus pago </label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">

          <span class="input-group-text" id="Tarjeta"><i class="fas fa-money-check-alt"></i></span>
        </div>
        <select name="Colorpago" class="form-control form-control-sm" id="colorpago" onchange="ShowSelected();">
          <option value="">Elige estatus</option>
        
          <option value="background-color: #9A2EFE !important;">Pagado</option>
          <option value="background-color: #DA81F5 !important;">Pendiente</option>
        </select>
      </div>
    </div>
    <div class="col">
      <label for="exampleFormControlInput1">Estado Consulta</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">

          <span class="input-group-text" id="Tarjeta"><i class="fas fa-clipboard-check"></i></span>
        </div>
        <select name="Colorcita" class="form-control form-control-sm" id="colorcita" onchange="ShowSelected2();">
          <option value="">Elige estatus</option>
          <option value="background-color: #298A08 !important;">Completa</option>
          <option value="background-color: #FF0000 !important;">Cancelada</option>
        
        </select>
      </div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Seguimiento</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-headset"></i></span>
  </div>
  <select name="Colorseguimiento" class="form-control form-control-sm" id="colorsegui" onchange="ShowSelected3();">
                   <option value="">Elige un estatus</option>
                    
				
              <option  value="background-color: #DBA901 !important;">Espera seguimiento</option>		
              <option  value="background-color: #DF7401  !important;">Completa</option>						  
						 </select>
</div>
    </div>
  </div>
  <div class="table-responsive">
  <table class="table table-bordered">
  <thead>
    <tr>
     
     
      <th scope="col">Estatus de pago</th>
      <th scope="col">Estatus de cita</th>
      <th scope="col">Estatus de seguimiento</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      
     
      <td><button id="ActPago" class="btn btn-default btn-sm" style="<?php echo $Especialidades->Color_Pago; ?>"><?php echo $Especialidades->Estatus_pago; ?></button>
     <button id="SiPago" class="divOculto btn btn-default btn-sm" style="background-color: #9A2EFE !important;">Pagado</button> 
      <button id="NoPago" class="divOculto btn btn-default btn-sm" style="background-color: #DA81F5 !important;">Pendiente</button></td>
      <td><button id="ActCita" class="btn btn-default btn-sm" style="<?php echo $Especialidades->ColorEstatusCita; ?>"><?php echo $Especialidades->Estatus_cita; ?></button> 
      <button id="Completa" class="divOculto btn btn-default btn-sm" style="background-color: #298A08 !important;">Completa</button> 
      <button id="Cancelada" class="divOculto btn btn-default btn-sm" style="background-color: #FF0000 !important;">Cancelada</button></td>
      <td><button id="ActSegui" class="btn btn-default btn-sm" style="<?php echo $Especialidades->Color_Seguimiento; ?>"><?php echo $Especialidades->Estatus_Seguimiento; ?></button>
      <button id="Wait" class="divOculto btn btn-default btn-sm" style="background-color: #DBA901 !important;">Espera seguimiento</button> 
      <button id="NoWait" class="divOculto btn btn-default btn-sm" style="background-color: #DF7401  !important;">Completa</button></td>
    </tr>
    
  
  </tbody>
</table>
</div>
  <input type="text" hidden name="EstatusPago" value="<?php echo $Especialidades->Estatus_pago; ?>"id="estatuspago">
  <input type="text" hidden name="EstatusCita" value=" <?php echo $Especialidades->Estatus_cita; ?>" id="estatuscita">
  <input type="text" hidden name="Estatusseguimiento" value=" <?php echo $Especialidades->Estatus_Seguimiento; ?>" id="estatussigue">
  <input type="hidden" name="id" id="id" value="<?php echo $Especialidades->ID_Agenda_Especialista; ?>">
  <button type="submit" name="submit" id="submit" class="btn btn-primary">Aplicar cambios <i class="fas fa-save"></i></button>

</form>
<script type="text/javascript">
  function ShowSelected() {


    /* Para obtener el texto */
    var combo = document.getElementById("colorpago");
    var selected = combo.options[combo.selectedIndex].text;
    $("#estatuspago").val(selected);
  }

  function ShowSelected2() {


    /* Para obtener el texto */
    var combo = document.getElementById("colorcita");
    var selected = combo.options[combo.selectedIndex].text;
    $("#estatuscita").val(selected);
  }

  function ShowSelected3() {


/* Para obtener el texto */
var combo = document.getElementById("colorsegui");
var selected = combo.options[combo.selectedIndex].text;
$("#estatussigue").val(selected);
}


$(function() {
  
    
$("#colorpago").on('change', function() {

  var selectValue = $(this).val();
  switch (selectValue) {

    case "background-color: #9A2EFE !important;":
        $("#SiPago").show();
                        $("#ActPago").hide();
                        $("#NoPago").hide();
     
      break;

    case "background-color: #DA81F5 !important;":
        $("#NoPago").show();
        $("#ActPago").hide();
        $("#SiPago").hide();
       
     
      
      break;

    

  }

}).change();

});
$("#colorcita").on('change', function() {

var selectValue = $(this).val();
switch (selectValue) {

  case "background-color: #298A08 !important;":
      $("#Completa").show();
                      $("#ActCita").hide();
                      $("#Cancelada").hide();
   
    break;

  case "background-color: #FF0000 !important;":
    $("#Cancelada").show();
        $("#ActCita").hide();
      $("#Completa").hide();
                  
                     
   
    
    break;

  

}

}).change();
$("#colorsegui").on('change', function() {

var selectValue = $(this).val();
switch (selectValue) {

  case "background-color: #DBA901 !important;":
      $("#Wait").show();
                      $("#ActSegui").hide();
                      $("#NoWait").hide();
   
    break;

  case "background-color: #DF7401  !important;":
    $("#NoWait").show();
        $("#ActSegui").hide();
      $("#Wait").hide();
                  
    break;          
      case "":
    
        $("#ActSegui").show();
      $("#Wait").hide();
      $("#NoWait").hide();
    
    break;

  

}

}).change();

</script>

<script src="js/EditaCitaAgendav2.js"></script>
<style>
    			.divOculto {
			display: none;
		}
</style>
<?php else:?>
<p class="alert alert-danger">404 No se encuentra</p>
<?php endif;?>