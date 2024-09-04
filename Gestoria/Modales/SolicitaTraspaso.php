<?php
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";

$fcha = date("Y-m-d");
$user_id=null;
$sql1="SELECT Stock_POS.Folio_Prod_Stock,Stock_POS.ID_Prod_POS,Stock_POS.Clave_adicional,Stock_POS.Cod_Barra,Stock_POS.Nombre_Prod,Stock_POS.Fk_sucursal,
Stock_POS.Existencias_R,Stock_POS.Proveedor1,Stock_POS.Proveedor2,Stock_POS.CodigoEstatus,Stock_POS.Estatus,Stock_POS.ID_H_O_D,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal
FROM Stock_POS,SucursalesCorre WHERE Stock_POS.Fk_Sucursal = SucursalesCorre.ID_SucursalC AND Stock_POS.Folio_Prod_Stock= ".$_POST["id"];
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
 
<form action="javascript:void(0)" method="post" id="SolicitaTraspaso" >

<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Codigo de barras</label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>

  <input type="text" class="form-control " hidden id="prodid" name="ProdId"  readonly value="<? echo $Especialistas->ID_Prod_POS; ?>">
  <input type="text" class="form-control " hidden id="clavad" name="ClavAd"  readonly value="<? echo $Especialistas->Clave_adicional; ?>">
<input type="text" class="form-control " id="codbarra" name="CodBarra"  readonly value="<? echo $Especialistas->Cod_Barra; ?>">

    </div>
    </div>
    
   
    <div class="col">
    <label for="exampleFormControlInput1">Nombre Producto<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control "  name="NameProd" id="nameprod" readonly value="<? echo $Especialistas->Nombre_Prod; ?>" aria-describedby="basic-addon1" maxlength="60">            
  
</div></div></div>

<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Sucursal origen<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control "  readonly  value="<? echo $Especialistas->Nombre_Sucursal; ?>" aria-describedby="basic-addon1" maxlength="60">            
</div></div>
<div class="col">
    <label for="exampleFormControlInput1">Sucursal destino<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control "  name="SucursalNombreDestino"value="<?echo $row['Nombre_Sucursal']?>" aria-describedby="basic-addon1" maxlength="60"> 
  <input type="text" class="form-control " readonly hidden name="SucursalDestino" id="sucursaldestino" value="<?echo $row['Fk_Sucursal']?>" aria-describedby="basic-addon1" maxlength="60">                       
</div></div></div>


<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Existencia<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " name="Existencia" readonly value="<? echo $Especialistas->Existencias_R; ?>" aria-describedby="basic-addon1" maxlength="60">
  
    </div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Cantidad solicitada<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " name="CantidadSolicitada" id="cantidadsolicitada"  aria-describedby="basic-addon1" maxlength="60">   
    </div>
    <label for="abono" class="error"> 
  </div></div>

  <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Fecha solicitud<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="date" class="form-control "  readonly value="<?php echo $fcha ?>" aria-describedby="basic-addon1" maxlength="60">
  
    </div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Motivo de solicitud<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  
  <textarea class="form-control" id="motsol" name="MotSol" rows="3"></textarea>
    </div>
    <label for="abono" class="error"> 
  </div></div>



    
  <input type="text" class="form-control " hidden name="SucursalBase" id="sucursalbase" value="<? echo $Especialistas->Fk_sucursal; ?>" aria-describedby="basic-addon1" maxlength="60">   

<input type="text" class="form-control "  hidden readonly name="Usuario" id="usuario"  readonly value="<?echo $row['Nombre_Apellidos']?>">
<input type="text" class="form-control "  hidden  readonly id="sistema" name="Sistema" readonly value="POS <?echo $row['Nombre_rol']?>">
<input type="text" class="form-control "   hidden readonly id="empresa" name="Empresa" readonly value="<?echo $row['ID_H_O_D']?>">
<input type="text" class="form-control "   hidden readonly name="Estatus" id="estatus"  readonly value="Solicitud enviada">
<input type="text" class="form-control "  hidden  readonly name="Codigo" id="codigo"  readonly value="background-color:#007bff!important;">
<input type="text" class="form-control " hidden id="folioprod" name="FolioProd"  readonly value="<? echo $Especialistas->Folio_Prod_Stock; ?>">
<button type="submit"  id="submit"  class="btn btn-success">Enviar <i class="fas fa-check"></i></button>
                          
</form>
         
       </div>
     </div>
     <!--/.Content-->
   </div>
 </div>
 </div>
 <? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>
<script src="js/EnviaSolicitudTraspaso.js"></script>
