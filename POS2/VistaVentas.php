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
<input type="text" class="form-control "  readonly value="<?php echo $row['Nombre_Apellidos']?>" >
    
    <div class="col">
      
    <label for="exampleFormControlInput1">Caja</label> <br>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-barcode"></i></span>
  </div>
  <input type="text" class="form-control "  readonly value="<?php echo $ValorCaja['Valor_Total_Caja']?>" >
  <input type="text" class="form-control " id="valcaja" name="CajaSucursal[]" readonly value="<?php echo $ValorCaja["ID_Caja"];?>" >
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
<button id="Ajusteeee" onclick="sumar()">Ajustar total de venta<i class="fas fa-cash-register"></i></button>
<form action="javascript:void(0)"     target="print_popup"  method="post" id="VentasAlmomento" >
<div class="text-center">
<button type="submit"  name="submit_registro" id="submit_registro" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
<input type="text" class="form-control " name="Vendedor[]" readonly value="<?php echo $row['Nombre_Apellidos']?>" >
  <input type="text" class="form-control "  name="PagoReal[]" readonly id="pagoreal" >
  <input type="text" class="form-control " id="formapago"name="FormaPago[]" readonly  >
  <input type="text" class="form-control "   id="formapagorealistaaa" name="FormaPagoTickettt" readonly  >
  <input type="text" class="form-control " name="Cambio[]" readonly id="cambioreal" >
 <input type="datetime" name="Horadeimpresion" value="<?php echo date('h:i:s A');?>">
  <input type="date" class="form-control " readonly name="FechaImpresion" id="FechaImpresion" value="<?php echo $fcha;?>">
<input type="text" class="form-control "  readonly value="<?php echo $ValorCaja['Valor_Total_Caja']?>" >
  <input type="text" class="form-control " id="valcaja"name="CajaSucursal[]" readonly value="<?php echo $ValorCaja["ID_Caja"];?>" >
    <input type="text" class="form-control " id="ticketsucname" name="TicketSucursalName" value="<?php echo $resultado_en_mayusculas; ?>"readonly  >
    <input type="text" class="form-control " id="ticketval" name="TicketVal" value="<?php echo $totalmonto_con_ceros; ?>"readonly  >
     <input type="number" class="form-control " id="totalventa" name ="TotalVentas[]" readonly  >
   <input type="text" class="form-control "  name="Sucursaleventas[]"readonly value="<?php echo $row['Fk_Sucursal']?>" >
<input type="text" class="form-control "  name="Empresa[]" readonly value="<?php echo $row['ID_H_O_D']?>" >
<input type="text" class="form-control "  name="Sistema[]" readonly value="Ventas" >
<input type="date" class="form-control "  name="Fecha[]" readonly value="<?php echo $fcha?>" >
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
$(document).ready(function () {
    $("#FiltrarContenido").autocomplete({
        source: "Consultas/VentaDeProductos.php",
        minLength: 2,
        appendTo: "#productos",
        select: function (event, ui) {
            event.preventDefault();

            // Crear un nuevo elemento div con la clase "row"
            var nuevoCampo = document.createElement("div");
            nuevoCampo.className = "row";

            // Construir la estructura interna del nuevo campo
            nuevoCampo.innerHTML = '\
                <div class="col">\
                    <label for="exampleFormControlInput1">Codigo <span class="text-danger">*</span></label>\
                    <input type="text" class="form-control " id="formapago" name="FormaPago[]" value="Esteeselgood" readonly  >\
                    <input type="text" class="form-control "  name="PagoReal[]" readonly id="pagoreal" >\
                    <input type="text" class="form-control "  name="Sucursaleventas[]"readonly value="<?php echo $row['Fk_Sucursal']?>" >\
                    <input type="text" class="form-control " name="Vendedor[]" readonly value="<?php echo $row['Nombre_Apellidos']?>" >\
                    <input type="text" class="form-control "  name="Empresa[]" readonly value="<?php echo $row['ID_H_O_D']?>" >\
<input type="text" class="form-control "  name="Sistema[]" readonly value="Ventas" >\
<input type="date" class="form-control "  name="Fecha[]" readonly value="<?php echo $fcha?>" >\
<input type="text"hidden class="form-control " name="TurnoCaja[]" readonly value="<?php echo $ValorCaja['Turno']?>" >\
<input type="text" class="form-control " id="valcaja"name="CajaSucursal[]" readonly value="<?php echo $ValorCaja["ID_Caja"];?>" >\
<input class="form-control Codigo cliente" value="Publico General" type="text" id="cliente" name="cliente[]">\
<input class="form-control sv" type="text" id="sv" name="foliosv[]" />\
 <input class="form-control" type="text" id="tk1" name="ticketant[]" />\
                    <input class="Lote form-control" readonly type="text" id="lote" name="pro_lote[]" placeholder="Ingrese minimo de existencia" aria-describedby="basic-addon1" >\
                    <input class="FKID form-control" type="text" id="fkid" name="pro_FKID[]"/>\
                    <input class="Clavead form-control" type="text" id="clavad" name="pro_clavad[]"/>\
                    <input class="Identificador form-control" type="text" id="identificadortip" name="IdentificadorTip[]"/>\
                    <input type="text" class="Codigo form-control " readonly id="codbarras" name="CodBarras[]"  >\
                </div>\
                <div class="col">\
                    <label for="exampleFormControlInput1">Producto<span class="text-danger">*</span></label>\
                    <textarea class="Nombre form-control" readonly id="nombreprod" name="NombreProd[]" rows="3"></textarea>\
                </div>\
                <div class="col">\
                    <label for="exampleFormControlInput1">Precio<span class="text-danger">*</span></label>\
                    <input class="Precio form-control" readonly type="number" id="precioprod"  name="pro_cantidad[]" ></div>\
                <div class="col">\
                    <label for="exampleFormControlInput1">Importe<span class="text-danger">*</span></label>\
                    <input class="montoreal form-control" readonly type="number" id="costoventa" name="ImporteT[]" >  </div>\
                <div class="col">\
                    <label for="exampleFormControlInput1">Descuento<span class="text-danger">*</span></label>\
                    <input class="form-control" readonly type="number" id="descuento1"  value="0" name="DescuentoAplicado[]" > </div>\
                <div class="col">\
                    <label for="exampleFormControlInput1">Cantidad<span class="text-danger">*</span></label>\
                    <input class="Cantidad form-control" onfocus="multiplicar()"  id="cantidadventa" value="1" type="number" name="CantidadTotal[]"  ></div>\
                <div class="col"> \
                    <label for="exampleFormControlInput1">Descuento</label>\
                    <a data-toggle="modal" data-target="#Descuento1detalles" class="btn btn-primary btn-sm "><i class="fas fa-percent"></i></a>\
                </div>\
                <!-- Agrega otros campos según sea necesario -->\
                <div class="col"> \
                    <button type="button" class="btn btn-danger btn-sm remover_campo">Remover</button>\
                </div>\
';

            // Agregar el nuevo campo al contenedor
            $('#parte1').append(nuevoCampo);

          // Actualizar los valores del nuevo campo
          $(nuevoCampo).find('.Codigo').val(ui.item.pro_nombre);
            $(nuevoCampo).find('.Nombre').val(ui.item.NombreProd);
            $(nuevoCampo).find('.Precio').val(ui.item.pro_cantidad);
            $(nuevoCampo).find('.montoreal').val(ui.item.pro_cantidad); // Puedes ajustar esto según tus necesidades
            $(nuevoCampo).find('.FKID').val(ui.item.pro_FKID);
            $(nuevoCampo).find('.Clavead').val(ui.item.pro_clavad);
            $(nuevoCampo).find('.Lote').val(ui.item.pro_lote);
            $(nuevoCampo).find('.Identificador').val(ui.item.IdentificadorTip);
            // ... y así sucesivamente

            // Asociar un evento de clic al botón de remover
            $(nuevoCampo).find('.remover_campo').click(function () {
                $(nuevoCampo).remove();
            });

            // Resto de las acciones necesarias

            // Limpiar el campo de búsqueda
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


<script src="js/RealizaVentas.js"></script>
<script src="js/RemueveProductos.js"></script>   
<script src="js/Descuentos.js"></script>