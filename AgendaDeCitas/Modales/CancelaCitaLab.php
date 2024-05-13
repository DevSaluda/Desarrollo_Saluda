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
$sql1= "SELECT Agenda_Labs.Id_genda,Agenda_Labs.Nombres_Apellidos,Agenda_Labs.Telefono,Agenda_Labs.Fk_sucursal,
Agenda_Labs.Medico,Agenda_Labs.Fecha,Agenda_Labs.Turno,Agenda_Labs.Motivo_Consulta,Agenda_Labs.Agrego,Agenda_Labs.AgregadoEl, SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM
Agenda_Labs, SucursalesCorre WHERE Agenda_Labs.Id_genda = ".$_POST["id"];
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

  <form action="javascript:void(0)" method="post" id="CancelaCitaDeSucursaless" >
  <div class="form-row">
    <div class="col">
      <label for="exampleFormControlInput1">Paciente</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">

          <span class="input-group-text" id="Tarjeta"><i class="fas fa-hospital-user"></i></span>
        </div>
        <input type="text" class="form-control" readonly value="<? echo $Especialidades->Nombre_Apellidos; ?>" aria-describedby="basic-addon1">
      </div>
    </div>
    
  </div>
    <div class="col">
      <label for="exampleFormControlInput1">Fecha </label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">

          <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
        </div>
        <input type="text" class="form-control" readonly value="<? echo FechaCastellano($Especialidades->Fecha); ?>" aria-describedby="basic-addon1">
      </div>
    </div>
    

  <input type="hidden" name="id" id="idcancela" value="<?php echo $Especialidades->Id_genda; ?>">
  
  <button type="submit"  name="submit_Age" id="submit_Age"  class="btn btn-danger">Cancelar <i class="fas fa-user-check"></i></button>
</form>

<script src="js/RealizaCancelacionRevaloracion.js"></script>
<? else:?>
<p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>