<?
include "../Consultas/db_connection.php";

$user_id=null;
$sql1= "SELECT AgendaCitas_Especialistas.ID_Agenda_Especialista,AgendaCitas_Especialistas.Fk_Especialidad,
AgendaCitas_Especialistas.Fk_Especialista,AgendaCitas_Especialistas.Fk_Sucursal,
AgendaCitas_Especialistas.Fk_Fecha,AgendaCitas_Especialistas.Fk_Hora,AgendaCitas_Especialistas.Nombre_Paciente,
AgendaCitas_Especialistas.Telefono,AgendaCitas_Especialistas.Tipo_Consulta,
AgendaCitas_Especialistas.Estatus_pago,AgendaCitas_Especialistas.Color_Pago,AgendaCitas_Especialistas.Estatus_cita,
AgendaCitas_Especialistas.Observaciones,AgendaCitas_Especialistas.ColorEstatusCita,AgendaCitas_Especialistas.Estatus_Seguimiento,
AgendaCitas_Especialistas.Color_Seguimiento,AgendaCitas_Especialistas.ID_H_O_D,AgendaCitas_Especialistas.AgendadoPor,AgendaCitas_Especialistas.Sistema,
Especialidades.ID_Especialidad,Especialidades.Nombre_Especialidad,Especialistas.ID_Especialista,Especialistas.Nombre_Apellidos,
Sucursales_Campañas.ID_SucursalC ,Sucursales_Campañas.Nombre_Sucursal,Fechas_Especialistas.ID_Fecha_Esp,Fechas_Especialistas.Fecha_Disponibilidad,
Horarios_Citas_especialistas.ID_Horario,Horarios_Citas_especialistas.Horario_Disponibilidad, Costos_Especialistas.ID_Costo_Esp,Costos_Especialistas.Costo_Especialista
FROM AgendaCitas_Especialistas,Especialidades,Especialistas,Sucursales_Campañas,Fechas_Especialistas,Horarios_Citas_especialistas,
Costos_Especialistas WHERE
AgendaCitas_Especialistas.Fk_Especialidad = Especialidades.ID_Especialidad AND AgendaCitas_Especialistas.Fk_Especialista =Especialistas.ID_Especialista AND
AgendaCitas_Especialistas.Fk_Sucursal =Sucursales_Campañas.ID_SucursalC AND
AgendaCitas_Especialistas.Fk_Fecha = Fechas_Especialistas.ID_Fecha_Esp AND
AgendaCitas_Especialistas.Fk_Hora = Horarios_Citas_especialistas.ID_Horario AND
AgendaCitas_Especialistas.Fk_Costo =  Costos_Especialistas.ID_Costo_Esp AND ID_Agenda_Especialista = ".$_POST["id"];
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
    <div class="col">
      <label for="exampleFormControlInput1">Telefono</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">

          <span class="input-group-text" id="Tarjeta"><i class="fas fa-phone"></i></span>
        </div>
        <input type="text" class="form-control" readonly value="<? echo $Especialidades->Telefono; ?>" aria-describedby="basic-addon1">
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