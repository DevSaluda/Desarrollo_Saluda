<?
include "../Consultas/db_connection.php";
include "../Consultas/Sesion.php";
include "../Consultas/Consultas.php";
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
AgendaCitas_EspecialistasV3.Fk_Costo =  Costos_EspecialistasV2.ID_Costo_Esp AND
AgendaCitas_EspecialistasV3.ID_H_O_D='".$row['ID_H_O_D']."' AND AgendaCitas_EspecialistasV3.ID_Agenda_Especialista = ".$_POST["id"];
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

    <div class="container">
  <div class="row">
    <div class="col"> 
      <label for="exampleFormControlInput1">Paciente</label> <br>
      <i class="fas fa-id-card-alt"></i> <br>
        <? echo $Especialidades->Nombre_Paciente; ?>  </div>
    <div class="col"> <label for="exampleFormControlInput1">Telefono</label> <br>
    <i class="fas fa-phone"></i> <br>
      <a href="tel:+<? echo $Especialidades->Telefono; ?>"> <? echo $Especialidades->Telefono; ?> </a>
    </div>
    <div class="w-100"></div> <br>
    <div class="col"> <label for="exampleFormControlInput1">Whatsapp</label> <br>
    <i class="fab fa-whatsapp"></i> <br>
      <a href="https://api.whatsapp.com/send/?phone=%2B52<? echo $Especialidades->Telefono; ?>"> <? echo $Especialidades->Telefono; ?> </a>  </div>
    <div class="col"> <label for="exampleFormControlInput1">Correo</label> <br>
    <i class="fas fa-envelope-square"></i> <br>
      <a href="mailto:<? echo $Especialidades->Correo; ?>"> <? echo $Especialidades->Correo; ?></a>  </div>
    
  </div> <br>

      
       
       
   
   
<? else:?>
<p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>