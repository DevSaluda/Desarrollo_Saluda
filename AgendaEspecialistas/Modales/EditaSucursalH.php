<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
$user_id=null;
$sql1= "SELECT * FROM Sucursales_CampañasV2 WHERE Estatus_Sucursal = 'Vencido' AND ID_SucursalC = ".$_POST["id"];
$query = $conn->query($sql1);
$Sucursales = null;
if($query->num_rows>0){
while ($r=$query->fetch_object()){
  $Sucursales=$r;
  break;
}

  }
?>

<? if($Sucursales!=null):?>

<form action="javascript:void(0)" method="post" id="VigenciaVencida" >

<label for="exampleFormControlInput1">Nombre de sucursal <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control" name="Sucursal" id="sucursal" readonly value="<? echo $Sucursales->Nombre_Sucursal; ?>">  
                                          
</div>
<label for="exampleFormControlInput1">Estatus actual</label>
  
<div>
  <button class="btn btn-default btn-sm" style="<?php echo $Sucursales->Color_Sucursal; ?>"><? echo $Sucursales->Estatus_Sucursal; ?></button>
  
</div>
<label for="exampleFormControlInput1">Estatus despues de cambio</label>
  
<div>
  <button class="btn btn-default btn-sm" style="background-color:#b87455 !important">VIGENTE</button>
  
</div>

<input type="hidden" name="ID"  id="id" value="<?php echo $Sucursales->ID_SucursalC; ?>">
<button type="submit"  name="submit" id="submit"  class="btn btn-info">Aplicar cambios <i class="fas fa-check"></i></button>
                          
</form>

<script src="js/EditaSucursalH.js"></script>

<? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>