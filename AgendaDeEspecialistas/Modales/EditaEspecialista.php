<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
$user_id=null;
$sql1= "SELECT EspecialistasV2.ID_Especialista,EspecialistasV2.Nombre_Apellidos,EspecialistasV2.Especialidad,EspecialistasV2.Tel,
 EspecialistasV2.ID_H_O_D,EspecialistasV2.Estatus_Especialista,EspecialistasV2.CodigoColorEs,EspecialistasV2.Fk_Sucursal,
  EspecialidadesV2.ID_Especialidad,EspecialidadesV2.Nombre_Especialidad,Sucursales_CampañasV2.ID_SucursalC, Sucursales_CampañasV2.Nombre_Sucursal 
  FROM EspecialistasV2,EspecialidadesV2,Sucursales_CampañasV2 WHERE EspecialistasV2.Especialidad = EspecialidadesV2.ID_Especialidad AND 
  EspecialistasV2.Fk_Sucursal =Sucursales_CampañasV2.ID_SucursalC AND EspecialistasV2.Estatus_Especialista='Vigente' AND ID_Especialista = ".$_POST["id"];
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

<form action="javascript:void(0)" method="post" id="EspecialistaVencido" >
   
<label for="exampleFormControlInput1">Nombre Especialista</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control" value="<? echo $Especialistas->Nombre_Apellidos; ?>" disabled aria-describedby="basic-addon1">
</div>
<label for="exampleFormControlInput1">Especialidad </label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control" value="<? echo $Especialistas->Nombre_Especialidad; ?>" disabled aria-describedby="basic-addon1">
                                            
</div>
<label for="exampleFormControlInput1">Sucursal</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" readonly class="form-control" value="<? echo $Especialistas->Nombre_Sucursal; ?>"  aria-describedby="basic-addon1">
</div>
<label for="exampleFormControlInput1">Estatus actual</label>
  
<div>
  <button class="btn btn-default btn-sm" style="<?php echo $Especialistas->CodigoColorEs; ?>"><? echo $Especialistas->Estatus_Especialista; ?></button>
  
</div>
<label for="exampleFormControlInput1">Estatus despues de cambio</label>
  
<div>
  <button class="btn btn-default btn-sm" style="background-color:#80391e !important">Vencido</button>
  
</div>

<input type="hidden" name="id" id="id" value="<?php echo $Especialistas->ID_Especialista; ?>">
<button type="submit"  name="submit" id="submit"  class="btn btn-info">Aplicar cambios <i class="fas fa-check"></i></button>
                          
</form>
<script src="js/EditaEspecialista.js"></script>

<? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>