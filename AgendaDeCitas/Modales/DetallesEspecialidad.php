<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
$user_id=null;
$sql1= "SELECT EspecialidadesV2.ID_Especialidad,EspecialidadesV2.Nombre_Especialidad,
EspecialidadesV2.Fk_Sucursal,EspecialidadesV2.ID_H_O_D,
EspecialidadesV2.Estatus_Especialidad,EspecialidadesV2.Codigocolor,EspecialidadesV2.AgregadoPor,EspecialidadesV2.AgregadoEl, 
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
  <input type="text" class="form-control" disabled value="<? echo $Especialidades->Nombre_Sucursal; ?>" 
  aria-describedby="basic-addon1">
</div>
   

<label for="exampleFormControlInput1">Estatus actual</label>
  
<div>
  <button class="btn btn-default btn-sm" style="<?php echo $Especialidades->Codigocolor; ?>"><? echo $Especialidades->Estatus_Especialidad; ?></button>
  
</div>
<label for="exampleFormControlInput1">Agregado por</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control" disabled value="<? echo $Especialidades->AgregadoPor; ?>" 
   aria-describedby="basic-addon1">
</div>
    </div>
  
    <label for="exampleFormControlInput1">Agregado en</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control" disabled value="<? echo $Especialidades->AgregadoEl; ?>" 
  aria-describedby="basic-addon1">
</div>
   


<input type="hidden" name="id" value="<?php echo $Especialidades->ID_Especialidad; ?>">




<? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>