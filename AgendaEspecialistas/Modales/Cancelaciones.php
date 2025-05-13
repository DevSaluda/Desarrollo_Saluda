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
AgendaCitas_EspecialistasV3.Fk_Costo =  Costos_EspecialistasV2.ID_Costo_Esp AND AgendaCitas_EspecialistasV3.ID_Agenda_Especialista = ".$_POST["id"];
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

<form action="javascript:void(0)" method="post" id="Cancelaciones">
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

  
  <div class="table-responsive">
  <table class="table table-bordered">
  <thead>
    <tr>
     
     
    <th scope="col" style="
    background-color: #f00 !important;">Estatus de pago</th>
     <th scope="col" style="
    background-color: #f00 !important;">Estatus de cita</th>
       <th scope="col" style="
    background-color: #f00 !important;">Estatus de seguimiento</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      
     
      <td><button id="Cancelada" class="divOculto btn btn-default btn-sm" style="background-color: #FF0000 !important;">Cancelada</button></td> <td>
      <button id="Cancelada" class="divOculto btn btn-default btn-sm" style="background-color: #FF0000 !important;">Cancelada</button></td>
      <td><button id="Cancelada" class="divOculto btn btn-default btn-sm" style="background-color: #FF0000 !important;">Cancelada</button></td>
    </tr>
    
  
  </tbody>
</table>
</div>
  
  <input type="hidden" name="id" id="id" value="<?php echo $Especialidades->ID_Agenda_Especialista; ?>">
  <button type="submit" name="submit" id="submit" class="btn btn-primary">Validar cancelacion <i class="fas fa-user-times"></i></button>

</form>
<form action="javascript:void(0)" method="post" id="CancelaCompleto">
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
        <input type="text" class="form-control" readonly value="<?php  echo $Especialidades->Nombre_Paciente; ?>" aria-describedby="basic-addon1">
      </div>
    </div>
    
  </div>

  
  <div class="table-responsive">
  <table class="table table-bordered">
  <thead>
    <tr>
     
     
    <th scope="col" style="
    background-color: #f00 !important;">Estatus de pago</th>
     <th scope="col" style="
    background-color: #f00 !important;">Estatus de cita</th>
       <th scope="col" style="
    background-color: #f00 !important;">Estatus de seguimiento</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      
     
      <td><button  class=" btn btn-default btn-sm" style="background-color: #FF0000 !important;">Cancelada</button></td> <td>
      <button  class="btn btn-default btn-sm" style="background-color: #FF0000 !important;">Cancelada</button></td>
      <td><button  class="btn btn-default btn-sm" style="background-color: #FF0000 !important;">Cancelada</button></td>
    </tr>
    
  
  </tbody>
</table>
</div>
  
  <input type="hidden" name="idcancela" id="idcancela" value="<?php echo $Especialidades->ID_Agenda_Especialista; ?>">
  <button type="submit" name="submit_Cancela" id="submit_Cancela" class="btn btn-danger">Ejecutar Cancelacion <i class="fas fa-user-slash"></i></button>

</form>
<script src="js/AplicaCancelacionV2.js"></script>
<script src="js/RealizaCancelacionV2.js"></script>
<?php else:?>
<p class="alert alert-danger">404 No se encuentra</p>
<?php endif;?>