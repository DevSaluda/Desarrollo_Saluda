<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
$user_id=null;
$sql1= "SELECT Solicitudes_Traspasos.ID_Sol_Traspaso,Solicitudes_Traspasos.Cod_Barra,Solicitudes_Traspasos.Nombre_Prod,Solicitudes_Traspasos.Motivo_Solicitud,Solicitudes_Traspasos.Cantidad_Solicitada,
Solicitudes_Traspasos.Fk_sucursal, Solicitudes_Traspasos.Sucursal_Destino,Solicitudes_Traspasos.Fk_Sucursal_Destino,Solicitudes_Traspasos.Existencias_R,
  Solicitudes_Traspasos.Cantidad_Solicitada,Solicitudes_Traspasos.Estatus,Solicitudes_Traspasos.CodigoEstatus,Solicitudes_Traspasos.AgregadoPor,Solicitudes_Traspasos.AgregadoEl,Solicitudes_Traspasos.Sistema,
  Solicitudes_Traspasos.ID_H_O_D,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM
   SucursalesCorre,Solicitudes_Traspasos where Solicitudes_Traspasos.Fk_sucursal = SucursalesCorre.ID_SucursalC AND  Solicitudes_Traspasos.Estatus='Solicitud Enviada'
    AND Solicitudes_Traspasos.ID_H_O_D='".$row['ID_H_O_D']."' AND Solicitudes_Traspasos.ID_Sol_Traspaso = ".$_POST["id"];
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

    <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Folio solicitud<span class="text-danger">*</span> </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" ><i class="fas fa-barcode"></i></span>
  </div>
  <input type="text" class="form-control " disabled readonly value="<? echo $Especialistas->ID_Sol_Traspaso; ?>">
    </div>
    </div>
    
    <div class="col">
      
    <label for="exampleFormControlInput1">Existencia en sucursal origen<span class="text-info">Opcional</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" ><i class="fas fa-barcode"></i></span>
  </div>
  <input type="text" class="form-control "  readonly value="<? echo $Especialistas->Existencias_R; ?>" aria-describedby="basic-addon1" maxlength="60">               
</div><label for="clav" class="error"></div>

</div>
<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Cantidad solicitada<span class="text-danger">*</span> </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" ><i class="fas fa-barcode"></i></span>
  </div>
  <input type="text" class="form-control " disabled readonly value="<? echo $Especialistas->Cantidad_Solicitada; ?>">
    </div>
    </div>
    
    <div class="col">
      
    <label for="exampleFormControlInput1">Solicitado por</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" ><i class="fas fa-barcode"></i></span>
  </div>
  <input type="text" class="form-control " readonly value="<? echo $Especialistas->AgregadoPor; ?>" aria-describedby="basic-addon1" maxlength="60">                 
</div><label for="clav" class="error"></div>

</div>
    
<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Desde el sistema<span class="text-danger">*</span> </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" ><i class="fas fa-barcode"></i></span>
  </div>
  <input type="text" class="form-control " readonly value="<? echo $Especialistas->Sistema; ?>" aria-describedby="basic-addon1" maxlength="60">   
    </div>
    </div>
    
    <div class="col">
      
    <label for="exampleFormControlInput1">Fecha y hora</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" ><i class="fas fa-barcode"></i></span>
  </div>
  <input type="text" class="form-control " readonly value="<? echo $Especialistas->AgregadoEl; ?>" aria-describedby="basic-addon1" maxlength="60">                   
</div><label for="clav" class="error"></div>

</div>



   

<? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>
