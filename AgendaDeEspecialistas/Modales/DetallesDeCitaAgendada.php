<?
include "../Consultas/db_connection.php";

$user_id=null;
$sql1= "SELECT AgendaCitas_EspecialistasV2.ID_Agenda_Especialista,AgendaCitas_EspecialistasV2.Fk_Especialidad,
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
AgendaCitas_EspecialistasV2.Fk_Costo =  Costos_EspecialistasV2.ID_Costo_Esp AND AgendaCitas_EspecialistasV2.ID_Agenda_Especialista = ".$_POST["id"];
$query = $conn->query($sql1);
$Especialidades = null;
if($query->num_rows>0){
while ($r=$query->fetch_object()){
  $Especialidades=$r;
  break;
}

  }
?>

<? if($Especialidades!=null):?>

<form action="javascript:void(0)" method="post" id="Actualizacita">
  <div class="form-row">
    <div class="col">
      <label for="exampleFormControlInput1">Especialidad </label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">

          <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
        </div>
        <input type="text" class="form-control" readonly value="<? echo $Especialidades->Nombre_Especialidad; ?>" aria-describedby="basic-addon1">
      </div>
    </div>
    <div class="col">
      <label for="exampleFormControlInput1">Paciente</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">

          <span class="input-group-text" id="Tarjeta"><i class="fas fa-hospital-user"></i></span>
        </div>
        <input type="text" class="form-control" readonly value="<? echo $Especialidades->Nombre_Paciente; ?>" aria-describedby="basic-addon1">
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
          <option value="<? echo $Especialidades->Color_Pago; ?>">
            <? echo $Especialidades->Estatus_pago; ?>
          </option>

          <option value="btn btn-success btn-sm">Pagado</option>
          <option value="btn btn-warning btn-sm">Pendiente</option>
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
          <option value="<? echo $Especialidades->ColorEstatusCita; ?>">
            <? echo $Especialidades->Estatus_cita; ?>
          </option>

          <option value="btn btn-primary btn-sm">Finalizada</option>
          <option value="btn btn-warning btn-sm">Sin Confirmar</option>
           <option value="btn btn-danger btn-sm">Cancelada</option>
              <option value="btn btn-success btn-sm">Confirmada</option>
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
                    <option value="<? echo $Especialidades->ColorEstatusCita; ?>">
            <? echo $Especialidades->Estatus_Seguimiento; ?>
          </option>
                    
				
              <option  value="btn btn-primary btn-sm">Completo</option>		
              <option  value="btn btn-info btn-sm">En espera</option>						  
						 </select>
</div>
    </div>
  </div>
  <label for="exampleFormControlInput1">Observaciones</label>
  <div class="input-group mb-3">
    <div class="input-group-prepend">

      <span class="input-group-text" id="Tarjeta"><i class="fas fa-comment-dots"></i></span>
    </div>
    <textarea id="observaciones" class="form-control form-control-sm" name="Observaciones" rows="2" cols="50">
    <? echo $Especialidades->Observaciones; ?>
  </textarea>
  </div>
  <div class="form-row">
    <div class="col">
      <label for="exampleFormControlInput1">Agendado por: </label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">

          <span class="input-group-text" id="Tarjeta"><i class="far fa-hand-point-right"></i></span>
        </div>
        <input type="text" class="form-control" readonly value="<? echo $Especialidades->AgendadoPor; ?>" aria-describedby="basic-addon1">
      </div>
    </div>
    <div class="col">
      <label for="exampleFormControlInput1">Desde el sistema</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">

          <span class="input-group-text" id="Tarjeta"><i class="fas fa-laptop-code"></i></span>
        </div>
        <input type="text" class="form-control" readonly value="<? echo $Especialidades->Sistema; ?>" aria-describedby="basic-addon1">
      </div>
    </div>
    </div>
  <input type="hidden" name="EstatusPago" value="<? echo $Especialidades->Estatus_pago; ?>"id="estatuspago">
  <input type="hidden" name="EstatusCita" value=" <? echo $Especialidades->Estatus_cita; ?>" id="estatuscita">
  <input type="hidden" name="Estatusseguimiento" value=" <? echo $Especialidades->Estatus_Seguimiento; ?>" id="estatussigue">
  <input type="hidden" name="id" value="<?php echo $Especialidades->ID_Agenda_Especialista; ?>">
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
</script>

<script src="js/EditaCita.js"></script>

<? else:?>
<p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>