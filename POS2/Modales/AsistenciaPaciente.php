<?php 
include "../Consultas/db_connection.php";
include "../Consultas/Sesion.php";
include "../Consultas/Consultas.php";
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
$user_id=null;
$sql1= "SELECT AgendaCitas_EspecialistasExt.ID_Agenda_Especialista,AgendaCitas_EspecialistasExt.Fk_Especialidad,AgendaCitas_EspecialistasExt.Fk_Especialista,
AgendaCitas_EspecialistasExt.Fk_Sucursal,AgendaCitas_EspecialistasExt.Fecha,AgendaCitas_EspecialistasExt.Hora,
AgendaCitas_EspecialistasExt.Nombre_Paciente,AgendaCitas_EspecialistasExt.Telefono,AgendaCitas_EspecialistasExt.Observaciones,AgendaCitas_EspecialistasExt.ID_H_O_D, Especialidades_Express.ID_Especialidad,Especialidades_Express.Nombre_Especialidad,Personal_Medico_Express.Medico_ID,
Personal_Medico_Express.Nombre_Apellidos, Fechas_EspecialistasExt.ID_Fecha_Esp,Fechas_EspecialistasExt.Fecha_Disponibilidad, Horarios_Citas_Ext.ID_Horario,Horarios_Citas_Ext.Horario_Disponibilidad,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM AgendaCitas_EspecialistasExt,Especialidades_Express,Personal_Medico_Express,Fechas_EspecialistasExt,Horarios_Citas_Ext,SucursalesCorre WHERE AgendaCitas_EspecialistasExt.Fk_Especialidad = Especialidades_Express.ID_Especialidad AND AgendaCitas_EspecialistasExt.Fk_Especialista = Personal_Medico_Express.Medico_ID AND AgendaCitas_EspecialistasExt.Fk_Sucursal = SucursalesCorre.ID_SucursalC AND AgendaCitas_EspecialistasExt.Fecha =Fechas_EspecialistasExt.ID_Fecha_Esp AND AgendaCitas_EspecialistasExt.Hora = Horarios_Citas_Ext.ID_Horario AND 
AgendaCitas_EspecialistasExt.ID_Agenda_Especialista = ".$_POST["id"];
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

  <form action="javascript:void(0)" method="post" id="AsistenciaDelPaciente" >

  <div class="form-group">
  <label for="exampleFormControlInput1">Paciente</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">

          <span class="input-group-text" id="Tarjeta"><i class="fas fa-hospital-user"></i></span>
        </div>
        <input type="text" class="form-control" readonly value="<? echo $Especialidades->Nombre_Paciente; ?>" aria-describedby="basic-addon1">
      </div>
  
  </div>
  <div class="form-group">
  <label for="exampleFormControlInput1">¿Asistió?</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">

          <span class="input-group-text" id="Tarjeta"><i class="fas fa-hospital-user"></i></span>
  <select aria-label="Default select example" class="form-control" name="Asistio" id="Asistio">
  <option selected>Elija una opción</option>
  <option value="Si">Si</option>
  <option value="No">No</option>
</select>
  
  </div></div></div>
  
  
  <input type="hidden" name="ID_CitaActualizada" id="IDCitaActualizada" value="<?php echo $Especialidades->ID_Agenda_Especialista; ?>">
  <input type="hidden" name="ActualizadoPor" id="actualizadopor" value="<?php echo $row['Nombre_Apellidos']?>">
  <button type="submit"  name="submit_Age" id="submit_Age"  class="btn btn-success">Confirmar <i class="fas fa-user-check"></i></button>
</form>

<script src="js/ConfirmaSiNoPaciente.js"></script>
<? else:?>
<p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>