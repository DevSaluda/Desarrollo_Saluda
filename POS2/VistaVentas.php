<?php
include "Consultas/Consultas.php";

include "Consultas/ConsultaCaja.php";
include "Consultas/SumadeFolioTickets.php";

include ("Consultas/db_connection.php");
$fcha = date("Y-m-d");

// Suponiendo que $row['Nombre_Sucursal'] contiene un string con más de 3 caracteres
$primeras_tres_letras = substr($row['Nombre_Sucursal'], 0, 4);


// Concatenar las primeras 3 letras con el valor de $totalmonto
$resultado_concatenado = $primeras_tres_letras ;

// Convertir el resultado a mayúsculas
$resultado_en_mayusculas = strtoupper($resultado_concatenado);

// Imprimir el resultado en mayúsculas
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
    <input type="text" class="form-control " value="<?php echo $resultado_en_mayusculas; ?><?php echo $totalmonto_con_ceros; ?>" readonly  >
  
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
    <input type="text" class="form-control " hidden id="ticketsucname" name="TicketSucursalName" value="<?php echo $resultado_en_mayusculas; ?>"readonly  >
    <input type="text" class="form-control " hidden id="ticketval" name="TicketVal" value="<?php echo $totalmonto_con_ceros; ?>"readonly  >
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
<div id="parte1">
    <!-- Contenedor donde se agregarán los campos dinámicamente -->
</div>


<script>
  var xini = 0;
$(document).ready(function () {
    $("#FiltrarContenido").autocomplete({
        source: "Consultas/VentaDeProductos.php",
        minLength: 2,
        appendTo: "#productos",
        select: function (event, ui) {
            event.preventDefault();

            var campoClone = $("#campoTemplate").clone().removeAttr("id").removeClass("remover_campo").show();

            // Modificar IDs y otros atributos según sea necesario
            campoClone.find('.Codigo').attr('id', 'codbarras_' + xini);
            campoClone.find('.Nombre').attr('id', 'nombreprod_' + xini);
            // ... y así sucesivamente

            // Agregar el campo clonado al DOM
            $('#parte1').append(campoClone);

            // Actualizar los valores del nuevo campo
            campoClone.find('.Codigo').val(ui.item.pro_nombre);
            campoClone.find('.Nombre').val(ui.item.NombreProd);
            // ... y así sucesivamente

            xini++;

            $('#FiltrarContenido').val("");
            $("#cantidadventa").focus();
        }
    });
});
</script>

</div></div>
 <?php
if($ValorCaja["Estatus"] == 'Abierta'){

    
     }else{
    
      echo '
      <script>
$(document).ready(function()
{
  // id de nuestro modal
  $("#NoCaja").modal("show");
});
</script>
      ';
      
      
    
     }
     
     ?>

     
<script src="js/CalculaTotaldeproducto.js"></script>

<!-- <script>
var campos_maxini          = 1;   //max de 10 campos
var xini = 0;



$('#add_fieldinicial').click (function(e) {
        e.preventDefault();     //prevenir novos clicks
        if (xini < campos_maxini) {
                $('#parte1').append('<a hidden class="btn btn-warning btn-sm"  id="remover_campoini"><i class="fas fa-minus-circle"></i></a>\
                <div class="row">\
    <div class="col">\
    <label for="exampleFormControlInput1">Codigo  <span class="text-danger">*</span></label>\
    <input class="form-control" value="Publico General" hidden type="text" id="cliente1" name="cliente[]" />\
    <input class="form-control"   hidden type="text" id="sv1" name="foliosv[]" />\
    <input class="form-control"   hidden type="text" id="tk1" name="ticketant[]" />\
    <input class="FKID form-control"  hidden type="text" id="fkid" name="pro_FKID[]"/>\
    <input class="Clavead form-control"   hidden type="text" id="clavad" name="pro_clavad[]"/>\
    <input class="Identificador form-control"  hidden type="text" id="identificadortip" name="IdentificadorTip[]"/>\
  <input type="text" class="Codigo form-control " readonly id="codbarras" name="CodBarras[]"  ></div>\
   <div class="col">\
    <label for="exampleFormControlInput1">Producto<span class="text-danger">*</span></label>\
 <textarea class="Nombre form-control" readonly id="nombreprod"name="NombreProd[]" rows="3"></textarea></div>\
     <input hidden type="text" class="Lote form-control" readonly type="text" id="lote"name="pro_lote[]" placeholder="Ingrese minimo de existencia" aria-describedby="basic-addon1" ><div class="col">\
    <label for="exampleFormControlInput1">Precio<span class="text-danger">*</span></label>\
  <input  class="Precio form-control" readonly type="number" id="precioprod"  name="pro_cantidad[]" ></div>\
    <div class="col">\
    <label for="exampleFormControlInput1">Importe<span class="text-danger">*</span></label>\
<input  class="montoreal form-control" readonly type="number" id="costoventa" name="ImporteT[]" >  </div>\
    <div class="col">\
    <label for="exampleFormControlInput1">Descuento<span class="text-danger">*</span></label>\
     <input  class="form-control" readonly type="number" id="descuento1"  value="0"name="DescuentoAplicado[]" > </div>\
    <div class="col">\
    <label for="exampleFormControlInput1">Cantidad<span class="text-danger">*</span></label>\
   <input   class="Cantidad form-control" onfocus="multiplicar()"  id="cantidadventa" value="1" type="number" name="CantidadTotal[]"  ></div>\
    <div class="col"> \
    <label for="exampleFormControlInput1">Descuento</label>\
    <a data-toggle="modal" data-target="#Descuento1detalles" class="btn btn-primary btn-sm "><i class="fas fa-percent"></i></a>\
    </div>\
    <div class="col"> \
    <label for="exampleFormControlInput1">Remover</label>\
    <a  class="btn btn-danger btn-sm" id="remueveinicial" onclick="removerinicial();"><i class="fas fa-trash-alt"></i></a>\
    </div>\
    </div>\
                </div>');
  
xini++;
              
$("#cantidadventa").attr('onchange','multiplicar()');    
               
        }
        
}); 

$('#parte1').on("click","#remover_campoini",function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        xini--;
        $("#FiltrarContenido2").hide()
        $("#FiltrarContenido3").hide()
        $("#FiltrarContenido4").hide()
        $("#FiltrarContenido5").hide()
        $("#FiltrarContenido6").hide()
        $("#FiltrarContenido7").hide()
        $("#FiltrarContenido8").hide()
        $("#FiltrarContenido9").hide()
        $("#FiltrarContenido10").hide()
    $("#FiltrarContenido").show()
  ;
  $("#Ajusteeee").trigger("click");
});
</script>
<script>
var campos_max          = 1;   //max de 10 campos
var x = 0;



$('#add_field').click (function(e) {
        e.preventDefault();     //prevenir novos clicks
        if (x < campos_max) {
                $('#parte2').append('<a hidden class="btn btn-warning btn-sm"  id="remover_campo"><i class="fas fa-minus-circle"></i></a>\
              <div class="row">\
    <div class="col">\
    <label for="exampleFormControlInput1">Codigo <span class="text-danger">*</span></label>\
    <input class="form-control" value="Publico General" hidden type="text" id="cliente2" name="cliente[]" />\
    <input class="form-control" hidden  type="text" id="sv2" name="foliosv[]" />\
    <input class="form-control"   hidden type="text" id="tk2" name="ticketant[]" />\
    <input class="form-control"  hidden type="text" id="fkid2" name="pro_FKID[]"/>\
    <input class="form-control"   hidden type="text" id="clavad2" name="pro_clavad[]"/>\
    <input class="form-control"  hidden type="text" id="identificadortip2" name="IdentificadorTip[]"/>\
    <input type="text" class="form-control " readonly id="codbarras2" name="CodBarras[]"  >\
</div>\
    <div class="col">\
    <label for="exampleFormControlInput1">Producto <span class="text-danger">*</span></label>\
  <textarea class="form-control" readonly id="nombreprod2"name="NombreProd[]" rows="3"></textarea>\
    </div>\
    <div class="col">\
   <input type="text" class="form-control" hidden readonly type="text" id="lote2"name="pro_lote[]" placeholder="Ingrese minimo de existencia" aria-describedby="basic-addon1" >\
  <label for="exampleFormControlInput1">Precio<span class="text-danger">*</span></label>\
  <input  class="form-control" type="number" readonly id="precioprod2"  name="pro_cantidad[]" > </div>\
    <div class="col">\
    <label for="exampleFormControlInput1">Importe<span class="text-danger">*</span></label>\
  <input  class="montoreal form-control" readonly type="number" id="costoventa2"  name="ImporteT[]"  > </div>\
  <div class="col">\
    <label for="exampleFormControlInput1">Descuento<span class="text-danger">*</span></label>\
    <input  class=" form-control" readonly type="number" id="descuento2"  name="DescuentoAplicado[]" >  </div>\
   <div class="col">\
    <label for="exampleFormControlInput1">Cantidad<span class="text-danger">*</span></label>\
    <input   class="multireal form-control"  id="cantidad2"  onchange="multiplicar2() "type="number" name="CantidadTotal[]" value="1"  > </div>\
    <div class="col">\ <label for="exampleFormControlInput1">Descuento</label>\
    <a data-toggle="modal" data-target="#Descuento2detalles" class="btn btn-primary btn-sm "><i class="fas fa-percent"></i></a></div>\
    <div class="col"> \
    <label for="exampleFormControlInput1">Remover</label>\
    <a id="remueve1" onclick="remover();"class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>\
    </div>\
    </div>\
<input type="text" hidden class="form-control "  name="Sucursaleventas[]"readonly value="<?php echo $row['Fk_Sucursal']?>">\
<input type="text"hidden class="form-control " name="TurnoCaja[]" readonly value="<?php echo $ValorCaja['Turno']?>" >\
<input type="date" hidden class="form-control "  name="Fecha[]" readonly value="<?php echo $fcha?>" >\
<input type="text" class="form-control " hidden name="Descuento[]" readonly value="0.00" >\
<input type="text"  hidden class="form-control "  name="Empresa[]" readonly value="<?php echo $row['ID_H_O_D']?>" >\
<input type="text"  hidden class="form-control "  name="Sistema[]" readonly value="Ventas" >\
<input type="text" class="form-control " hidden id="valcaja"name="CajaSucursal[]" readonly value="<?php echo $ValorCaja["ID_Caja"];?>" >\
<input type="text" class="form-control " hidden id="formapago2"name="FormaPago[]" readonly  >\
<input type="text" hidden class="form-control " name="Vendedor[]" readonly value="<?php echo $row['Nombre_Apellidos']?>" >\
</div>');
                x++;
              
                
               
        }
        
}); 
// Remover o div anterior
$('#parte2').on("click","#remover_campo",function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
        $("#FiltrarContenido2").hide()
        $("#FiltrarContenido3").hide()
        $("#FiltrarContenido4").hide()
        $("#FiltrarContenido5").hide()
        $("#FiltrarContenido6").hide()
        $("#FiltrarContenido7").hide()
        $("#FiltrarContenido8").hide()
        $("#FiltrarContenido9").hide()
        $("#FiltrarContenido10").hide()
    $("#FiltrarContenido").show()
  ;
  $("#Ajusteeee").trigger("click");
});


</script>     
  

<script>
// VENTA2

var campos_max2          = 1;   //max de 10 campos
var x2 = 0;
$('#add_field2').click (function(e) {
        e.preventDefault();     //prevenir novos clicks
        if (x2 < campos_max2) {
                $('#parte3').append('<div>\
                <a hidden class="btn btn-warning btn-sm" id="remover_campo2"><i class="fas fa-minus-circle"></i></a>\
              <div class="row">\
    <div class="col">\
    <label for="exampleFormControlInput1">Codigo barras <span class="text-danger">*</span></label>\
    <input class="form-control" value="Publico General" hidden type="text" id="cliente3" name="cliente[]" />\
    <input class="form-control" hidden  type="text" id="sv3" name="foliosv[]" />\
    <input class="form-control"   hidden type="text" id="tk3" name="ticketant[]" />\
    <input class="form-control"  hidden type="text" id="fkid3" name="pro_FKID[]"/>\
    <input class="form-control"   hidden type="text" id="clavad3" name="pro_clavad[]"/>\
    <input class="form-control"  hidden type="text" id="identificadortip3" name="IdentificadorTip[]"/>\
    <input type="text" class="form-control " readonly id="codbarras3" name="CodBarras[]"  >\
</div>\
    <div class="col">\
    <label for="exampleFormControlInput1">Producto <span class="text-danger">*</span></label>\
  <textarea class="form-control" readonly id="nombreprod3"name="NombreProd[]" rows="3"></textarea>\
    </div>\
  <input type="text" class="form-control" hidden readonly type="text" id="lote3"name="pro_lote[]" placeholder="Ingrese minimo de existencia" aria-describedby="basic-addon1" >\
    <div class="col">\
    <label for="exampleFormControlInput1">Costo venta<span class="text-danger">*</span></label>\
    <input  class="form-control" type="number" readonly id="precioprod3"  name="pro_cantidad[]" > </div>\
    <div class="col">\
    <label for="exampleFormControlInput1">Importe<span class="text-danger">*</span></label>\
  <input  class="montoreal form-control" readonly type="number" id="costoventa3" name="ImporteT[]"  > </div>\
  <div class="col">\
    <label for="exampleFormControlInput1">Descuento<span class="text-danger">*</span></label>\
  <input  class="Precio form-control" readonly type="number" id="descuento3"  name="DescuentoAplicado[]" ></div>\
   <div class="col">\
    <label for="exampleFormControlInput1">Cantidad<span class="text-danger">*</span></label>\
<input   class="form-control"  id="cantidad3" onchange="multiplicar3()" type="number" name="CantidadTotal[]" value="1"  > </div>\
<div class="col">\ <label for="exampleFormControlInput1">Descuento</label>\
    <a data-toggle="modal" data-target="#Descuento3detalles" class="btn btn-primary btn-sm "><i class="fas fa-percent"></i></a></div>\
    <div class="col"> \
    <label for="exampleFormControlInput1">Remover</label>\
    <a id="remueve2" onclick="remover2();"class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>\
    </div>\
<input type="text" hidden class="form-control "  name="Sucursaleventas[]"readonly value="<?php echo $row['Fk_Sucursal']?>">\
<input type="text"hidden class="form-control " name="TurnoCaja[]" readonly value="<?php echo $ValorCaja['Turno']?>" >\
<input type="text" class="form-control " hidden name="Descuento[]" readonly value="0.00" >\
<input type="text"  hidden class="form-control "  name="Empresa[]" readonly value="<?php echo $row['ID_H_O_D']?>" >\
<input type="date" hidden class="form-control "  name="Fecha[]" readonly value="<?php echo $fcha?>" >\
<input type="text"  hidden class="form-control "  name="Sistema[]" readonly value="Ventas" >\
<input type="text" class="form-control " hidden id="valcaja"name="CajaSucursal[]" readonly value="<?php echo $ValorCaja["ID_Caja"];?>" >\
<input type="text" class="form-control "  hidden id="formapago3"name="FormaPago[]" readonly  >\
<input type="text" hidden class="form-control " name="Vendedor[]" readonly value="<?php echo $row['Nombre_Apellidos']?>" >\
</div>');
                x2++;
        }
}); 
// Remover o div anterior
$('#parte3').on("click","#remover_campo2",function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x2--;
        $("#FiltrarContenido3").hide()
    $("#FiltrarContenido2").show()
    multiplicar2();
});
</script>   


<script>

// VENTA3

var campos_max3          = 1;   //max de 10 campos
var x3 = 0;
$('#add_field3').click (function(e) {
        e.preventDefault();     //prevenir novos clicks
        if (x3 < campos_max3) {
                $('#parte4').append('<div>\
                <a hidden class="btn btn-warning btn-sm"  id="remover_campo3"><i class="fas fa-minus-circle"></i></a>\
              <div class="row">\
    <div class="col">\
    <label for="exampleFormControlInput1">Codigo barras <span class="text-danger">*</span></label>\
    <input class="form-control" value="Publico General" hidden type="text" id="cliente4" name="cliente[]" />\
    <input class="form-control" hidden  type="text" id="sv4" name="foliosv[]" />\
    <input class="form-control"  hidden type="text" id="fkid4" name="pro_FKID[]"/>\
    <input class="form-control"   hidden type="text" id="tk4" name="ticketant[]" />\
    <input class="form-control"   hidden type="text" id="clavad4" name="pro_clavad[]"/>\
    <input class="form-control"  hidden type="text" id="identificadortip4" name="IdentificadorTip[]"/>\
    <input type="text" class="form-control " readonly id="codbarras4" name="CodBarras[]"  >\
</div>\
    <div class="col">\
    <label for="exampleFormControlInput1">Producto <span class="text-danger">*</span></label>\
  <textarea class="form-control" readonly id="nombreprod4"name="NombreProd[]" rows="3"></textarea>\
    </div>\
  <input type="text" class="form-control" readonly type="text" hidden id="lote4"name="pro_lote[]" placeholder="Ingrese minimo de existencia" aria-describedby="basic-addon1" >\
    <div class="col">\
    <label for="exampleFormControlInput1">Costo venta<span class="text-danger">*</span></label>\
    <input  class="form-control" type="number" readonly id="precioprod4"  name="pro_cantidad[]" > </div>\
    <div class="col">\
    <label for="exampleFormControlInput1">Importe<span class="text-danger">*</span></label>\
  <input  class="montoreal form-control" readonly type="number" id="costoventa4" name="ImporteT[]" > </div>\
  <div class="col">\
    <label for="exampleFormControlInput1">Descuento<span class="text-danger">*</span></label>\
  <input  class="Precio form-control" readonly type="number" id="descuento4"  name="DescuentoAplicado[]" ></div>\
   <div class="col">\
    <label for="exampleFormControlInput1">Cantidad<span class="text-danger">*</span></label>\
<input   class="form-control"  id="cantidad4" type="number" onchange="multiplicar4()" name="CantidadTotal[]" value="1" > </div>\
<div class="col">\ <label for="exampleFormControlInput1">Descuento</label>\
    <a data-toggle="modal" data-target="#Descuento4detalles" class="btn btn-primary btn-sm "><i class="fas fa-percent"></i></a></div>\
    <div class="col"> \
    <label for="exampleFormControlInput1">Remover</label>\
    <a id="remueve3" onclick="remover3();"class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>\
    </div>\
<input type="text" hidden class="form-control "  name="Sucursaleventas[]"readonly value="<?php echo $row['Fk_Sucursal']?>">\
<input type="text"hidden class="form-control " name="TurnoCaja[]" readonly value="<?php echo $ValorCaja['Turno']?>" >\
<input type="text" class="form-control " hidden name="Descuento[]" readonly value="0.00" >\
<input type="text"  hidden class="form-control "  name="Empresa[]" readonly value="<?php echo $row['ID_H_O_D']?>" >\
<input type="date" hidden class="form-control "  name="Fecha[]" readonly value="<?php echo $fcha?>" >\
<input type="text"  hidden class="form-control "  name="Sistema[]" readonly value="Ventas" >\
<input type="text" class="form-control " hidden id="valcaja"name="CajaSucursal[]" readonly value="<?php echo $ValorCaja["ID_Caja"];?>" >\
<input type="text" class="form-control " hidden id="formapago4"name="FormaPago[]" readonly  >\
<input type="text" hidden class="form-control " name="Vendedor[]" readonly value="<?php echo $row['Nombre_Apellidos']?>" >\
</div>');
                x3++;
        }
}); 
// Remover o div anterior
$('#parte4').on("click","#remover_campo3",function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x3--;
        $("#FiltrarContenido4").hide()
    $("#FiltrarContenido3").show()
    multiplicar3();
});
</script>



<script>

// VENTA4

var campos_max4          = 1;   //max de 10 campos
var x4 = 0;
$('#add_field4').click (function(e) {
        e.preventDefault();     //prevenir novos clicks
        if (x4 < campos_max4) {
                $('#parte5').append('<div>\
                <a hidden class="btn btn-warning btn-sm" id="remover_campo4"><i class="fas fa-minus-circle"></i></a>\
              <div class="row">\
    <div class="col">\
    <label for="exampleFormControlInput1">Codigo barras <span class="text-danger">*</span></label>\
    <input class="form-control" value="Publico General" hidden type="text" id="cliente5" name="cliente[]" />\
    <input class="form-control" hidden  type="text" id="sv5" name="foliosv[]" />\
    <input class="form-control"   hidden type="text" id="tk5" name="ticketant[]" />\
    <input class="form-control"  hidden type="text" id="fkid5" name="pro_FKID[]"/>\
    <input class="form-control"   hidden type="text" id="clavad5" name="pro_clavad[]"/>\
    <input class="form-control"  hidden type="text" id="identificadortip5" name="IdentificadorTip[]"/>\
    <input type="text" class="form-control " readonly id="codbarras5" name="CodBarras[]"  >\
</div>\
    <div class="col">\
    <label for="exampleFormControlInput1">Producto <span class="text-danger">*</span></label>\
  <textarea class="form-control" readonly id="nombreprod5"name="NombreProd[]" rows="3"></textarea>\
    </div>\
  <input type="text" class="form-control" readonly hidden type="text" id="lote5"name="pro_lote[]" placeholder="Ingrese minimo de existencia" aria-describedby="basic-addon1" >\
    <div class="col">\
    <label for="exampleFormControlInput1">Costo venta<span class="text-danger">*</span></label>\
    <input  class="form-control" type="number" readonly id="precioprod5"  name="pro_cantidad[]" > </div>\
    <div class="col">\
    <label for="exampleFormControlInput1">Importe<span class="text-danger">*</span></label>\
  <input  class="montoreal form-control" readonly type="number" id="costoventa5"  name="ImporteT[]"> </div>\
  <div class="col">\
    <label for="exampleFormControlInput1">Descuento<span class="text-danger">*</span></label>\
  <input  class="Precio form-control" readonly type="number" id="descuento5"  name="DescuentoAplicado[]" ></div>\
   <div class="col">\
    <label for="exampleFormControlInput1">Cantidad<span class="text-danger">*</span></label>\
<input   class="form-control"  id="cantidad5" type="number" onchange="multiplicar5()" name="CantidadTotal[]" value="1" > </div>\
<div class="col">\ <label for="exampleFormControlInput1">Descuento</label>\
    <a data-toggle="modal" data-target="#Descuento5detalles" class="btn btn-primary btn-sm "><i class="fas fa-percent"></i></a></div>\
    <div class="col"> \
    <label for="exampleFormControlInput1">Remover</label>\
    <a id="remueve4" onclick="remover4();"class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>\
    </div>\
<input type="text" hidden class="form-control "  name="Sucursaleventas[]"readonly value="<?php echo $row['Fk_Sucursal']?>">\
<input type="text"hidden class="form-control " name="TurnoCaja[]" readonly value="<?php echo $ValorCaja['Turno']?>" >\
<input type="text" class="form-control " hidden name="Descuento[]" readonly value="0.00" >\
<input type="text"  hidden class="form-control "  name="Empresa[]" readonly value="<?php echo $row['ID_H_O_D']?>" >\
<input type="date" hidden class="form-control "  name="Fecha[]" readonly value="<?php echo $fcha?>" >\
<input type="text"  hidden class="form-control "  name="Sistema[]" readonly value="Ventas" >\
<input type="text" class="form-control " hidden id="valcaja"name="CajaSucursal[]" readonly value="<?php echo $ValorCaja["ID_Caja"];?>" >\
<input type="text" class="form-control " hidden id="formapago5"name="FormaPago[]" readonly  >\
<input type="text" hidden class="form-control " name="Vendedor[]" readonly value="<?php echo $row['Nombre_Apellidos']?>" >\
</div>');
                x4++;
        }
}); 
// Remover o div anterior
$('#parte5').on("click","#remover_campo4",function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x4--;
        $("#FiltrarContenido5").hide()
    $("#FiltrarContenido4").show()
    multiplicar4();
});
</script>




<script>

// VENTA5

var campos_max5         = 1;   //max de 10 campos
var x5 = 0;
$('#add_field5').click (function(e) {
        e.preventDefault();     //prevenir novos clicks
        if (x5 < campos_max5) {
                $('#parte6').append('<div>\
                <a hidden class="btn btn-warning btn-sm" id="remover_campo5"><i class="fas fa-minus-circle"></i></a>\
              <div class="row">\
    <div class="col">\
    <label for="exampleFormControlInput1">Codigo barras <span class="text-danger">*</span></label>\
    <input class="form-control" value="Publico General" hidden type="text" id="cliente6" name="cliente[]" />\
    <input class="form-control" hidden  type="text" id="sv6" name="foliosv[]" />\
    <input class="form-control"   hidden type="text" id="tk6" name="ticketant[]" />\
    <input class="form-control"  hidden type="text" id="fkid6" name="pro_FKID[]"/>\
    <input class="form-control"   hidden type="text" id="clavad6" name="pro_clavad[]"/>\
    <input class="form-control"  hidden type="text" id="identificadortip6" name="IdentificadorTip[]"/>\
    <input type="text" class="form-control " readonly id="codbarras6" name="CodBarras[]"  >\
</div>\
    <div class="col">\
    <label for="exampleFormControlInput1">Producto <span class="text-danger">*</span></label>\
  <textarea class="form-control" readonly id="nombreprod6"name="NombreProd[]" rows="3"></textarea>\
    </div>\
  <input type="text" class="form-control" readonly hidden type="text" id="lote6"name="pro_lote[]" placeholder="Ingrese minimo de existencia" aria-describedby="basic-addon1" >\
    <div class="col">\
    <label for="exampleFormControlInput1">Costo venta<span class="text-danger">*</span></label>\
    <input  class="form-control" type="number" readonly id="precioprod6"  name="pro_cantidad[]" > </div>\
    <div class="col">\
    <label for="exampleFormControlInput1">Importe<span class="text-danger">*</span></label>\
  <input  class="montoreal form-control" readonly type="number" id="costoventa6" name="ImporteT[]" > </div>\
  <div class="col">\
    <label for="exampleFormControlInput1">Descuento<span class="text-danger">*</span></label>\
  <input  class="Precio form-control" readonly type="number" id="descuento6"  name="DescuentoAplicado[]" ></div>\
   <div class="col">\
    <label for="exampleFormControlInput1">Cantidad<span class="text-danger">*</span></label>\
<input   class="form-control"  id="cantidad6" type="number" onchange="multiplicar6()" name="CantidadTotal[]" value="1" > </div>\
<div class="col">\ <label for="exampleFormControlInput1">Descuento</label>\
    <a data-toggle="modal" data-target="#Descuento6detalles" class="btn btn-primary btn-sm "><i class="fas fa-percent"></i></a></div>\
    <div class="col"> \
    <label for="exampleFormControlInput1">Remover</label>\
    <a id="remueve5" onclick="remover5();"class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>\
    </div>\
<input type="text" hidden class="form-control "  name="Sucursaleventas[]"readonly value="<?php echo $row['Fk_Sucursal']?>">\
<input type="text"hidden class="form-control " name="TurnoCaja[]" readonly value="<?php echo $ValorCaja['Turno']?>" >\
<input type="text" class="form-control " hidden name="Descuento[]" readonly value="0.00" >\
<input type="text"  hidden class="form-control "  name="Empresa[]" readonly value="<?php echo $row['ID_H_O_D']?>" >\
<input type="date" hidden class="form-control "  name="Fecha[]" readonly value="<?php echo $fcha?>" >\
<input type="text"  hidden class="form-control "  name="Sistema[]" readonly value="Ventas" >\
<input type="text" class="form-control " hidden id="valcaja"name="CajaSucursal[]" readonly value="<?php echo $ValorCaja["ID_Caja"];?>" >\
<input type="text" class="form-control "  hidden id="formapago6"name="FormaPago[]" readonly  >\
<input type="text" hidden class="form-control " name="Vendedor[]" readonly value="<?php echo $row['Nombre_Apellidos']?>" >\
</div>');
                x5++;
        }
}); 
// Remover o div anterior
$('#parte6').on("click","#remover_campo5",function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x5--;
        $("#FiltrarContenido6").hide()
    $("#FiltrarContenido5").show()
    multiplicar5();
});
</script>




<script>

// VENTA6

var campos_max6         = 1;   //max de 10 campos
var x6 = 0;
$('#add_field6').click (function(e) {
        e.preventDefault();     //prevenir novos clicks
        if (x6 < campos_max6) {
                $('#parte7').append('<div>\
                <a hidden class="btn btn-warning btn-sm" id="remover_campo6"><i class="fas fa-minus-circle"></i></a>\
              <div class="row">\
    <div class="col">\
    <label for="exampleFormControlInput1">Codigo barras <span class="text-danger">*</span></label>\
    <input class="form-control" value="Publico General" hidden type="text" id="cliente7" name="cliente[]" />\
    <input class="form-control" hidden  type="text" id="sv7" name="foliosv[]" />\
    <input class="form-control"   hidden type="text" id="tk7" name="ticketant[]" />\
    <input class="form-control"  hidden type="text" id="fkid7" name="pro_FKID[]"/>\
    <input class="form-control"   hidden type="text" id="clavad7" name="pro_clavad[]"/>\
    <input class="form-control"  hidden type="text" id="identificadortip7" name="IdentificadorTip[]"/>\
    <input type="text" class="form-control " readonly id="codbarras7" name="CodBarras[]"  >\
</div>\
    <div class="col">\
    <label for="exampleFormControlInput1">Producto <span class="text-danger">*</span></label>\
  <textarea class="form-control" readonly id="nombreprod7"name="NombreProd[]" rows="3"></textarea>\
    </div>\
  <input type="text" class="form-control" readonly type="text" hidden id="lote7" name="pro_lote[]" placeholder="Ingrese minimo de existencia" aria-describedby="basic-addon1" >\
    <div class="col">\
    <label for="exampleFormControlInput1">Costo venta<span class="text-danger">*</span></label>\
    <input  class="form-control" type="number" readonly id="precioprod7"  name="pro_cantidad[]" > </div>\
    <div class="col">\
    <label for="exampleFormControlInput1">Importe<span class="text-danger">*</span></label>\
  <input  class="montoreal form-control" readonly type="number" id="costoventa7" name="ImporteT[]"  > </div>\
  <div class="col">\
    <label for="exampleFormControlInput1">Descuento<span class="text-danger">*</span></label>\
  <input  class="Precio form-control" readonly type="number" id="descuento7"  name="DescuentoAplicado[]" ></div>\
   <div class="col">\
    <label for="exampleFormControlInput1">Cantidad<span class="text-danger">*</span></label>\
<input   class="form-control"  id="cantidad7" type="number" onchange="multiplicar7()" name="CantidadTotal[]" value="1" > </div>\
<div class="col">\ <label for="exampleFormControlInput1">Descuento</label>\
    <a data-toggle="modal" data-target="#Descuento7detalles" class="btn btn-primary btn-sm "><i class="fas fa-percent"></i></a></div>\
    <div class="col"> \
    <label for="exampleFormControlInput1">Remover</label>\
    <a id="remueve6" onclick="remover6();"class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>\
    </div>\
<input type="text" hidden class="form-control "  name="Sucursaleventas[]"readonly value="<?php echo $row['Fk_Sucursal']?>">\
<input type="text"hidden class="form-control " name="TurnoCaja[]" readonly value="<?php echo $ValorCaja['Turno']?>" >\
<input type="text" class="form-control " hidden name="Descuento[]" readonly value="0.00" >\
<input type="text"  hidden class="form-control "  name="Empresa[]" readonly value="<?php echo $row['ID_H_O_D']?>" >\
<input type="date" hidden class="form-control "  name="Fecha[]" readonly value="<?php echo $fcha?>" >\
<input type="text"  hidden class="form-control "  name="Sistema[]" readonly value="Ventas" >\
<input type="text" class="form-control " hidden id="valcaja"name="CajaSucursal[]" readonly value="<?php echo $ValorCaja["ID_Caja"];?>" >\
<input type="text" class="form-control "  hidden id="formapago7"name="FormaPago[]" readonly  >\
<input type="text" hidden class="form-control " name="Vendedor[]" readonly value="<?php echo $row['Nombre_Apellidos']?>" >\
</div>');
                x6++;
        }
}); 
// Remover o div anterior
$('#parte7').on("click","#remover_campo6",function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x6--;
        $("#FiltrarContenido5").hide()
    $("#FiltrarContenido6").show()
    multiplicar6();
});
</script>



<script>

// VENTA7

var campos_max7         = 1;   //max de 10 campos
var x7 = 0;
$('#add_field7').click (function(e) {
        e.preventDefault();     //prevenir novos clicks
        if (x7 < campos_max7) {
                $('#parte8').append('<div>\
                <a hidden class="btn btn-warning btn-sm" id="remover_campo7"><i class="fas fa-minus-circle"></i></a>\
              <div class="row">\
    <div class="col">\
    <label for="exampleFormControlInput1">Codigo barras <span class="text-danger">*</span></label>\
    <input class="form-control" value="Publico General" hidden type="text" id="cliente8" name="cliente[]" />\
    <input class="form-control" hidden  type="text" id="sv8" name="foliosv[]" />\
    <input class="form-control"   hidden type="text" id="tk8" name="ticketant[]" />\
    <input class="form-control"  hidden type="text" id="fkid8" name="pro_FKID[]"/>\
    <input class="form-control"   hidden type="text" id="clavad8" name="pro_clavad[]"/>\
    <input class="form-control"  hidden type="text" id="identificadortip8" name="IdentificadorTip[]"/>\
    <input type="text" class="form-control " readonly id="codbarras8" name="CodBarras[]"  >\
</div>\
    <div class="col">\
    <label for="exampleFormControlInput1">Producto <span class="text-danger">*</span></label>\
  <textarea class="form-control" readonly id="nombreprod8"name="NombreProd[]" rows="3"></textarea>\
    </div>\
  <input type="text" class="form-control" hidden readonly type="text" id="lote8"name="pro_lote[]" placeholder="Ingrese minimo de existencia" aria-describedby="basic-addon1" >\
    <div class="col">\
    <label for="exampleFormControlInput1">Costo venta<span class="text-danger">*</span></label>\
    <input  class="form-control" type="number" readonly id="precioprod8"  name="pro_cantidad[]" > </div>\
    <div class="col">\
    <label for="exampleFormControlInput1">Importe<span class="text-danger">*</span></label>\
  <input  class="montoreal form-control" readonly type="number" id="costoventa8" name="ImporteT[]" > </div>\
  <div class="col">\
    <label for="exampleFormControlInput1">Descuento<span class="text-danger">*</span></label>\
  <input  class="Precio form-control" readonly type="number" id="descuento8"  name="DescuentoAplicado[]" ></div>\
   <div class="col">\
    <label for="exampleFormControlInput1">Cantidad<span class="text-danger">*</span></label>\
<input   class="form-control"  id="cantidad8" type="number" onchange="multiplicar8()" name="CantidadTotal[]" value="1" > </div>\
<div class="col">\ <label for="exampleFormControlInput1">Descuento</label>\
    <a data-toggle="modal" data-target="#Descuento8detalles" class="btn btn-primary btn-sm "><i class="fas fa-percent"></i></a></div>\
    <div class="col"> \
    <label for="exampleFormControlInput1">Remover</label>\
    <a id="remueve7" onclick="remover7();"class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>\
    </div>\
<input type="text" hidden class="form-control "  name="Sucursaleventas[]"readonly value="<?php echo $row['Fk_Sucursal']?>">\
<input type="text"hidden class="form-control " name="TurnoCaja[]" readonly value="<?php echo $ValorCaja['Turno']?>" >\
<input type="text" class="form-control " hidden name="Descuento[]" readonly value="0.00" >\
<input type="text"  hidden class="form-control "  name="Empresa[]" readonly value="<?php echo $row['ID_H_O_D']?>" >\
<input type="date" hidden class="form-control "  name="Fecha[]" readonly value="<?php echo $fcha?>" >\
<input type="text"  hidden class="form-control "  name="Sistema[]" readonly value="Ventas" >\
<input type="text" class="form-control " hidden id="valcaja"name="CajaSucursal[]" readonly value="<?php echo $ValorCaja["ID_Caja"];?>" >\
<input type="text" class="form-control "  hidden id="formapago8"name="FormaPago[]" readonly  >\
<input type="text" hidden class="form-control " name="Vendedor[]" readonly value="<?php echo $row['Nombre_Apellidos']?>" >\
</div>');
                x7++;
        }
}); 
// Remover o div anterior
$('#parte8').on("click","#remover_campo7",function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x7--;
        $("#FiltrarContenido6").hide()
    $("#FiltrarContenido7").show()
    multiplicar7();
});
</script>


<script>

// VENTA8

var campos_max8         = 1;   //max de 10 campos
var x8 = 0;
$('#add_field8').click (function(e) {
        e.preventDefault();     //prevenir novos clicks
        if (x8 < campos_max8) {
                $('#parte9').append('<div>\
                <a hidden class="btn btn-warning btn-sm" id="remover_campo8"><i class="fas fa-minus-circle"></i></a>\
              <div class="row">\
    <div class="col">\
    <label for="exampleFormControlInput1">Codigo barras <span class="text-danger">*</span></label>\
    <input class="form-control" value="Publico General" hidden type="text" id="cliente9" name="cliente[]" />\
    <input class="form-control" hidden  type="text" id="sv9" name="foliosv[]" />\
    <input class="form-control"   hidden type="text" id="tk9" name="ticketant[]" />\
    <input class="form-control"  hidden type="text" id="fkid9" name="pro_FKID[]"/>\
    <input class="form-control"   hidden type="text" id="clavad9" name="pro_clavad[]"/>\
    <input class="form-control"  hidden type="text" id="identificadortip9" name="IdentificadorTip[]"/>\
    <input type="text" class="form-control " readonly id="codbarras9" name="CodBarras[]"  >\
</div>\
    <div class="col">\
    <label for="exampleFormControlInput1">Producto <span class="text-danger">*</span></label>\
  <textarea class="form-control" readonly id="nombreprod9"name="NombreProd[]" rows="3"></textarea>\
    </div>\
  <input type="text" class="form-control" readonly type="text" hidden id="lote9"name="pro_lote[]" placeholder="Ingrese minimo de existencia" aria-describedby="basic-addon1" >\
    <div class="col">\
    <label for="exampleFormControlInput1">Costo venta<span class="text-danger">*</span></label>\
    <input  class="form-control" type="number" readonly id="precioprod9"  name="pro_cantidad[]" > </div>\
    <div class="col">\
    <label for="exampleFormControlInput1">Importe<span class="text-danger">*</span></label>\
  <input  class="montoreal form-control" readonly type="number" id="costoventa9"  name="ImporteT[]"> </div>\
  <div class="col">\
    <label for="exampleFormControlInput1">Descuento<span class="text-danger">*</span></label>\
  <input  class="Precio form-control" readonly type="number" id="descuento9"  name="DescuentoAplicado[]" ></div>\
   <div class="col">\
    <label for="exampleFormControlInput1">Cantidad<span class="text-danger">*</span></label>\
<input   class="form-control"  id="cantidad9" type="number" onchange="multiplicar9()" name="CantidadTotal[]" value="1" > </div>\
<div class="col">\ <label for="exampleFormControlInput1">Descuento</label>\
    <a data-toggle="modal" data-target="#Descuento9detalles" class="btn btn-primary btn-sm "><i class="fas fa-percent"></i></a></div>\
    <div class="col"> \
    <label for="exampleFormControlInput1">Remover</label>\
    <a id="remueve8" onclick="remover8();"class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>\
    </div>\
<input type="text" hidden class="form-control "  name="Sucursaleventas[]"readonly value="<?php echo $row['Fk_Sucursal']?>">\
<input type="text"hidden class="form-control " name="TurnoCaja[]" readonly value="<?php echo $ValorCaja['Turno']?>" >\
<input type="text" class="form-control " hidden name="Descuento[]" readonly value="0.00" >\
<input type="text"  hidden class="form-control "  name="Empresa[]" readonly value="<?php echo $row['ID_H_O_D']?>" >\
<input type="date" hidden class="form-control "  name="Fecha[]" readonly value="<?php echo $fcha?>" >\
<input type="text"  hidden class="form-control "  name="Sistema[]" readonly value="Ventas" >\
<input type="text" class="form-control " hidden id="valcaja"name="CajaSucursal[]" readonly value="<?php echo $ValorCaja["ID_Caja"];?>" >\
<input type="text" class="form-control "  hidden id="formapago9"name="FormaPago[]" readonly  >\
<input type="text" hidden class="form-control " name="Vendedor[]" readonly value="<?php echo $row['Nombre_Apellidos']?>" >\
</div>');
                x8++;
        }
}); 
// Remover o div anterior
$('#parte9').on("click","#remover_campo8",function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x8--;
        $("#FiltrarContenido8").hide()
    $("#FiltrarContenido7").show()
    multiplicar8();
});
</script>


<script>

// VENTA8

var campos_max9        = 1;   //max de 10 campos
var x9 = 0;
$('#add_field9').click (function(e) {
        e.preventDefault();     //prevenir novos clicks
        if (x9< campos_max9) {
                $('#parte10').append('<div>\
                <a hidden class="btn btn-warning btn-sm" id="remover_campo9"><i class="fas fa-minus-circle"></i></a>\
              <div class="row">\
    <div class="col">\
    <label for="exampleFormControlInput1">Codigo barras <span class="text-danger">*</span></label>\
    <input class="form-control" value="Publico General" hidden type="text" id="cliente10" name="cliente[]" />\
    <input class="form-control" hidden  type="text" id="sv10" name="foliosv[]" />\
    <input class="form-control"   hidden type="text" id="tk10" name="ticketant[]" />\
    <input class="form-control"  hidden type="text" id="fkid10" name="pro_FKID[]"/>\
    <input class="form-control"   hidden type="text" id="clavad10" name="pro_clavad[]"/>\
    <input class="form-control"  hidden type="text" id="identificadortip10" name="IdentificadorTip[]"/>\
    <input type="text" class="form-control " readonly id="codbarras10" name="CodBarras[]"  >\
</div>\
    <div class="col">\
    <label for="exampleFormControlInput1">Producto <span class="text-danger">*</span></label>\
  <textarea class="form-control" readonly id="nombreprod10"name="NombreProd[]" rows="3"></textarea>\
    </div>\
  <input type="text" class="form-control" readonly type="text" hidden id="lote10" name="pro_lote[]" placeholder="Ingrese minimo de existencia" aria-describedby="basic-addon1" >\
    <div class="col">\
    <label for="exampleFormControlInput1">Costo venta<span class="text-danger">*</span></label>\
    <input  class="form-control" type="number" readonly id="precioprod10"  name="pro_cantidad[]" > </div>\
    <div class="col">\
    <label for="exampleFormControlInput1">Importe<span class="text-danger">*</span></label>\
  <input  class="montoreal form-control" readonly type="number" id="costoventa10" name="ImporteT[]" > </div>\
  <div class="col">\
    <label for="exampleFormControlInput1">Descuento<span class="text-danger">*</span></label>\
  <input  class="Precio form-control" readonly type="number" id="descuento10"  name="DescuentoAplicado[]" ></div>\
   <div class="col">\
    <label for="exampleFormControlInput1">Cantidad<span class="text-danger">*</span></label>\
<input   class="form-control"  id="cantidad10" type="number" onchange="multiplicar10()" name="CantidadTotal[]" value="1" > </div>\
<div class="col">\ <label for="exampleFormControlInput1">Descuento</label>\
    <a data-toggle="modal" data-target="#Descuento10detalles" class="btn btn-primary btn-sm "><i class="fas fa-percent"></i></a></div>\
    <div class="col"> \
    <label for="exampleFormControlInput1">Remover</label>\
    <a id="remueve9" onclick="remover9();"class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>\
    </div>\
<input type="text" hidden class="form-control "  name="Sucursaleventas[]"readonly value="<?php echo $row['Fk_Sucursal']?>">\
<input type="text"hidden class="form-control " name="TurnoCaja[]" readonly value="<?php echo $ValorCaja['Turno']?>" >\
<input type="text" class="form-control " hidden name="Descuento[]" readonly value="0.00" >\
<input type="text"  hidden class="form-control "  name="Empresa[]" readonly value="<?php echo $row['ID_H_O_D']?>" >\
<input type="date" hidden class="form-control "  name="Fecha[]" readonly value="<?php echo $fcha?>" >\
<input type="text"  hidden class="form-control "  name="Sistema[]" readonly value="Ventas" >\
<input type="text" class="form-control " hidden id="valcaja"name="CajaSucursal[]" readonly value="<?php echo $ValorCaja["ID_Caja"];?>" >\
<input type="text" class="form-control " hidden id="formapago10"name="FormaPago[]" readonly  >\
<input type="text" hidden class="form-control " name="Vendedor[]" readonly value="<?php echo $row['Nombre_Apellidos']?>" >\
</div>');
                x8++;
        }
}); 
// Remover o div anterior
$('#parte10').on("click","#remover_campo9",function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x8--;
        $("#FiltrarContenido10").hide()
    $("#FiltrarContenido9").show()
    multiplicar9();
});
</script> -->
<script src="js/RealizaVentas.js"></script>
<script src="js/RemueveProductos.js"></script>   
<script src="js/Descuentos.js"></script>