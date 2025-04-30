<?php
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
$user_id=null;
$sql1= "select * from Resultados_Ultrasonidos where ID_resultado = ".$_POST["id"];
$query = $conn->query($sql1);
$person = null;
if($query->num_rows>0){
while ($r=$query->fetch_object()){
  $person=$r;
  break;
}

  }
?>

<?php if($person!=null):?>

  <form method="POST" action="SubeFotos.php" enctype="multipart/form-data">

<label for="exampleFormControlInput1">Nombre del paciente</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control" value="<?php echo $person->Nombre_paciente; ?>" name="Nombre" id="nombre" aria-describedby="basic-addon1">
</div>
<label for="exampleFormControlInput1">Nombre del paciente</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="file" class="form-control" name="upload[]" multiple>
</div>

<label for="estatus">Estatus</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="Estatus"><i class="fas fa-flag"></i></span>
  </div>
  <select class="form-control" name="Estatus" id="estatus" required>
    <option value="Entregado Fisico">Entregado</option>
    <option value="Pendiente">Pendiente</option>
  </select>
</div>

<button type="submit"  name="submit" id="submit"  class="btn btn-primary">Aplicar cambios <i class="fas fa-save"></i></button>
                          
</form>

<script src="js/Subefotos2.js"></script>

<?php else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<?php endif;?>