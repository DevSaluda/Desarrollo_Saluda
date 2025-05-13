<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
$user_id=null;
$sql1= "SELECT Costos_Especialistas.ID_Costo_Esp,Costos_Especialistas.Costo_Especialista,
Costos_Especialistas.ID_H_O_D,Costos_Especialistas.FK_Especialista,Costos_Especialistas.Estatus,Costos_Especialistas.Codigocolor,
Especialistas.ID_Especialista,Especialistas.Nombre_Apellidos FROM Costos_Especialistas,Especialistas WHERE
Costos_Especialistas.FK_Especialista = Especialistas.ID_Especialista AND Costos_Especialistas.ID_Costo_Esp = ".$_POST["id"];
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

<form action="javascript:void(0)" method="post" id="ActualizaHorario" >
<label for="exampleFormControlInput1">Nombre Especialista</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control" value="<? echo $person->Nombre_Apellidos; ?>" readonly  aria-describedby="basic-addon1">
</div>

<label for="exampleFormControlInput1">Costo</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  
  <input type="number" class="form-control" value="<? echo $person->Costo_Especialista; ?>" name="ActualizaCosto" id="Costo" aria-describedby="basic-addon1">
</div>
<label for="exampleFormControlInput1">Estatus</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <select name="Color" class="form-control" id="colorpago" onchange="ShowSelected();">
									  <option value="<? echo $person->Codigocolor; ?>"><? echo $person->Estatus; ?></option>
				
              <option  value="btn btn-success btn-sm">Activo</option>		
              <option  value="btn btn-dark btn-sm">Inactivo</option>						  
						 </select>
</div>
<input type="text" class="form-control" id="empleado" name="Empleado" hidden   value="<? echo $row['Nombre_Apellidos']?>">
<input type="text" class="form-control" id="estatus" name="Estatus" hidden  value="<? echo $person->Estatus; ?>">
<input type="hidden" name="id" value="<?php echo $person->ID_Costo_Esp; ?>">
<button type="submit"  name="submit" id="submit"  class="btn btn-primary">Aplicar cambios <i class="fas fa-save"></i></button>
                          
</form>
<script type="text/javascript">
function ShowSelected()
{

 
/* Para obtener el texto */
var combo = document.getElementById("colorpago");
var selected = combo.options[combo.selectedIndex].text;
$("#estatus").val(selected);
}

</script>
<script src="js/EditaCostoH.js"></script>

<? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>