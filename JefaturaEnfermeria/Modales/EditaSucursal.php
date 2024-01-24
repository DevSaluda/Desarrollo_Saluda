<?php
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";

$user_id=null;
$sql1= "SELECT * FROM SucursalesCorre WHERE ID_SucursalC = ".$_POST["id"];
$query = $conn->query($sql1);
$Especialistas = null;
if($query->num_rows>0){
while ($r=$query->fetch_object()){
  $Especialistas=$r;
  break;
}

  }
?>

<?php if($Especialistas!=null):?>

<form action="javascript:void(0)" method="post" id="ActualizaEmpleados" >


<div class="form-group">
    <label for="exampleFormControlInput1">Fecha de nacimiento </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " name="ActNombres" id="actnombres" value="<?php echo $Especialistas->Nombre_Sucursal; ?>" aria-describedby="basic-addon1" maxlength="60">
    </div>
    </div>
    
    <div class="form-group">
      
    <label for="exampleFormControlInput1">Telefono <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="number" class="form-control " name="AcTtelefono" id="acttelefono" value="<?php echo $Especialistas->Telefono; ?>" aria-describedby="basic-addon1" >            
</div></div></div>

    <input type="text" class="form-control"  hidden name="AgregaAct" id="agregaact"  readonly value=" <?php echo $row['Nombre_Apellidos']?>">
    <input type="text" class="form-control"  hidden name="SistemaAct" id="sistemaact"  readonly value=" <?php echo $row['Nombre_rol']?>">
<input type="hidden" name="id" id="id" hidden value="<?php echo $Especialistas->ID_SucursalC; ?>">
<button type="submit"  id="submit"  class="btn btn-info">Aplicar cambios <i class="fas fa-check"></i></button>
</form>

<script src="js/ActualizaSucursales.js"></script>
<?php  else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<?php endif;?>
