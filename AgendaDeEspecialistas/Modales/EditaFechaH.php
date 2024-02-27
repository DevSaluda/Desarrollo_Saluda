<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
$user_id=null;
$sql1= "SELECT Fechas_Especialistas.ID_Fecha_Esp,Fechas_Especialistas.Fecha_Disponibilidad,Fechas_Especialistas.ID_H_O_D, 
Fechas_Especialistas.FK_Especialista,Fechas_Especialistas.Estatus_fecha,Fechas_Especialistas.CodigoColorFe,Especialistas.ID_Especialista,Especialistas.Nombre_Apellidos 
FROM Fechas_Especialistas,Especialistas WHERE 
Fechas_Especialistas.FK_Especialista = Especialistas.ID_Especialista AND ID_Fecha_Esp = ".$_POST["id"];
$query = $conn->query($sql1);
$Fechas = null;
if($query->num_rows>0){
while ($r=$query->fetch_object()){
  $Fechas=$r;
  break;
}

  }
?>

<? if($Fechas!=null):?>

<form action="javascript:void(0)" method="post" id="ActualizaHorario" >
<label for="exampleFormControlInput1">Nombre Especialista</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control" value="<? echo $Fechas->Nombre_Apellidos; ?>" readonly  aria-describedby="basic-addon1">
</div>

<label for="exampleFormControlInput1">Fecha</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="date" class="form-control" value="<? echo $Fechas->Fecha_Disponibilidad; ?>" name="ActualizaFecha" id="fechact" aria-describedby="basic-addon1">
</div>
<label for="exampleFormControlInput1">Estatus</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <select name="Color" class="form-control" id="colorpago" onchange="ShowSelected();">
									  <option value="<? echo $Fechas->CodigoColorFe; ?>"><? echo $Fechas->Estatus_fecha; ?></option>
              <option  value="btn btn-dark btn-sm">Inactivo</option>
              <option  value="btn btn-success btn-sm">Activo</option>
              						  
						 </select>
</div>

<input type="hidden" class="form-control" id="estatus"   name="Estatus"  value="<? echo $Fechas->Estatus_fecha; ?>">
<input type="hidden" name="id" value="<?php echo $Fechas->ID_Fecha_Esp; ?>">
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

<script src="js/EditaFechaH.js"></script>

<? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>