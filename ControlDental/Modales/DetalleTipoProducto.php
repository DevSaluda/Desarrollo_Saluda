<?php
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
$user_id=null;
$sql1= "SELECT * FROM TipProd_POS WHERE ID_H_O_D ='".$row['ID_H_O_D']."' AND Tip_Prod_ID = ".$_POST["id"];
$query = $conn->query($sql1);
$Especialistas = null;
if($query->num_rows>0){
while ($r=$query->fetch_object()){
  $Especialistas=$r;
  break;
}

  }
?>

<?php if($Especialistas!=null):?>


<div class="form-group">
    <label for="exampleFormControlInput1">Folio</label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " disabled readonly value="<?php echo $Especialistas->Tip_Prod_ID; ?>">
    </div>
    </div>
    
   
    <div class="form-group">
    <label for="exampleFormControlInput1">Nombre de marca<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control "  readonly value="<?php echo $Especialistas->Nom_Tipo_Prod; ?>" aria-describedby="basic-addon1" maxlength="60">            
</div></div></div>

    
<div class="form-group">
    
<div class="table-responsive">
  <table class="table table-bordered">
  <thead>
    <tr>
       <th scope="col" style="background-color: #4285f4 !important;">Estatus fondo</th>
    
    </tr>
  </thead>
  <tbody>
    <tr>
<td>
<button  style=<?php echo $Especialistas->Cod_Estado; ?> class="btn btn-default btn-sm" ><?php echo $Especialistas->Estado; ?></button> 
   </td>
    </tr>
    
  
  </tbody>
</table>
</div>           
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Ultima edicion por:<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control " readonly value="<?php echo $Especialistas->Agregado_Por; ?>" aria-describedby="basic-addon1" maxlength="60">            
</div></div>
<div class="form-group">
    <label for="exampleFormControlInput1">Editado desde el sistema<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control " readonly value="<?php echo $Especialistas->Sistema; ?>" aria-describedby="basic-addon1" maxlength="60">            
</div></div>
<div class="form-group">
    <label for="exampleFormControlInput1">Fecha y hora<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control " readonly value="<?php echo $Especialistas->Agregadoel; ?>" aria-describedby="basic-addon1" maxlength="60">            
</div></div>
</div>
    </div>

   

<?php else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<?php endif;?>
