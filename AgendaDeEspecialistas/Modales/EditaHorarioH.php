<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
$user_id=null;
$sql1= "SELECT Horarios_Citas_especialistas.ID_Horario,Horarios_Citas_especialistas.Horario_Disponibilidad,
Horarios_Citas_especialistas.ID_H_O_D,Horarios_Citas_especialistas.FK_Especialista,Horarios_Citas_especialistas.Estatus_Horario,
Horarios_Citas_especialistas.CodigoColorHo,Especialistas.ID_Especialista,
Especialistas.Nombre_Apellidos FROM Horarios_Citas_especialistas,Especialistas WHERE
Horarios_Citas_especialistas.FK_Especialista = Especialistas.ID_Especialista AND ID_Horario = ".$_POST["id"];
$query = $conn->query($sql1);
$Horario = null;
if($query->num_rows>0){
while ($r=$query->fetch_object()){
  $Horario=$r;
  break;
}

  }
?>

<? if($Horario!=null):?>

<form action="javascript:void(0)" method="post" id="ActualizaHorario" >
<label for="exampleFormControlInput1">Nombre Especialista</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control" value="<? echo $Horario->Nombre_Apellidos; ?>" readonly  id="Nombre" aria-describedby="basic-addon1">
</div>

<label for="exampleFormControlInput1">Horario</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="time" class="form-control" value="<? echo $Horario->Horario_Disponibilidad; ?>" name="ActualizarHorario" id="Horario" aria-describedby="basic-addon1">
</div>
<label for="exampleFormControlInput1">Estatus</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <select name="Color" class="form-control" id="colorpago" onchange="ShowSelected();">
									  <option value="<? echo $Horario->CodigoColorHo; ?>"><? echo $Horario->Estatus_Horario; ?></option>
              <option  value="btn btn-dark btn-sm">Inactivo</option>
              <option  value="btn btn-success btn-sm">Activo</option>
              						  
						 </select>
</div>

<input type="text" class="form-control" id="estatus"  hidden name="Estatus"  value="<? echo $Horario->Estatus_Horario; ?>">

<input type="hidden" name="id" value="<?php echo $Horario->ID_Horario; ?>">
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
<script src="js/EditaHorarioH.js"></script>

<? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>