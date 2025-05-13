<?
include "db_connection.php";

$user_id=null;
$sql1= "select * from Especialidades where ID_Especialista = ".$_POST["id"];
$query = $conn->query($sql1);
$person = null;
if($query->num_rows>0){
while ($r=$query->fetch_object()){
  $person=$r;
  break;
}

  }
?>

<? if($person!=null):?>

<form action="javascript:void(0)" method="post" id="ActualizaEspecial" >
   
<label for="exampleFormControlInput1">Nombre de especialidad</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control" value="<?php echo $person->Nombre_Especialidad; ?>" name="Especialidad" required  aria-describedby="basic-addon1">
</div>
 
  
<input type="hidden" name="id" value="<?php echo $person->ID_Especialista; ?>">
<button type="submit"  name="submit" id="submit"  class="btn btn-primary">Aplicar cambios <i class="fas fa-save"></i></button>
                          
</form>



<? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>