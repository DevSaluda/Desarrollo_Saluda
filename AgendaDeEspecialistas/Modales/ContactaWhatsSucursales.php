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
$sql1= "SELECT AgendaCitas_EspecialistasSucursales.ID_Agenda_Especialista,AgendaCitas_EspecialistasSucursales.Fk_Especialidad,AgendaCitas_EspecialistasSucursales.Fk_Especialista,
AgendaCitas_EspecialistasSucursales.Fk_Sucursal,AgendaCitas_EspecialistasSucursales.Fecha,AgendaCitas_EspecialistasSucursales.ID_H_O_D,
AgendaCitas_EspecialistasSucursales.Hora,AgendaCitas_EspecialistasSucursales.Nombre_Paciente,AgendaCitas_EspecialistasSucursales.Telefono,
SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal,Roles_Puestos.ID_rol,Roles_Puestos.Nombre_rol,
Personal_Medico.Medico_ID,Personal_Medico.Nombre_Apellidos,Fechas_Especialistas_Sucursales.ID_Fecha_Esp,Fechas_Especialistas_Sucursales.Fecha_Disponibilidad,Horarios_Citas_Sucursales.ID_Horario,Horarios_Citas_Sucursales.Horario_Disponibilidad FROM AgendaCitas_EspecialistasSucursales,SucursalesCorre,Roles_Puestos,Personal_Medico,Fechas_Especialistas_Sucursales,Horarios_Citas_Sucursales 
where AgendaCitas_EspecialistasSucursales.Fk_Especialidad = Roles_Puestos.ID_rol AND 
AgendaCitas_EspecialistasSucursales.Fk_Especialista= Personal_Medico.Medico_ID AND AgendaCitas_EspecialistasSucursales.Fk_Sucursal= SucursalesCorre.ID_SucursalC 
AND AgendaCitas_EspecialistasSucursales.Fecha = Fechas_Especialistas_Sucursales.ID_Fecha_Esp AND AgendaCitas_EspecialistasSucursales.Hora = Horarios_Citas_Sucursales.ID_Horario 
 AND AgendaCitas_EspecialistasSucursales.ID_Agenda_Especialista = ".$_POST["id"];
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

 <div id="carga">
  <i  class="fas fa-sync fa-spin fa-4x fa-spin" ></i>
  </div>
  <div id="Finalizado" style="display: none;">
  <i  class="fas fa-arrow-alt-circle-down fa-4x animated rotateIn"></i>
  </div>  
        <br> <br>
        <div id="Generando">
                <p>Espere un momento por favor, estamos generando el mensaje</p>
                </div>
                <div id="Generado" style="display: none;"> 
                <p>Mensaje listo para enviar,solo haga click sobre el boton de abajo </p> 
                </div>
                <a class="btn btn-success" style="display:none;"id="Envio" href="https://api.whatsapp.com/send?phone=+52<? echo $Especialidades->Telefono; ?>&text=¡Hola,<? echo $Especialidades->Nombre_Paciente; ?>! Te contactamos de las clínicas +Doctor consulta para la confirmación para su cita el día *<? echo FechaCastellano($Especialidades->Fecha_Disponibilidad) ?>  EN HORARIO DE <?echo date('h:i A', strtotime(($Especialidades->Horario_Disponibilidad)));?>* Te esperamos en nuestra clínica de <? echo $Especialidades->Nombre_Sucursal; ?>" target="_blank"><span class="fab fa-whatsapp"></span><span class="hidden-xs"></span></a>
   
<? else:?>
<p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>
<script type="text/javascript">
$(document).ready(function() {
    setTimeout(function() {
      $("#carga").fadeOut(1200);
      $("#Finalizado").fadeToggle(1300);
      $("#Generando").fadeOut(1300);
      $("#Generado").fadeToggle(1300);
        $("#Envio").fadeToggle(1400);
       
       
    },3000);
 
   
});
</script>