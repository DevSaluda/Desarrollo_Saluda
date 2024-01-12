<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
$user_id=null;
$sql1= "SELECT * FROM Roles_Puestos WHERE ID_rol = ".$_POST["id"];
$query = $conn->query($sql1);
$Especialistas = null;
if($query->num_rows>0){
while ($r=$query->fetch_object()){
  $Especialistas=$r;
  break;
}

  }
?>

<? if($Especialistas!=null):?>

<form action="javascript:void(0)" method="post" id="ActualizaEmpleadoss" >


<div class="form-group">
    <label for="exampleFormControlInput1">Fecha de nacimiento </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " name="ActNombress" id="actnombress" value="<? echo $Especialistas->Nombre_Sucursal; ?>" aria-describedby="basic-addon1" maxlength="60">
  <input type="text" class="form-control " name="ActEstado" id="actestado" hidden value="1" aria-describedby="basic-addon1" maxlength="60">
    </div>
    </div>
    
   

    <input type="text" class="form-control" hidden name="AgregaActs" id="agregaacts"  readonly value=" <?echo $row['Nombre_Apellidos']?>">
    <input type="text" class="form-control"  hidden name="SistemaActs" id="sistemaacts"  readonly value=" <?echo $row['Nombre_rol']?>">
<input type="hidden" name="ids" id="ids" hidden value="<?php echo $Especialistas->ID_rol; ?>">
<button type="submit"  id="submit"  class="btn btn-info">Aplicar cambios <i class="fas fa-check"></i></button>
</form>

<script src="js/DescontinuaRol.js"></script>
<? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>
