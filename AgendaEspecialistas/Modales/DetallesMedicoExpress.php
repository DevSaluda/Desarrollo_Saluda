<?php
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
$sql1= "SELECT Personal_Medico_Express.Medico_ID,Personal_Medico_Express.Nombre_Apellidos,Personal_Medico_Express.Correo_Electronico, 
Personal_Medico_Express.Telefono,Personal_Medico_Express.Especialidad_Express,Personal_Medico_Express.ID_H_O_D,Personal_Medico_Express.Estatus,
Especialidades_Express.ID_Especialidad,Especialidades_Express.Nombre_Especialidad FROM Personal_Medico_Express,Especialidades_Express WHERE 
Personal_Medico_Express.Especialidad_Express= Especialidades_Express.ID_Especialidad AND Personal_Medico_Express.Medico_ID = ".$_POST["id"];
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
      <label for="exampleFormControlInput1">Doctor</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">

          <span class="input-group-text" id="Tarjeta"><i class="fas fa-hospital-user"></i></span>
        </div>
        <input type="text" class="form-control" readonly value="<?php echo $Especialidades->Nombre_Apellidos; ?>" aria-describedby="basic-addon1">
      </div>
    </div>
    
  </div>
 

<?php else:?>
<p class="alert alert-danger">404 No se encuentra</p>
<?php endif;?>