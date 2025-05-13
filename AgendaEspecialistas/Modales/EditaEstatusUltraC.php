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

<form action="javascript:void(0)" method="post" id="ActualizaEspecial" >
   
<label for="exampleFormControlInput1">Nombre del paciente</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control" value="<?php echo $person->Nombre_paciente; ?>" name="ActualizaNombre" id="Especial" aria-describedby="basic-addon1">
</div>
<label for="exampleFormControlInput1">Telefono</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control" value="<?php echo $person->Telefono; ?>" name="ActualizaTelefono" id="Telefono" aria-describedby="basic-addon1">
</div>
<label for="exampleFormControlInput1">Sucursal</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <select name="ActualizaSucursal" id="sucursal" class="form-control">
                                               <option value="<?php echo $person->ID_Sucursal; ?>"><?php echo $person->ID_Sucursal; ?></option>
                                               <?php
          $query = $conn -> query ("SELECT Nombre_Sucursal  FROM SucursalesCorre
          WHERE Nombre_Sucursal NOT IN ('Hunucm&aacute;', 'Mama', 'Mani', 'Akil', 'CEDIS', 'CEDIS(Partner)', 'Capacitación');");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores["Nombre_Sucursal"].'">'.$valores["Nombre_Sucursal"].'</option>';
          }
        ?> </select>
</div>
<label for="exampleFormControlInput1">Estatus</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <select name="ActualizaColor" class="form-control" id="color" onchange="ShowSelected();">
									  <option value="<?php echo $person->Codigo_color; ?>"><?php echo $person->Estatus; ?></option>
				
              <option  value="btn btn-success">Entregado</option>		
              <option  value="btn btn-danger">Pendiente</option>						  
						 </select>
</div>
<input type="hidden" name="ActualizaEstatus" id="estatus" value="<?php echo $person->Estatus; ?>" >
<input type="hidden" name="id" value="<?php echo $person->ID_resultado; ?>">
<button type="submit"  name="submit" id="submit"  class="btn btn-primary">Aplicar cambios <i class="fas fa-save"></i></button>
                          
</form>
<script type="text/javascript">
function ShowSelected()
{

 
/* Para obtener el texto */
var combo = document.getElementById("color");
var selected = combo.options[combo.selectedIndex].text;
$("#estatus").val(selected);
}
</script>
<script src="js/EditaEstatusUltras.js"></script>

<?php else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<?php endif;?>