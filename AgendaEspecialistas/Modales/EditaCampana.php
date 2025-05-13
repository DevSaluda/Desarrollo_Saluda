<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
$user_id=null;
$sql1= "select * from  Especialistas where ID_Especialista = ".$_POST["id"];
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

<form action="javascript:void(0)" method="post" id="ActualizaEspecialista" >
   
<label for="exampleFormControlInput1">Nombre Especialista</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control" value="<? echo $person->Nombre_Apellidos; ?>" name="ActualizaNombre" id="Nombre" aria-describedby="basic-addon1">
</div>
<label for="exampleFormControlInput1">Especialidad </label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
 <select name="ActualizaEspecialidad" id="especialidad" class="form-control">
                                               <option value="<? echo $person->Especialidad; ?>"><? echo $person->Especialidad; ?></option>
        <?
          $query = $conn -> query ("SELECT ID_Especialista,Nombre_Especialidad,ID_H_O_D FROM Especialidades WHERE ID_H_O_D='".$row['ID_H_O_D']."'");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[ID_Especialista].'">'.$valores[Nombre_Especialidad].'</option>';
          }
        ?>  </select>
</div>
<label for="exampleFormControlInput1">Telefono</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="number" class="form-control" value="<? echo $person->Tel; ?>" name="ActualizaTel" id="Tel" aria-describedby="basic-addon1">
</div>
<input type="hidden" name="id" value="<?php echo $person->ID_Especialista; ?>">
<button type="submit"  name="submit" id="submit"  class="btn btn-primary">Aplicar cambios <i class="fas fa-save"></i></button>
                          
</form>

<script src="js/EditaEspecialista.js"></script>

<? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>