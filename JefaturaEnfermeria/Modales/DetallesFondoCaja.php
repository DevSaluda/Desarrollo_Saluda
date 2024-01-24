<?php
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";

$user_id=null;
$sql1= "SELECT Fondos_Cajas.ID_Fon_Caja,Fondos_Cajas.Fk_Sucursal,Fondos_Cajas.Fondo_Caja,Fondos_Cajas.ID_H_O_D, Fondos_Cajas.CodigoEstatus,Fondos_Cajas.Estatus,Fondos_Cajas.AgregadoPor, 
SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM 
Fondos_Cajas,SucursalesCorre where Fondos_Cajas.Fk_Sucursal = SucursalesCorre.ID_SucursalC AND 
Fondos_Cajas.ID_H_O_D ='".$row['ID_H_O_D']."' AND Fondos_Cajas.ID_Fon_Caja = ".$_POST["id"];
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
    <label for="exampleFormControlInput1">Folio de fondo </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " disabled readonly value="<?php echo $Especialistas->ID_Fon_Caja; ?>">
    </div>
    </div>
    
   
    <div class="form-group">
    <label for="exampleFormControlInput1">Sucursal<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control " readonly  value="<?php echo $Especialistas->Nombre_Sucursal; ?>" aria-describedby="basic-addon1" maxlength="60">            
</div></div></div>

    
    <div class="form-group">
      
    <label for="exampleFormControlInput1">Cantidad de fondo de caja  <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="number" class="form-control " readonly value="<?php echo $Especialistas->Fondo_Caja; ?>" aria-describedby="basic-addon1" >            
</div></div></div>
<div class="form-group">
      
    <label for="exampleFormControlInput1">Agregado por <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control " readonly value="<?php echo $Especialistas->AgregadoPor; ?>" aria-describedby="basic-addon1" >            
</div></div></div>

    </div>
    
                          

<?php else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<?php endif;?>
