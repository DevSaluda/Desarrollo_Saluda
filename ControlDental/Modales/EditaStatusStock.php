<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
$user_id=null;
$sql1= "SELECT * FROM `Stock_POS` WHERE ID_H_O_D ='".$row['ID_H_O_D']."' AND Folio_Prod_Stock = ".$_POST["id"];
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

<form action="javascript:void(0)" method="post" id="AjustaStock" >
<div class="form-group">
    <label for="exampleFormControlInput1">Folio </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " disabled readonly value="<? echo $Especialistas->Folio_Prod_Stock; ?>">
    </div>
    </div>
    
   
    <div class="form-group">
    <label for="exampleFormControlInput1">"Existencias" <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control "   value="<? echo $Especialistas->Existencias_R; ?>" aria-describedby="basic-addon1" maxlength="60">            
</div></div></div>

<div class="form-group">
    <label for="exampleFormControlInput1">"Cantidad Vendida" <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control "  name="ActExistenciasR"  aria-describedby="basic-addon1" maxlength="60">            
</div></div></div>


<input type="hidden" name="id_Stock"  value="<?php echo $Especialistas->Folio_Prod_Stock; ?>">
<button type="submit"  id="submit"  class="btn btn-info">Aplicar cambios <i class="fas fa-check"></i></button>
                          
</form>
<script src="js/ActualizaStockSucursales.js"></script>

<? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>

  
