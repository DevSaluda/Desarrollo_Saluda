<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
$user_id=null;
$sql1= "SELECT EspecialistasV2.ID_Especialista,EspecialistasV2.Nombre_Apellidos,EspecialistasV2.Especialidad,EspecialistasV2.Tel,
 EspecialistasV2.ID_H_O_D,EspecialistasV2.Estatus_Especialista,EspecialistasV2.Correo,EspecialistasV2.CodigoColorEs,EspecialistasV2.Fk_Sucursal,
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

<form action="javascript:void(0)" method="post" id="ActualizaEspecialista" >
   
<label for="exampleFormControlInput1">Nombre Especialista</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control" value="<? echo $Especialistas->Nombre_Apellidos; ?>" id="actnombres" name="ActNombres"aria-describedby="basic-addon1">
</div>
<label for="exampleFormControlInput1">Especialidad </label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control" value="<? echo $Especialistas->Nombre_Especialidad; ?>" disabled aria-describedby="basic-addon1">
                                            
</div>
<label for="exampleFormControlInput1">Telefono</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="number" class="form-control" value="<? echo $Especialistas->Tel; ?>" name="ActTel" id="acttel" aria-describedby="basic-addon1">
</div>
<label for="exampleFormControlInput1">Correo</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control" value="<? echo $Especialistas->Correo; ?>" name="ActCorreo" id="actcorreo" aria-describedby="basic-addon1">
</div>

<label for="exampleFormControlInput1">Sucursal</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" readonly class="form-control" value="<? echo $Especialistas->Nombre_Sucursal; ?>"  aria-describedby="basic-addon1">
</div>



<input type="hidden" name="id" id="id" value="<?php echo $Especialistas->ID_Especialista; ?>">
<button type="submit"  name="submit" id="submit"  class="btn btn-primary">Actualizar información <i class="fas fa-pen-alt"></i></button>
                          
</form>

<script src="js/ActualizaInfoEspecialista.js"></script>

<? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>