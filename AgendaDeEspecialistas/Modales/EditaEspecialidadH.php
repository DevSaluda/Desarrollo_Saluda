<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
$user_id=null;
$sql1= "SELECT EspecialidadesV2.ID_Especialidad,EspecialidadesV2.Nombre_Especialidad,
EspecialidadesV2.Fk_Sucursal,EspecialidadesV2.ID_H_O_D,
EspecialidadesV2.Estatus_Especialidad,EspecialidadesV2.Codigocolor, 
Sucursales_CampañasV2.ID_SucursalC, Sucursales_CampañasV2.Nombre_Sucursal 
FROM EspecialidadesV2, Sucursales_CampañasV2 where EspecialidadesV2.Fk_Sucursal = Sucursales_CampañasV2.ID_SucursalC  AND EspecialidadesV2.ID_Especialidad=".$_POST["id"];
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

<form action="javascript:void(0)" method="post" id="ActualizaEspecialidades" >

  
    <label for="exampleFormControlInput1">Especialidad</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control" disabled value="<? echo $Especialidades->Nombre_Especialidad; ?>" 
   aria-describedby="basic-addon1">
</div>
    </div>
  
    <label for="exampleFormControlInput1">Sucursal</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control" id="sucursal" name="Sucursal" disabled value="<? echo $Especialidades->Nombre_Sucursal; ?>" 
   aria-describedby="basic-addon1">
</div>
    </div>
  </div>

<label for="exampleFormControlInput1">Estatus actual</label>
  
<div>
  <button class="btn btn-default btn-sm" style="<?php echo $Especialidades->Codigocolor; ?>"><? echo $Especialidades->Estatus_Especialidad; ?></button>
  
</div>
<label for="exampleFormControlInput1">Estatus despues de cambio</label>
  
<div>
  <button class="btn btn-default btn-sm" style="background-color:#b87455 !important">Vigente</button>
  
</div>


<input type="hidden" name="id" id="id"value="<?php echo $Especialidades->ID_Especialidad; ?>">
<button type="submit"  name="submit" id="submit"  class="btn btn-info">Aplicar cambios <i class="fas fa-check"></i></button>
                          
</form>


<script src="js/EditaEspecialidadH.js"></script>

<? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>