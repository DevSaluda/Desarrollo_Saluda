<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
$user_id=null;
$sql1= "SELECT * FROM Proveedores_POS WHERE ID_Proveedor = ".$_POST["id"];
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

  <label for=""> <h3> Detalles del proveedor</h3></label>
<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Folio de empleado </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " disabled readonly value="<? echo $Especialistas->ID_Proveedor; ?>">
    </div>
    </div>
    
    <div class="col">
      
    <label for="exampleFormControlInput1">Nombre proveedor<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control " readonly value="<? echo $Especialistas->Nombre_Proveedor; ?>" aria-describedby="basic-addon1" maxlength="60">            
</div></div></div>
<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Correo</label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control "  readonly value="<? echo $Especialistas->Correo_Electronico;?>">
    </div>
    </div>
    
    <div class="col">
      
    <label for="exampleFormControlInput1">Telefono <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="number" class="form-control " readonly value="<? echo $Especialistas->Numero_Contacto; ?>" aria-describedby="basic-addon1" >            
</div></div></div>
<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Ultima edicion por</label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control "   value="<? echo $Especialistas->AgregadoPor;?>">
    </div>
    </div>
    
    <div class="col">
      
    <label for="exampleFormControlInput1">Fecha y hora <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control " readonly value="<? echo $Especialistas->AgregadoEl; ?>" aria-describedby="basic-addon1" >            
</div></div></div>
<label for=""> <h3>Vigencia del proveedor</h3></label>
<div class="row">
   
    
<div class="table-responsive">
  <table class="table table-bordered">
  <thead>
    <tr>
       <th scope="col" style="background-color: #4285f4 !important;">Estatus del empleado</th>
    
    </tr>
  </thead>
  <tbody>
    <tr>
<td>
<button id="VigenciaBD" class="btn btn-default btn-sm" style=<? echo $Especialistas->CodigoEstatus; ?>><? echo $Especialistas->Estatus; ?></button> 
    </td>
    </tr>
    
  
  </tbody>
</table>
</div>           
  </div></div>
    </div>
  
                          
</form>


<? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>
