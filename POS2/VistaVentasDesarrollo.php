<?php
include "Consultas/Consultas.php";

include "Consultas/ConsultaCaja.php";
include "Consultas/SumadeFolioTickets.php";

include ("Consultas/db_connection.php");
$fcha = date("Y-m-d");

// 
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
  
</script>
<script>
function multiplicar() {
    // Obtener el contenedor principal de las filas
    var contenedorFilas = $('#parte1');

    // Inicializar la suma total
    var sumaTotal = 0;

    // Iterar sobre todas las filas dentro del contenedor
    contenedorFilas.find('.row').each(function () {
        // Obtener los valores de la fila actual
        var precioProducto = parseFloat($(this).find('.Precio').val()) || 0;
        var cantidadVenta = parseFloat($(this).find('.Cantidad').val()) || 0;

        // Calcular el importe para la fila actual
        var importe = precioProducto * cantidadVenta;

        // Actualizar el campo de importe para la fila actual
        $(this).find('.montoreal').val(importe.toFixed(2));

        // Sumar el importe al total
        sumaTotal += importe;
    });

    // Actualizar el campo de importe total (puedes ajustar el selector según tu estructura HTML)
    $('#totalImporte').val(sumaTotal.toFixed(2));

    // Llamar a la función de suma (si es necesario)
    sumar();
}

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
                    <input type="text" class="form-control  formapago-dinamico" hidden id="formapago1" name="FormaPago[]" readonly>\
<input type="text" class="form-control formapago-dinamico"   id="formapagorealistaaa" hidden name="FormaPagoTickettt" readonly>\
<input type="text" class="form-control pago-dinamico"  hidden name="PagoReal[]" readonly id="pagoreal" >\
                    <input type="text" hidden class="form-control "  name="Sucursaleventas[]"readonly value="<?php echo $row['Fk_Sucursal']?>" >\
                    <input type="text" class="form-control " hidden name="Vendedor[]" readonly value="<?php echo $row['Nombre_Apellidos']?>" >\
                    <input type="text" hidden class="form-control "  name="Empresa[]" readonly value="<?php echo $row['ID_H_O_D']?>" >\
<input type="text" hidden class="form-control "  name="Sistema[]" readonly value="Ventas" >\
<input type="date" hidden class="form-control "  name="Fecha[]" readonly value="<?php echo $fcha?>" >\
<input type="text"hidden class="form-control " name="TurnoCaja[]" readonly value="<?php echo $ValorCaja['Turno']?>" >\
<input type="text" class="form-control " hidden id="valcaja"name="CajaSucursal[]" readonly value="<?php echo $ValorCaja["ID_Caja"];?>" >\
<input class="form-control Codigo cliente" value="Publico General" hidden type="text" id="cliente" name="cliente[]">\
<input class="form-control sv" hidden type="text" id="sv" name="foliosv[]" />\
<input class="form-control tk-dinamico" hidden type="text" id="tk1" name="ticketant[]" />\
                    <input class="Lote form-control" hidden readonly type="text" id="lote" name="pro_lote[]" placeholder="Ingrese minimo de existencia" aria-describedby="basic-addon1" >\
                    <input class="FKID form-control" hidden type="text" id="fkid" name="pro_FKID[]"/>\
                    <input class="Clavead form-control" hidden type="text" id="clavad" name="pro_clavad[]"/>\
                    <input class="Identificador form-control" hidden type="text" id="identificadortip" name="IdentificadorTip[]"/>\
                    <input type="text" class="Codigo form-control " readonly id="codbarras" name="CodBarras[]"  >\
                    <input type="text" hidden class="Codigodescuento form-control " readonly id="tipodescuentoaplicado" name="tipodescuentoaplicado[]"  >\
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
                    <input class="form-control" readonly type="number" id="descuento1" value="0" name="DescuentoAplicado[]"> </div>\
                <div class="col">\
                    <label for="exampleFormControlInput1">Cantidad<span class="text-danger">*</span></label>\
                    <input class="Cantidad form-control" onchange="multiplicar()"  id="cantidadventa" value="1" type="number" name="CantidadTotal[]"  ></div>\
                <div class="col"> \
                    <label for="exampleFormControlInput1">Descuento</label>\
                    <a data-toggle="modal" data-target="#Descuento1detalles" class="btn btn-primary btn-sm" onclick="setFilaActual(this)"><i class="fas fa-percent"></i></a>\
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
                multiplicar();
            });

            // Resto de las acciones necesarias
            
            // Limpiar el campo de búsqueda
            $('#FiltrarContenido').val("");
            multiplicar();
        }
    });
});
</script>

</div></div>
<!-- Modal de descuentos -->
<div class="modal fade bd-example-modal-sm" id="Descuento1detalles" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-notify modal-success">
    <div class="modal-content">
      <div class="text-center">
        <div class="modal-header">
          <p class="heading lead">Aplicar descuentos <i class="fas fa-credit-card"></i></p>
          <button type="button" id="Cierra" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="white-text">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <label for="exampleFormControlInput1">Tipo de descuento <span class="text-danger">*</span></label>
          <!-- Toggle para seleccionar porcentaje o monto -->
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="tipoDescuento" id="porcentaje" value="porcentaje" checked onchange="cambiarTipoDescuento()">
            <label class="form-check-label" for="porcentaje">Porcentaje</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="tipoDescuento" id="monto" value="monto" onchange="cambiarTipoDescuento()">
            <label class="form-check-label" for="monto">Monto</label>
          </div>

          <!-- Input para porcentaje de descuento -->
          <div id="inputPorcentaje" class="mt-3">
            <label for="cantidadadescontar">% a descontar <span class="text-danger">*</span></label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="Tarjeta"><i class="fas fa-percent"></i></span>
              </div>
              <select id="cantidadadescontar" class="form-control" onchange="aplicarDescuentoSeleccionado()">
                <option value="">Seleccionar descuento</option>
                <option value="5">5%</option>
                <option value="10">10%</option>
                <option value="15">15%</option>
                <option value="20">20%</option>
                <!-- Agrega otros valores según sea necesario -->
                <option value="100">100%</option>
              </select>
            </div>
          </div>

          <!-- Input para monto de descuento (inicialmente oculto) -->
        <!-- Input para monto de descuento (inicialmente oculto) -->
<div id="inputMonto" class="mt-3" style="display: none;">
    <label for="montoDescuento">Monto a descontar <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
        </div>
        <input type="number" id="montoDescuento" class="form-control" placeholder="Especifica el monto">
        <div class="input-group-append">
            <button class="btn btn-primary" type="button" onclick="aplicarDescuentoSeleccionado()">Aplicar</button>
        </div>
    </div>
</div>

        </div>
      </div>
    </div>
  </div>
</div>



<script>
 var filaActual; // Variable global para almacenar la fila actual

function setFilaActual(boton) {
    // Obtén la fila asociada al botón
    filaActual = $(boton).closest('.row');
}

function cambiarTipoDescuento() {
    // Mostrar u ocultar los campos según el tipo de descuento seleccionado
    if (document.getElementById("porcentaje").checked) {
        document.getElementById("inputPorcentaje").style.display = "block";
        document.getElementById("inputMonto").style.display = "none";
    } else {
        document.getElementById("inputPorcentaje").style.display = "none";
        document.getElementById("inputMonto").style.display = "block";
    }
}

function aplicarDescuento(importeUnitario, cantidad, cantidadDescuento, esPorcentaje) {
    // Calcula el importe total basado en la cantidad
    var importeTotal = importeUnitario * cantidad;

    // Calcula el descuento (porcentaje o monto fijo)
    var descuento = esPorcentaje ? (importeTotal * cantidadDescuento) / 100 : cantidadDescuento * cantidad;

    // Calcula el importe con descuento
    var valorConDescuento = importeTotal - descuento;

    return {
        valorConDescuento: valorConDescuento,
        descuento: descuento
    };
}

function actualizarFilaConDescuento(resultadoDescuento, cantidadDescuentoSeleccionado) {
    // Actualiza el campo de monto real (precio total con descuento)
    filaActual.find('.montoreal').val(resultadoDescuento.valorConDescuento.toFixed(2));

    // Actualiza el campo de descuento en la fila
    filaActual.find('.Descuento').val(resultadoDescuento.descuento.toFixed(2));

    // Muestra el descuento aplicado en el campo descuento1
    filaActual.find('#descuento1').val(parseInt(cantidadDescuentoSeleccionado));
}

function aplicarDescuentoEnFila(cantidadDescuento) {
    if (filaActual) {
        var precioProducto = parseFloat(filaActual.find('.Precio').val()) || 0; // Precio unitario
        var cantidadProducto = parseInt(filaActual.find('.Cantidad').val()) || 1; // Cantidad del producto
        var esPorcentaje = document.getElementById("porcentaje").checked;

        // Calcula el descuento considerando la cantidad
        var resultadoDescuento = aplicarDescuento(precioProducto, cantidadProducto, cantidadDescuento, esPorcentaje);

        // Actualiza los valores en la fila actual
        actualizarFilaConDescuento(resultadoDescuento, cantidadDescuento);

        // Actualiza el campo de tipo de descuento aplicado en la fila actual
        var tipoDescuento = esPorcentaje ? "Porcentaje" : "Monto";
        filaActual.find('.Codigodescuento').val(tipoDescuento);
    }
}

function aplicarDescuentoSeleccionado() {
    var cantidadDescuento = 0;

    // Verifica si el descuento es porcentaje o monto
    if (document.getElementById("porcentaje").checked) {
        cantidadDescuento = parseFloat(document.getElementById("cantidadadescontar").value) || 0;
    } else {
        cantidadDescuento = parseFloat(document.getElementById("montoDescuento").value) || 0;
    }

    // Aplica el descuento solo en la fila correspondiente
    aplicarDescuentoEnFila(cantidadDescuento);

    // Actualiza el total
    actualizarTotal();

    // Cierra el modal
    $('#Descuento1detalles').modal('hide');

    // Resetea el estado de la ventana modal
    resetearModal();

    // Muestra SweetAlert
    Swal.fire({
        icon: 'success',
        title: 'Descuento aplicado',
        showConfirmButton: false,
        timer: 1500
    });
}

function actualizarTotal() {
    var contenedorFilas = $('#parte1');
    var sumaTotal = 0;

    // Recorre todas las filas y suma los importes considerando la cantidad
    contenedorFilas.find('.row').each(function () {
        var cantidad = parseInt($(this).find('.Cantidad').val()) || 1;
        var importeUnitario = parseFloat($(this).find('.montoreal').val()) || 0;
        sumaTotal += importeUnitario * cantidad;
    });

    // Actualiza los campos de totales
    $('#totalventa').val(sumaTotal.toFixed(2));
    $('#totalventa2').val(sumaTotal.toFixed(2));
    $('#subtotal').val(sumaTotal.toFixed(2));
}

function resetearModal() {
    $('#cantidadadescontar').val('');
    $('#montoDescuento').val('');
    document.getElementById("porcentaje").checked = true;
    cambiarTipoDescuento();
}


function actualizarTotal() {
    var contenedorFilas = $('#parte1');
    var sumaTotal = 0;

    contenedorFilas.find('.row').each(function () {
        var importe = parseFloat($(this).find('.montoreal').val()) || 0;
        sumaTotal += importe;
    });

    // Actualiza el campo totalventa
    $('#totalventa').val(sumaTotal.toFixed(2));

    // Actualiza el campo totalventa2 (ajusta el id según sea necesario)
    $('#totalventa2').val(sumaTotal.toFixed(2));
    $('#subtotal').val(sumaTotal.toFixed(2));
}
</script>



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


<script src="js/RealizaVentasDesarrollo.js"></script>
<script src="js/RemueveProductos.js"></script>   
<script src="js/Descuentos.js"></script>