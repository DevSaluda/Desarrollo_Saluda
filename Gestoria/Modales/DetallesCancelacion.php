<?
include "../Consultas/db_connection.php";

$user_id=null;
$sql1= "SELECT Cancelaciones_Agenda.ID_Agenda_Especialista,Cancelaciones_Agenda.Fk_Especialidad,
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
Cancelaciones_Agenda.Fk_Costo =  Costos_EspecialistasV2.ID_Costo_Esp AND Cancelaciones_Agenda.ID_Agenda_Especialista = ".$_POST["id"];
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
  


<? else:?>
<p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>