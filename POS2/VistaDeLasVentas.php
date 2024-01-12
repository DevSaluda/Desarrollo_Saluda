<?php
include "Consultas/Consultas.php";
include "Consultas/Sesion.php";
include "Consultas/ConsultaCaja.php";
include "Consultas/SumadeFolioTickets.php";
include ("Consultas/db_connection.php");
$fcha = date("Y-m-d");
?>


<div class="text-center">
<button data-toggle="modal" data-target="#CambioAdar" class="btn btn-success btn-sm">Realizar venta <i class="fas fa-cash-register"></i></button>
<button  class="btn btn-danger btn-sm" onclick="CargaGestionventas();">Cancelar venta <i class="far fa-window-close"></i></button>
<div class="row">
<input hidden type="text" class="form-control "  readonly value="<?php echo $row['Nombre_Apellidos']?>" >
    
    <div class="col">
      
    <label for="exampleFormControlInput1">Caja</label> <br>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-barcode"></i></span>
  </div>
  <input type="text" class="form-control "  readonly value="<?php echo $ValorCaja['Valor_Total_Caja']?>" >
  <input type="text" class="form-control " hidden id="valcaja" name="CajaSucursal[]" readonly value="<?php echo $ValorCaja["ID_Caja"];?>" >
    </div>  </div>
      
    <div class="col">
      
    <label for="exampleFormControlInput1">Turno</label> <br>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-clock"></i></span>
  </div>
  <input type="text" class="form-control "  readonly value="<?php echo $ValorCaja['Turno']?>" >
  
    </div>  </div>


<div class="col">
      
<label for="exampleFormControlInput1">Numero de ticket</label> <br>
      <div class="input-group mb-3">
    <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-receipt"></i></span>
    </div>
    <input type="number" class="form-control "  value="<?php echo $totalmonto;?>"readonly  >
      </div>

  <label for="clav" class="error"></div>
  <div class="col">
      
  <label for="exampleFormControlInput1">Total de venta </label> <br>
      <div class="input-group mb-3">
    <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-money-check-alt"></i></span>
    </div>
    <input type="number" class="form-control " id="totalventa2"  readonly  >
   
      </div>
  
    
</div>
</div>
</div>


<script>
 $(function () {
    $("body").keypress(function (e) {
        var key;
        if (window.event)
            key = window.event.keyCode; //IE
        else
            key = e.which; //firefox     
        return (key != 13);
    });
});
  </script>
<button hidden id="Ajusteeee" onclick="sumar()">Ajustar total de venta<i class="fas fa-cash-register"></i></button>
<form action="javascript:void(0)"     target="print_popup"  method="post" id="VentasAlmomento" >
<div class="text-center">
<button type="submit" hidden  name="submit_registro" id="submit_registro" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
<input type="text" class="form-control " hidden name="Vendedor[]" readonly value="<?php echo $row['Nombre_Apellidos']?>" >
  <input type="text" class="form-control "  hidden name="PagoReal[]" readonly id="pagoreal" >
  <input type="text" class="form-control " hidden id="formapago1"name="FormaPago[]" readonly  >
  <input type="text" class="form-control "   hidden id="formapagorealistaaa" name="FormaPagoTickettt" readonly  >
  <input type="text" class="form-control " hidden name="Cambio[]" readonly id="cambioreal" >
 <input type="datetime" name="Horadeimpresion" hidden value="<?php echo date('h:i:s A');?>">
  <input type="date" class="form-control " hidden readonly name="FechaImpresion" id="FechaImpresion" value="<?php echo $fcha;?>">
<input type="text" class="form-control "  hidden readonly value="<?php echo $ValorCaja['Valor_Total_Caja']?>" >
  <input type="text" class="form-control " hidden id="valcaja"name="CajaSucursal[]" readonly value="<?php echo $ValorCaja["ID_Caja"];?>" >
    <input type="number" class="form-control " hidden id="ticketval" name="TicketVal" value="<?php echo $totalmonto;?>"readonly  >
     <input type="number" class="form-control " id="totalventa" hidden name ="TotalVentas[]" readonly  >
   <input type="text" hidden class="form-control "  name="Sucursaleventas[]"readonly value="<?php echo $row['Fk_Sucursal']?>" >
<input type="text" hidden class="form-control "  name="Empresa[]" readonly value="<?php echo $row['ID_H_O_D']?>" >
<input type="text" hidden class="form-control "  name="Sistema[]" readonly value="Ventas" >
<input type="date" hidden class="form-control "  name="Fecha[]" readonly value="<?php echo $fcha?>" >
<input type="text"hidden class="form-control " name="TurnoCaja[]" readonly value="<?php echo $ValorCaja['Turno']?>" >
  
   <!-- SEGUNDO PRODUCTP -->

<script>

 function sumar()
  {
    var $total = document.getElementById('totalventa2');
    var $total2 = document.getElementById('totalventa');
    var $Importetotal = document.getElementById('subtotal');
    var subtotal = 0;
    [ ...document.getElementsByClassName( "montoreal" ) ].forEach( function ( element ) {
      if(element.value !== '') {
        subtotal += parseFloat(element.value);
      }
    });
    $total.value = subtotal;
    $total2.value = subtotal;
    $Importetotal.value = subtotal;
  } 
</script>

<script src="js/RealizaVentas.js"></script>
<script src="js/RemueveProductos.js"></script>   
<script src="js/Descuentos.js"></script>