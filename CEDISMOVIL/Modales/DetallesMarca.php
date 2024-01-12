<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
$user_id=null;
$sql1= "SELECT * FROM Marcas_POS WHERE ID_H_O_D ='".$row['ID_H_O_D']."' AND Marca_ID = ".$_POST["id"];
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


<div class="form-group">
    <label for="exampleFormControlInput1">Folio</label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " disabled readonly value="<? echo $Especialistas->Marca_ID; ?>">
    </div>
    </div>
    
   
    <div class="form-group">
    <label for="exampleFormControlInput1">Nombre de marca<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control "  readonly value="<? echo $Especialistas->Nom_Marca; ?>" aria-describedby="basic-addon1" maxlength="60">            
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
<button  style=<?php echo $Especialistas->Cod_Estado; ?> class="btn btn-default btn-sm" ><? echo $Especialistas->Estado; ?></button> 
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
  <input type="text" class="form-control " readonly value="<? echo $Especialistas->Agregado_Por; ?>" aria-describedby="basic-addon1" maxlength="60">            
</div></div>
<div class="form-group">
    <label for="exampleFormControlInput1">Editado desde el sistema<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control " readonly value="<? echo $Especialistas->Sistema; ?>" aria-describedby="basic-addon1" maxlength="60">            
</div></div>
<div class="form-group">
    <label for="exampleFormControlInput1">Fecha y hora<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control " readonly value="<? echo $Especialistas->Agregadoel; ?>" aria-describedby="basic-addon1" maxlength="60">            
</div></div>
</div>
    </div>

   

<? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>
