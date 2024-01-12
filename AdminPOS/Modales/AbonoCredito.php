<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
$fcha = date("Y-m-d");
$user_id=null;
$sql1= "SELECT Creditos_POS.Folio_Credito,Creditos_POS.Fk_tipo_Credi,Creditos_POS.Nombre_Cred,Creditos_POS.Cant_Apertura,Creditos_POS.Fk_Sucursal,Creditos_POS.Saldo,
Creditos_POS.Estatus,Creditos_POS.CodigoEstatus,Creditos_POS.ID_H_O_D,Tipos_Credit_POS.ID_Tip_Cred,
Tipos_Credit_POS.Nombre_Tip,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM Creditos_POS,Tipos_Credit_POS,SucursalesCorre WHERE
Creditos_POS.Fk_tipo_Credi=Tipos_Credit_POS.ID_Tip_Cred AND Creditos_POS.Fk_Sucursal = SucursalesCorre.ID_SucursalC and Creditos_POS.ID_H_O_D='".$row['ID_H_O_D']."' AND 
Creditos_POS.Folio_Credito = ".$_POST["id"];
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

<form action="javascript:void(0)" method="post" id="AbonaCredito" >

<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Folio de crédito </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " id="foliocred" name="FolioCred"  readonly value="<? echo $Especialistas->Folio_Credito; ?>">
  
    </div>
    </div>
    
   
    <div class="col">
    <label for="exampleFormControlInput1">Tratamiento<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control "  readonly value="<? echo $Especialistas->Nombre_Tip; ?>" aria-describedby="basic-addon1" maxlength="60">            
  <input type="text" class="form-control " hidden name="FolioTipocred" id="foliotipocred" readonly value="<? echo $Especialistas->Fk_tipo_Credi; ?>">
</div></div></div>

<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Titular<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control "  readonly name="Titular" id="titular" value="<? echo $Especialistas->Nombre_Cred; ?>" aria-describedby="basic-addon1" maxlength="60">            
</div></div>
<div class="col">
    <label for="exampleFormControlInput1">Fecha<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="date" class="form-control "  name="FechaAbono" id="fechaabono" value="<?php echo $fcha;?>" aria-describedby="basic-addon1" maxlength="60">            
</div></div></div>
<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Sucursal<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control "  readonly value="<? echo $Especialistas->Nombre_Sucursal; ?>" aria-describedby="basic-addon1" maxlength="60">
  <input type="text" class="form-control " hidden name="Sucursal" id="sucursal" value="<? echo $Especialistas->Fk_Sucursal; ?>" aria-describedby="basic-addon1" maxlength="60">   
    </div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Saldo actual<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control "  readonly name="SaldoActual" id="saldoactual" value="<? echo $Especialistas->Saldo; ?>" aria-describedby="basic-addon1" maxlength="60">   
    </div>
    <label for="abono" class="error"> 
  </div></div>
  <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Abono <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control "  name="Abono" id="abono"  aria-describedby="basic-addon1" maxlength="60">   
    </div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Saldo después de abono<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="number" class="form-control "   readonly name="SaldoNuevo" id="saldonuevo"  aria-describedby="basic-addon1" maxlength="60">               
    </div>
    <label for="abono" class="error"> 
  </div></div>
    
   

<input type="text" class="form-control " hidden  readonly name="Usuario" id="usuario"  readonly value="<?echo $row['Nombre_Apellidos']?>">
<input type="text" class="form-control "  hidden  readonly id="sistema" name="Sistema" readonly value="POS <?echo $row['Nombre_rol']?>">
<input type="text" class="form-control "  hidden  readonly id="empresa" name="Empresa" readonly value="<?echo $row['ID_H_O_D']?>">
<input type="text" class="form-control " hidden  readonly name="Estatus" id="estatus"  readonly value="Abonado">
<input type="text" class="form-control " hidden  readonly name="Codigo" id="codigo"  readonly value="background-color: #2BBB1D !important;">
<input type="hidden" name="IDFolio" id="idfolio" value="<?php echo $Especialistas->Folio_Credito; ?>">
<button type="submit"  id="submit"  class="btn btn-info">Realizar abono <i class="fas fa-money-check-alt"></i></button>
                          
</form>

<form action="javascript:void(0)" method="post" id="ActualizaSaldo" >


    </div>
    <div class="form-group">
    <label for="exampleFormControlInput1">Saldo despues de abono<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="number" class="form-control "  name="Ajuste" id="ajuste" readonly   aria-describedby="basic-addon1" maxlength="60">            
</div></div>


<input type="hidden" name="IDFolio" id="idfolio" value="<?php echo $Especialistas->Folio_Credito; ?>">
<button type="submit"  id="submit_saldo"  class="btn btn-info">Ajustar credito <i class="fas fa-money-check-alt"></i></button>
                          
</form>
<script src="js/Abona.js"></script>
<script src="js/UpdateSaldo.js"></script>
<? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>


<script>
       var precio1 = document.getElementById("saldoactual")
       var precio2 = document.getElementById("abono")
       var precio3 = document.getElementById("saldonuevo")
       var ajustecred=document.getElementById("ajuste")
        precio2.addEventListener("change", () => {
            precio3.value = parseFloat(precio1.value) - parseFloat(precio2.value)

        })
        precio2.addEventListener("change", () => {
          ajustecred.value = parseFloat(precio1.value) - parseFloat(precio2.value)

        })
        
    </script>