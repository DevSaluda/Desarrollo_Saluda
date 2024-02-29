<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
$user_id=null;
$sql1= "SELECT Personal_Medico_Express.Medico_ID,Personal_Medico_Express.Nombre_Apellidos,Personal_Medico_Express.Correo_Electronico, 
Personal_Medico_Express.Telefono,Personal_Medico_Express.Especialidad_Express,Personal_Medico_Express.ID_H_O_D,Personal_Medico_Express.Estatus,
 Especialidades_Express.ID_Especialidad,Especialidades_Express.Nombre_Especialidad, Especialidades_Express.Fk_Sucursal,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal 
 FROM Personal_Medico_Express,Especialidades_Express, SucursalesCorre WHERE Personal_Medico_Express.Especialidad_Express= Especialidades_Express.ID_Especialidad
  AND Especialidades_Express.Fk_Sucursal = SucursalesCorre.ID_SucursalC AND Personal_Medico_Express.Medico_ID = ".$_POST["id"];
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



<input type="hidden" name="id" id="id" value="<?php echo $Especialistas->Medico_ID; ?>">
<button type="submit"  name="submit" id="submit"  class="btn btn-primary">Actualizar información <i class="fas fa-pen-alt"></i></button>
                          
</form>

<script src="js/ActualizaDataMedicoExpress.js"></script>

<? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>