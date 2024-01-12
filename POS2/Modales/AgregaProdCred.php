<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
include "../Consultas/ConsultaCaja.php";
include "../Consultas/SumadeFolioTickets.php";
$fcha = date("Y-m-d");
$user_id=null;
$sql1= "SELECT Creditos_Clinicas_POS.Folio_Credito,Creditos_Clinicas_POS.Fk_tipo_Credi,Creditos_Clinicas_POS.Nombre_Cred,
Creditos_Clinicas_POS.Fecha_Inicio,Creditos_Clinicas_POS.Fk_Sucursal,Creditos_Clinicas_POS.Estatus,Creditos_Clinicas_POS.CodigoEstatus,
Creditos_Clinicas_POS.ID_H_O_D,Creditos_Clinicas_POS.Saldo, SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM
Creditos_Clinicas_POS,SucursalesCorre where Creditos_Clinicas_POS.Fk_Sucursal = SucursalesCorre.ID_SucursalC and Creditos_Clinicas_POS.ID_H_O_D ='".$row['ID_H_O_D']."'
AND Creditos_Clinicas_POS.Fk_Sucursal ='".$row['Fk_Sucursal']."' AND 
Creditos_Clinicas_POS.Folio_Credito = ".$_POST["id"];
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
  <form method="post" 
      target="print_popup" 
      action="http://localhost/ticket/TicketCreditoClinica.php"
      onsubmit="window.open('about:blank','print_popup','width=1000,height=800');"  id="GeneraTicketClinica">

      <input type="number" class="form-control " name="NumeroTicketC" value="<? echo $totalmonto;?>"readonly  >
  
      <textarea class="form-control" id="nombre_prodticket" name="Nombre_ProdTicket" rows="3"></textarea>   
      <input class="form-control" id="precioticket" name="PrecioTicket" rows="3"></input>   
      <input type="text" class="form-control "  name="Abonoleticket" id="abonoleticket" aria-describedby="basic-addon1" maxlength="60">   
      <input type="number" class="form-control "  name="CantidadTicket" id="cantidadticket" readonly   aria-describedby="basic-addon1" maxlength="60">  
     
      <input type="text" class="form-control "  readonly name="TitularCreditoC" value="<? echo $Especialistas->Nombre_Cred; ?>" aria-describedby="basic-addon1" maxlength="60"> 
      <input type="text" class="form-control "   readonly name="VendedorTicketC"  readonly value="<?echo $row['Nombre_Apellidos']?>">
      <input type="text" class="form-control "  readonly name="SaldoActualTicketC" value="<? echo $Especialistas->Saldo; ?>" aria-describedby="basic-addon1" maxlength="60">   
      <input type="datetime" name="HoradeimpresionC" value="<?echo date('h:i:s A');?>">
      <button type="submit"  id="EnviaTicket"  class="btn btn-info">Realizar abono <i class="fas fa-money-check-alt"></i></button>
</form>


<!-- AQUI SE GUARDA LA REIMPRESION -->
<form action="javascript:void(0)" method="post" id="GuardaReimpresionTicketClinica" >
      <input type="number" class="form-control " name="NumeroTicketRC" value="<? echo $totalmonto;?>"readonly  >
      <input type="text" class="form-control "  name="FolioCreditoRC"  readonly value="<? echo $Especialistas->Folio_Credito; ?>">
     
  
  <textarea class="form-control" id="nombre_prodticketr" name="Nombre_ProdTicketR" rows="3"></textarea>   
  <input class="form-control" id="precioticketr" name="PrecioTicketR" rows="3"></input>   
  <input type="text" class="form-control "  name="AbonoleticketR" id="abonoleticketr" aria-describedby="basic-addon1" maxlength="60">   
  <input type="number" class="form-control "  name="CantidadTicketR" id="cantidadticketr" readonly   aria-describedby="basic-addon1" maxlength="60">  
 
  <input type="text" class="form-control "  readonly name="TitularCreditoRC" value="<? echo $Especialistas->Nombre_Cred; ?>" aria-describedby="basic-addon1" maxlength="60"> 
  <input type="text" class="form-control "   readonly name="VendedorTicketRC"  readonly value="<?echo $row['Nombre_Apellidos']?>">
  <input type="text" class="form-control "  readonly name="SaldoActualTicketRC" value="<? echo $Especialistas->Saldo; ?>" aria-describedby="basic-addon1" maxlength="60">   
  <input type="datetime" name="HoraPagoRC" value="<?echo date('h:i:s A');?>">
      <input type="text" class="form-control "  readonly id="sistemacajar" name="SistemaCajaRC" readonly value="POS <?echo $row['Nombre_rol']?>">
<input type="text" class="form-control "    readonly id="empresacajar" name="EmpresaCajaRC" readonly value="<?echo $row['ID_H_O_D']?>">
<input type="text" class="form-control " name="SucursalRC" id="sucursalr" value="<? echo $Especialistas->Fk_Sucursal; ?>" aria-describedby="basic-addon1" maxlength="60">   
<input type="date" class="form-control " readonly name="FechaAbonoRC" id="fechaabonor" value="<?php echo $fcha;?>" aria-describedby="basic-addon1" maxlength="60">
      <button type="submit"  id="EnviaReimpresionTicket"  class="btn btn-info">Realizar abono <i class="fas fa-money-check-alt"></i></button>
</form>



<form action="javascript:void(0)" method="post" id="AgregaCreditoProd" >

<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Folio de credito </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " id="foliocredc" name="FolioCredC"  readonly value="<? echo $Especialistas->Folio_Credito; ?>">
  <input type="text" class="form-control " id="foliotipocredc" name="FolioTipocredC" hidden readonly value="<? echo $Especialistas->Fk_tipo_Credi; ?>">

    </div>
    </div>
    
   
    <div class="col">
    <label for="exampleFormControlInput1">Titular<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control "  readonly name="TitularC" id="titularc" value="<? echo $Especialistas->Nombre_Cred; ?>" aria-describedby="basic-addon1" maxlength="60">            
</div></div>
<div class="col">
    <label for="exampleFormControlInput1">Fecha<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="date" class="form-control " readonly name="FechaAbonoC" id="fechaabonoc" value="<?php echo $fcha;?>" aria-describedby="basic-addon1" maxlength="60">            
</div></div>
</div>


</div>
<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Sucursal<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control "  readonly value="<? echo $Especialistas->Nombre_Sucursal; ?>" aria-describedby="basic-addon1" maxlength="60">
  <input type="text" class="form-control " hidden name="SucursalC" id="sucursalc" value="<? echo $Especialistas->Fk_Sucursal; ?>" aria-describedby="basic-addon1" maxlength="60">   
    </div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Saldo anterior<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control "  readonly name="SaldoActualC" id="saldoactualC" value="<? echo $Especialistas->Saldo; ?>" aria-describedby="basic-addon1" maxlength="60">  
  <input type="text" class="form-control "  readonly name="SaldoNuevo" id="saldonuevo" hidden aria-describedby="basic-addon1" maxlength="60">    
    </div>
    <label for="abono" class="error"> 
  </div>
  <div class="col">
    <label for="exampleFormControlInput1">Costo total <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="number" class="form-control " readonly name="Abono" id="abono" onchange="ActualizaEso()"aria-describedby="basic-addon1" maxlength="60">   
    </div>
    </div>
  </div>
  <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Buscar</span>
  </div>
  <input  id="codbarrap"  type="text" class="form-control"  autofocus placeholder="Ingrese codigo de barra" style="position: relative;"aria-label="Alumno" aria-describedby="basic-addon1">
</div>

  
    </div>
    
    <div class="row">
    <div class="col">
      
    <label for="exampleFormControlInput1">Nombre / Descripcion <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" ><i class="fas fa-barcode"></i></span>
  </div>
  
  <textarea class="form-control" id="nombre_prod"  readonly name="Nombre_Prod" rows="3"></textarea>     
</div><label for="clav" class="error"></div>
<div class="col">
<label for="exampleFormControlInput1">Costo <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" ><i class="fas fa-pencil-alt"></i></span>
  </div>
  <input type="number" class="form-control " name="CostoProd"  readonly id="costoprod"  placeholder="Costo producto" aria-describedby="basic-addon1" maxlength="60">       
 
    </div><label for="nombreprod" class="error">
    </div>
    <div class="col">
      
      <label for="exampleFormControlInput1">Cantidad <span class="text-info"></span></label>
       <div class="input-group mb-3">
    <div class="input-group-prepend">
    
      <span class="input-group-text" ><i class="fas fa-barcode"></i></span>
    </div>
    <input type="text" class="form-control " name="Cantidad" id="cantidad" oninput="capturaTotalProductos()" placeholder="Ingrese código" aria-describedby="basic-addon1" maxlength="60">            
  </div><label for="clav" class="error"></div>
</div>


<!-- PRIMERA TANDA -->


  

    
<input type="number" class="form-control "  hidden readonly name="IDProductos" id="idproductos" >
  <input type="text" class="form-control " hidden  readonly name="FkCajaC" id="fkcajac"  readonly value="<?php echo $ValorCaja["ID_Caja"];?>">
<input type="text" class="form-control " hidden  readonly name="UsuarioC" id="usuarioc"  readonly value="<?echo $row['Nombre_Apellidos']?>">
<input type="text" class="form-control "  hidden  readonly id="sistemac" name="SistemaC" readonly value="POS <?echo $row['Nombre_rol']?>">
<input type="text" class="form-control "  hidden  readonly id="empresac" name="EmpresaC" readonly value="<?echo $row['ID_H_O_D']?>">
<input type="text" class="form-control " hidden  readonly name="EstatusC" id="estatusc"  readonly value="A credito">
<input type="text" class="form-control " hidden  readonly name="CodigoC" id="codigoc"  readonly value="background-color: #2BBB1D !important;">

<button type="submit"  id="submit"  class="btn btn-success">Confirmar <i class="fas fa-check"></i></button>
                          
</form>
<script>
$(document).ready(function() {
    $("#AgregaCreditoProd").keypress(function(e) {
        if (e.which == 13) {
            return false;
            $( ".ui-menu-item-wrapper" ).click();
        }
    });
});
</script>

<form action="javascript:void(0)" method="post" id="ActualizaSaldoCredClinica" >


    </div>
    <div class="form-group">
    <label for="exampleFormControlInput1">Saldo despues de abono<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="number" class="form-control "  hidden name="AjusteC" id="ajustec" readonly   aria-describedby="basic-addon1" maxlength="60">            
</div></div>


<input type="hidden" name="IDFolioC" id="idfolioc" value="<?php echo $Especialistas->Folio_Credito; ?>">
<button type="submit"  id="submit_saldo"  class="btn btn-info">Ajustar credito <i class="fas fa-money-check-alt"></i></button>
                          
</form>

<!-- <form action="javascript:void(0)" method="post" id="AgregaEnCajaClinica" >


  
   
  <input type="number" class="form-control "  name="ID_PROD" value="0000000000" readonly   aria-describedby="basic-addon1" maxlength="60">            
 
  <input type="Text" class="form-control "  name="IDentificador" value="Créditos" readonly   aria-describedby="basic-addon1" maxlength="60">  

  <input type="number" class="form-control " id="ticketval" name="TicketVal" value="<? echo $totalmonto;?>"readonly  > 
  <input type="number" class="form-control "  name="ClavAd" value="0000000000" readonly   aria-describedby="basic-addon1" maxlength="60">
  <input type="number" class="form-control "  name="CodBarra" value="0000000000" readonly   aria-describedby="basic-addon1" maxlength="60">
  <input type="text" class="form-control "  name="NombreProducto" value="Abono de crédito" readonly   aria-describedby="basic-addon1" maxlength="60">
  <input type="number" class="form-control "  name="CantidadVenta" value="1" readonly   aria-describedby="basic-addon1" maxlength="60">  
  <input type="text" class="form-control "  name="SucursalesS" value="<? echo $row['Fk_Sucursal']?>" readonly   aria-describedby="basic-addon1" maxlength="60">      
  <input type="number" class="form-control "  name="TotalVenta" id="totalventa" readonly   aria-describedby="basic-addon1" maxlength="60">  
  <input type="text" class="form-control "  name="CajaAsignada" id="cajaasignada" value="<?php echo $ValorCaja["ID_Caja"];?>">  
  <input type="text" class="form-control "  name="Lote"  value="N/A">  
  <input type="text" class="form-control "  readonly id="sistemacaja" name="SistemaCaja" readonly value="POS <?echo $row['Nombre_rol']?>">
<input type="text" class="form-control "    readonly id="empresacaja" name="EmpresaCaja" readonly value="<?echo $row['ID_H_O_D']?>">
<input type="text" class="form-control "   readonly name="UsuarioCaja" id="usuariocaja"  readonly value="<?echo $row['Nombre_Apellidos']?>">
</form> -->
<script src="js/AgregaProd.js"></script>
<script src="js/BuscaProductosDeCreditoClinicas.js"></script>
<? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>


<script>


      function capturaTotalProductos() {
    let municipio = document.getElementById("cantidad").value;
    //Se actualiza en municipio inm
    document.getElementById("cantidadticket").value = municipio;
    document.getElementById("cantidadticketr").value = municipio;
}
      
    

    $(document).on('change', '#cantidad', function(){
       
        var mat = $("#costoprod").val();
            var price = $("#cantidad").val();
            var resultadototal = mat * price;
            
            $("#abono").val(resultadototal);
             
             $("#abono").focus();
            
        });
      
        $(document).on('focus', '#abono', function(){
       
           var abonado = $("#abono").val();
           var nuevosaldo = $("#saldoactualC").val();
           var resultadosuma = parseFloat(abonado) + parseFloat(nuevosaldo);
                      
           $("#saldonuevo").val(resultadosuma);
           $("#ajustec").val(resultadosuma);
             $("#abonoleticket").val(resultadosuma);
             $("#abonoleticketr").val(resultadosuma);
           
       });
        
    </script>

<?php
if($ValorCaja["Estatus"] == 'Abierta'){

  echo '
  <script>
$(document).ready(function()
{
// id de nuestro modal

$("#submit").attr("disabled", false);
});
</script>
  ';
     }else{
    
      echo '
      <script>
$(document).ready(function()
{
  // id de nuestro modal

  $("#submit").attr("disabled", true);
});
</script>
      ';
      
      
    
     } ?>