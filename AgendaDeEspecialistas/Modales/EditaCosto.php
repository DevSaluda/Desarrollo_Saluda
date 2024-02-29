<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
$user_id=null;
$sql1= "SELECT Costos_EspecialistasV2.ID_Costo_Esp,Costos_EspecialistasV2.Costo_Especialista,
Costos_EspecialistasV2.ID_H_O_D,Costos_EspecialistasV2.FK_Especialista,Costos_EspecialistasV2.Estatus,Costos_EspecialistasV2.Codigocolor,
EspecialistasV2.ID_Especialista,EspecialistasV2.Nombre_Apellidos FROM Costos_EspecialistasV2,EspecialistasV2 WHERE
Costos_EspecialistasV2.FK_Especialista = EspecialistasV2.ID_Especialista AND Costos_EspecialistasV2.ID_Costo_Esp = ".$_POST["id"];
$query = $conn->query($sql1);
$Costos = null;
if($query->num_rows>0){
while ($r=$query->fetch_object()){
  $Costos=$r;
  break;
}

  }
?>

<? if($Costos!=null):?>

<form action="javascript:void(0)" method="post" id="CambioVigenciaCosto" >
<label for="exampleFormControlInput1">Nombre Especialista</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control" value="<? echo $Costos->Nombre_Apellidos; ?>" readonly  aria-describedby="basic-addon1">
</div>

<label for="exampleFormControlInput1">Costo</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  
  <input type="number" class="form-control" value="<? echo $Costos->Costo_Especialista; ?>" disabled aria-describedby="basic-addon1">
</div>
<label for="exampleFormControlInput1">Estatus actual</label>
  
<div>
  <button class="btn btn-default btn-sm" style="<?php echo $Costos->Codigocolor; ?>"><? echo $Costos->Estatus; ?></button>
  
</div>
<label for="exampleFormControlInput1">Estatus despues de cambio</label>
  
<div>
  <button class="btn btn-default btn-sm" style="background-color:#80391e !important">Vencido</button>
  
</div>



<input type="hidden" name="id" id="id" value="<?php echo $Costos->ID_Costo_Esp; ?>">
<button type="submit"  name="submit" id="submit"  class="btn btn-info">Aplicar cambios <i class="fas fa-check"></i></button>
                          
</form>

<script src="js/EditaCosto.js"></script>

<? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>