<?php
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/ConsultaCaja.php";
include "../Consultas/SumadeFolioTickets.php";
$fcha = date("Y-m-d");
$user_id=null;
$sql1= "SELECT Creditos_POS.Folio_Credito,Creditos_POS.Fk_tipo_Credi,Creditos_POS.Nombre_Cred,Creditos_POS.Cant_Apertura,Creditos_POS.Fk_Sucursal,Creditos_POS.Validez,Creditos_POS.Saldo,
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

<?php if($Especialistas!=null):?>




<!-- FORMULARIO DE ABONO DE TICKET -->
<form action="javascript:void(0)" method="post" id="AbonaCredito">

<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Folio de credito </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " id="foliocred" name="FolioCred"  readonly value="<?php echo $Especialistas->Folio_Credito; ?>">

    </div>
    </div>
    
   
    <div class="col">
    <label for="exampleFormControlInput1">Tratamiento<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control "  readonly value="<?php echo $Especialistas->Nombre_Tip; ?>" aria-describedby="basic-addon1" maxlength="60">            
  <input type="text" class="form-control " hidden name="FolioTipocred" id="foliotipocred" readonly value="<?php echo $Especialistas->Fk_tipo_Credi; ?>">
</div></div></div>

<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Titular<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control "  readonly name="Titular" id="titular" value="<?php echo $Especialistas->Nombre_Cred; ?>" aria-describedby="basic-addon1" maxlength="60">            
</div></div>
<div class="col">
    <label for="exampleFormControlInput1">Fecha<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="date" class="form-control " readonly name="FechaAbono" id="fechaabono" value="<?php echo $fcha;?>" aria-describedby="basic-addon1" maxlength="60">            
</div></div></div>

<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Sucursal<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control "  readonly value="<?php echo $Especialistas->Nombre_Sucursal; ?>" aria-describedby="basic-addon1" maxlength="60">
  <input type="text" class="form-control " hidden name="Sucursal" id="sucursal" value="<?php echo $Especialistas->Fk_Sucursal; ?>" aria-describedby="basic-addon1" maxlength="60">   
    </div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Saldo actual<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control "  readonly name="SaldoActual" id="saldoactual" value="<?php echo $Especialistas->Saldo; ?>" aria-describedby="basic-addon1" maxlength="60">   
    </div>
    <label for="abono" class="error"> 
  </div></div>


  <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Abono <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control "  name="Abono" id="abono" oninput="CapturaValorVenta()" aria-describedby="basic-addon1" maxlength="60">   
    </div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Saldo despues de abono<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="number" class="form-control "   readonly name="SaldoNuevo" id="saldonuevo" aria-describedby="basic-addon1" maxlength="60">               
    </div>
    <label for="abono" class="error"> 
  </div></div>

<button type="submit" id="submit" class="btn btn-info">Realizar abono <i class="fas fa-money-check-alt"></i></button>


                          
</form>


<!-- FORMUARIO DE IMPRESION DEL CODIGO DE ABONO -->
  
<form method="post" 
      target="print_popup" 
      action="http://localhost:8080/ticket/"
      onsubmit="window.open('about:blank','print_popup','width=200,height=200');"  id="GeneraTicket">

      <input type="number" class="form-control " name="NumeroTicket" value="<?php echo $totalmonto;?>"readonly  >
      <input type="text" class="form-control "  name="FolioCredito"  readonly value="<?php echo $Especialistas->Folio_Credito; ?>">
      <input type="text" class="form-control "  name="TramientoTicket" readonly value="<?php echo $Especialistas->Nombre_Tip; ?>" aria-describedby="basic-addon1" maxlength="60"> 
      <input type="number" class="form-control "  name="AbonoTicket" id="abonoticket" readonly   aria-describedby="basic-addon1" maxlength="60">  
      <input type="number" class="form-control "  name="SaldoTicket" id="saldoticket" readonly   aria-describedby="basic-addon1" maxlength="60">  
      <input type="text" class="form-control "  readonly name="TitularCredito" value="<?php echo $Especialistas->Nombre_Cred; ?>" aria-describedby="basic-addon1" maxlength="60"> 
      <input type="text" class="form-control "   readonly name="VendedorTicket"  readonly value="<?php echo $row['Nombre_Apellidos']?>">
      <input type="text" class="form-control "  readonly name="SaldoActualTicket" value="<?php echo $Especialistas->Saldo; ?>" aria-describedby="basic-addon1" maxlength="60">   
      <input type="text" class="form-control "  readonly name="FechaValidez" value="<?php echo $Especialistas->Validez; ?>" aria-describedby="basic-addon1" maxlength="60">   
      <input type="datetime" name="Horadeimpresion" value="<?php echo date('h:i:s A');?>">
      <button type="submit"  id="EnviaTicket"  class="btn btn-info">Realizar abono <i class="fas fa-money-check-alt"></i></button>
</form>

<!-- FORMUARIO DE IMPRESION DEL CODIGO DE ABONO -->

<!-- FORMULARIO DE ABONO DE TICKET -->
<?php else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<?php endif;?>

<script>
       var precio1 = document.getElementById("saldoactual")
       var precio2 = document.getElementById("abono")
       var precio3 = document.getElementById("saldonuevo")
       var ajustecred=document.getElementById("ajuste")
       var ticketcred=document.getElementById("saldoticket")
       var ticketcredr=document.getElementById("saldoticketr")
        precio2.addEventListener("change", () => {
            precio3.value = parseFloat(precio1.value) - parseFloat(precio2.value)

        })
        precio2.addEventListener("change", () => {
          ajustecred.value = parseFloat(precio1.value) - parseFloat(precio2.value)

        })
        precio2.addEventListener("change", () => {
          ticketcred.value = parseFloat(precio1.value) - parseFloat(precio2.value)

        })
        precio2.addEventListener("change", () => {
          ticketcredr.value = parseFloat(precio1.value) - parseFloat(precio2.value)

        })
        function CapturaValorVenta() {
    var abono = document.getElementById("abono").value;
    //Se actualiza en municipio inm
    document.getElementById("totalventa").value = abono;
    document.getElementById("abonoticket").value = abono;
    document.getElementById("abonoticketr").value = abono;
}

    </script>

<script src="js/Abona.js"></script>
<script src="js/UpdateSaldo.js"></script>