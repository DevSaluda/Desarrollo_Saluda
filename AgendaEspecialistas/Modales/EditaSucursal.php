<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
$user_id=null;
$sql1= "SELECT Sucursales_especialistas.ID_Sucursal,Sucursales_especialistas.Nombre_Sucursal,
Sucursales_especialistas.ID_H_O_D,Sucursales_especialistas.FK_Especialista,Sucursales_especialistas.Estatus_Sucursal,
Sucursales_especialistas.CodigoColorSu, Especialistas.ID_Especialista,Especialistas.Nombre_Apellidos FROM Sucursales_especialistas,
Especialistas where Sucursales_especialistas.FK_Especialista = Especialistas.ID_Especialista AND ID_Sucursal = ".$_POST["id"];
$query = $conn->query($sql1);
$Sucursales = null;
if($query->num_rows>0){
while ($r=$query->fetch_object()){
  $Sucursales=$r;
  break;
}

  }
?>

<? if($Sucursales!=null):?>

<form action="javascript:void(0)" method="post" id="ActualizaHorario" >
<label for="exampleFormControlInput1">Nombre Especialista</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control" value="<? echo $Sucursales->Nombre_Apellidos; ?>" readonly  aria-describedby="basic-addon1">
</div>

<label for="exampleFormControlInput1">Fecha</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <select id = "sucursal" class = "form-control" name = "Sucursal">
                                               <option value="<? echo $Sucursales->Nombre_Sucursal; ?>"><? echo $Sucursales->Nombre_Sucursal; ?></option>
        <?
          $query = $conn -> query ("SELECT Nombre_ID_Sucursal,Dueño_Propiedad FROM Sucursales WHERE  Dueño_Propiedad='".$row['ID_H_O_D']."'");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[Nombre_ID_Sucursal].'">'.$valores[Nombre_ID_Sucursal].'</option>';
          }
        ?>  </select>
</div>
<label for="exampleFormControlInput1">Estatus</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <select name="Color" class="form-control" id="colorpago" onchange="ShowSelected();">
									  <option value="<? echo $Sucursales->CodigoColorSu; ?>"><? echo $Sucursales->Estatus_Sucursal; ?></option>
              <option  value="btn btn-dark btn-sm">Inactivo</option>
              						  
						 </select>
</div>

<input type="hidden" class="form-control" id="estatus"   name="Estatus"  value="<? echo $Sucursales->Estatus_Sucursal; ?>">
<input type="hidden" name="id" value="<?php echo $Sucursales->ID_Sucursal; ?>">
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

<script src="js/EditaSucursal.js"></script>

<? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>