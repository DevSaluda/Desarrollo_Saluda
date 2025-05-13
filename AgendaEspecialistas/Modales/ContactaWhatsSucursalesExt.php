<?
include "../Consultas/db_connection.php";
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
Personal_Medico_Express.Nombre_Apellidos, Fechas_EspecialistasExt.ID_Fecha_Esp,Fechas_EspecialistasExt.Fecha_Disponibilidad, Horarios_Citas_Ext.ID_Horario,Horarios_Citas_Ext.Horario_Disponibilidad,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM AgendaCitas_EspecialistasExt,Especialidades_Express,Personal_Medico_Express,Fechas_EspecialistasExt,Horarios_Citas_Ext,SucursalesCorre WHERE AgendaCitas_EspecialistasExt.Fk_Especialidad = Especialidades_Express.ID_Especialidad AND AgendaCitas_EspecialistasExt.Fk_Especialista = Personal_Medico_Express.Medico_ID AND AgendaCitas_EspecialistasExt.Fk_Sucursal = SucursalesCorre.ID_SucursalC AND AgendaCitas_EspecialistasExt.Fecha =Fechas_EspecialistasExt.ID_Fecha_Esp 
AND AgendaCitas_EspecialistasExt.Hora = Horarios_Citas_Ext.ID_Horario AND AgendaCitas_EspecialistasExt.ID_Agenda_Especialista = ".$_POST["id"];
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

 <div id="cargaExt">
  <i  class="fas fa-sync fa-spin fa-4x fa-spin" ></i>
  </div>
  <div id="FinalizadoExt" style="display: none;">
  <i  class="fas fa-arrow-alt-circle-down fa-4x animated rotateIn"></i>
  </div>  
        <br> <br>
        <div id="GenerandoExt">
                <p>Espere un momento por favor, estamos generandoExt el mensaje</p>
                </div>
                <div id="GeneradoExt" style="display: none;"> 
                <p>Mensaje listo para enviar,solo haga click sobre el boton de abajo </p> 
                </div>
                <a class="btn btn-success" style="display:none;"id="EnvioExt" href="https://api.whatsapp.com/send?phone=+52<? echo $Especialidades->Telefono; ?>&text=¡Hola,<? echo $Especialidades->Nombre_Paciente; ?>! Te contactamos de las clínicas +Doctor consulta para la confirmación para su cita el día *<? echo FechaCastellano($Especialidades->Fecha_Disponibilidad) ?>  EN HORARIO DE <?echo date('h:i A', strtotime(($Especialidades->Horario_Disponibilidad)));?>* Te esperamos en nuestra clínica de <? echo $Especialidades->Nombre_Sucursal; ?>" target="_blank"><span class="fab fa-whatsapp"></span><span class="hidden-xs"></span></a>
   
<? else:?>
<p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>
<script type="text/javascript">
$(document).ready(function() {
    setTimeout(function() {
      $("#cargaExt").fadeOut(1200);
      $("#FinalizadoExt").fadeToggle(1300);
      $("#GenerandoExt").fadeOut(1300);
      $("#GeneradoExt").fadeToggle(1300);
        $("#EnvioExt").fadeToggle(1400);
       
       
    },3000);
 
   
});
</script>