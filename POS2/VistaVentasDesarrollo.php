<?php
include "Consultas/Consultas.php";
include "Consultas/ConsultaCaja.php";
include "Consultas/SumadeFolioTickets.php";
include "Consultas/db_connection.php";

$fecha = date("Y-m-d");
$primeras_tres_letras = substr($row['Nombre_Sucursal'], 0, 4);
$resultado_concatenado = strtoupper($primeras_tres_letras);
?>

<div class="text-center">
    <button data-toggle="modal" data-target="#CambioAdar" class="btn btn-success btn-sm">Realizar venta <i class="fas fa-cash-register"></i></button>
    <button class="btn btn-danger btn-sm" onclick="CargaGestionventas();">Cancelar venta <i class="far fa-window-close"></i></button>
    <div class="row">
        <input hidden type="text" class="form-control" readonly value="<?php echo $row['Nombre_Apellidos'] ?>">
        <div class="col">
            <label for="exampleFormControlInput1">Caja</label> <br>
            <div class="input-group mb-3">
                <div class="input-group-prepend"><span class="input-group-text" id="Tarjeta2"><i class="fas fa-barcode"></i></span></div>
                <input type="text" class="form-control" readonly value="<?php echo $ValorCaja['Valor_Total_Caja'] ?>">
                <input type="text" class="form-control" hidden id="valcaja" name="CajaSucursal[]" readonly value="<?php echo $ValorCaja["ID_Caja"]; ?>">
            </div>
        </div>
        <div class="col">
            <label for="exampleFormControlInput1">Turno</label> <br>
            <div class="input-group mb-3">
                <div class="input-group-prepend"><span class="input-group-text" id="Tarjeta2"><i class="fas fa-clock"></i></span></div>
                <input type="text" class="form-control" readonly value="<?php echo $ValorCaja['Turno'] ?>">
            </div>
        </div>
        <div class="col">
            <label for="exampleFormControlInput1">Numero de ticket</label> <br>
            <div class="input-group mb-3">
                <div class="input-group-prepend"><span class="input-group-text" id="Tarjeta2"><i class="fas fa-receipt"></i></span></div>
                <input type="text" class="form-control" value="<?php echo $resultado_concatenado; ?><?php echo $totalmonto_con_ceros; ?>" readonly>
            </div>
        </div>
        <div class="col">
            <label for="exampleFormControlInput1">Total de venta </label> <br>
            <div class="input-group mb-3">
                <div class="input-group-prepend"><span class="input-group-text" id="Tarjeta2"><i class="fas fa-money-check-alt"></i></span></div>
                <input type="number" class="form-control" id="totalventa2" readonly>
            </div>
        </div>
    </div>
</div>

<script>
$(function () {
    $("body").keypress(function (e) {
        return (e.which != 13);
    });
});
</script>

<form action="javascript:void(0)" target="print_popup" method="post" id="VentasAlmomento">
    <div class="text-center">
        <button type="submit" hidden name="submit_registro" id="submit_registro" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
        <input type="text" class="form-control" hidden name="Vendedor[]" readonly value="<?php echo $row['Nombre_Apellidos'] ?>">
        <input type="text" class="form-control" hidden name="Cambio[]" readonly id="cambioreal">
        <input type="datetime" name="Horadeimpresion" hidden value="<?php echo date('h:i:s A'); ?>">
        <input type="date" class="form-control" hidden readonly name="FechaImpresion" id="FechaImpresion" value="<?php echo $fecha; ?>">
        <input type="text" class="form-control" hidden readonly value="<?php echo $ValorCaja['Valor_Total_Caja'] ?>">
        <input type="text" class="form-control" hidden id="valcaja" name="CajaSucursal[]" readonly value="<?php echo $ValorCaja["ID_Caja"]; ?>">
        <input type="text" class="form-control" hidden id="ticketsucname" name="TicketSucursalName" value="<?php echo $resultado_concatenado; ?>" readonly>
        <input type="text" class="form-control" hidden id="ticketval" name="TicketVal" value="<?php echo $totalmonto_con_ceros; ?>" readonly>
        <input type="number" class="form-control" id="totalventa" hidden name="TotalVentas[]" readonly>
        <input type="text" hidden class="form-control" name="Sucursaleventas[]" readonly value="<?php echo $row['Fk_Sucursal'] ?>">
        <input type="text" hidden class="form-control" name="Empresa[]" readonly value="<?php echo $row['ID_H_O_D'] ?>">
        <input type="text" hidden class="form-control" name="Sistema[]" readonly value="Ventas">
        <input type="date" hidden class="form-control" name="Fecha[]" readonly value="<?php echo $fecha ?>">
        <input type="text" hidden class="form-control" name="TurnoCaja[]" readonly value="<?php echo $ValorCaja['Turno'] ?>">
    </div>
</form>

<script>
function multiplicar() {
    const contenedorFilas = $('#parte1');
    let sumaTotal = 0;

    contenedorFilas.find('.row').each(function () {
        const precioProducto = parseFloat($(this).find('.Precio').val()) || 0;
        const cantidadVenta = parseFloat($(this).find('.Cantidad').val()) || 0;
        const importe = precioProducto * cantidadVenta;

        $(this).find('.montoreal').val(importe.toFixed(2));
        sumaTotal += importe;
    });

    $('#totalImporte').val(sumaTotal.toFixed(2));
    sumar();
}

function sumar() {
    const $total = $('#totalventa2');
    const $total2 = $('#totalventa');
    const $Importetotal = $('#subtotal');
    let subtotal = 0;

    $('.montoreal').each(function () {
        if (this.value !== '') {
            subtotal += parseFloat(this.value);
        }
    });

    $total.val(subtotal);
    $total2.val(subtotal);
    $Importetotal.val(subtotal);
}

$(document).ready(function () {
    $("#FiltrarContenido").autocomplete({
        source: "Consultas/VentaDeProductos.php",
        minLength: 2,
        appendTo: "#productos",
        select: function (event, ui) {
            event.preventDefault();

            const nuevoCampo = $('<div class="row"></div>').html(`
                <div class="col">
                    <label for="exampleFormControlInput1">Codigo <span class="text-danger">*</span></label>
                    <input type="text" class="form-control formapago-dinamico" hidden id="formapago1" name="FormaPago[]" readonly>
                    <input type="text" class="form-control formapago-dinamico" hidden id="formapagorealistaaa" name="FormaPagoTickettt" readonly>
                    <input type="text" class="form-control pago-dinamico" hidden name="PagoReal[]" readonly id="pagoreal">
                    <input type="text" hidden class="form-control" name="Sucursaleventas[]" readonly value="<?php echo $row['Fk_Sucursal'] ?>">
                    <input type="text" class="form-control" hidden name="Vendedor[]" readonly value="<?php echo $row['Nombre_Apellidos'] ?>">
                    <input type="text" hidden class="form-control" name="Empresa[]" readonly value="<?php echo $row['ID_H_O_D'] ?>">
                    <input type="text" hidden class="form-control" name="Sistema[]" readonly value="Ventas">
                    <input type="date" hidden class="form-control" name="Fecha[]" readonly value="<?php echo $fecha ?>">
                    <input type="text" hidden class="form-control" name="TurnoCaja[]" readonly value="<?php echo $ValorCaja['Turno'] ?>">
                    <input type="text" class="form-control" hidden id="valcaja" name="CajaSucursal[]" readonly value="<?php echo $ValorCaja["ID_Caja"]; ?>">
                    <input class="form-control Codigo cliente" value="Publico General" hidden type="text" id="cliente" name="cliente[]">
                    <input class="form-control sv" hidden type="text" id="sv" name="foliosv[]" />
                    <input class="form-control tk-dinamico" hidden type="text" id="tk1" name="ticketant[]" />
                    <input class="Lote form-control" hidden readonly type="text" id="lote" name="pro_lote[]" placeholder="Ingrese minimo de existencia" aria-describedby="basic-addon1">
                    <input class="FKID form-control" hidden type="text" id="fkid" name="pro_FKID[]"/>
                    <input class="Clavead form-control" hidden type="text" id="clavad" name="pro_clavad[]"/>
                    <input class="Identificador form-control" hidden type="text" id="identificadortip" name="IdentificadorTip[]"/>
                    <input type="text" class="Codigo form-control" readonly id="codbarras" name="CodBarras[]">
                    <input type="text" hidden class="Codigodescuento form-control" readonly id="tipodescuentoaplicado" name="tipodescuentoaplicado[]">
                </div>
                <div class="col">
                    <label for="exampleFormControlInput1">Producto<span class="text-danger">*</span></label>
                    <textarea class="Nombre form-control" readonly id="nombreprod" name="NombreProd[]" rows="3"></textarea>
                </div>
                <div class="col">
                    <label for="exampleFormControlInput1">P.U.<span class="text-danger">*</span></label>
                    <input class="PrecioReal form-control" readonly type="number" id="PuSindescuento" name="PuSindescuento[]">
                </div>
                <div class="col">
                    <label for="exampleFormControlInput1">P. Desc.<span class="text-danger">*</span></label>
                    <input class="Precio form-control" readonly type="number" id="precioprod" name="pro_cantidad[]">
                </div>
                <div class="col">
                    <label for="exampleFormControlInput1">Importe<span class="text-danger">*</span></label>
                    <input class="montoreal form-control" readonly type="number" id="costoventa" name="ImporteT[]">
                </div>
                <div class="col">
                    <label for="exampleFormControlInput1">Descuento<span class="text-danger">*</span></label>
                    <input class="form-control" readonly type="number" id="descuento1" value="0" name="DescuentoAplicado[]">
                </div>
                <div class="col">
                    <label for="exampleFormControlInput1">Cantidad<span class="text-danger">*</span></label>
                    <input class="Cantidad form-control" onchange="multiplicar()" id="cantidadventa" value="1" type="number" name="CantidadTotal[]">
                </div>
                <div class="col">
                    <label for="exampleFormControlInput1">Descuento</label>
                    <a data-toggle="modal" data-target="#Descuento1detalles" class="btn btn-primary btn-sm" onclick="setFilaActual(this)"><i class="fas fa-percent"></i></a>
                </div>
                <div class="col">
                    <button type="button" class="btn btn-danger btn-sm remover_campo">Remover</button>
                </div>
            `);

            $('#parte1').append(nuevoCampo);

            nuevoCampo.find('.Codigo').val(ui.item.pro_nombre);
            nuevoCampo.find('.Nombre').val(ui.item.NombreProd);
            nuevoCampo.find('.PrecioReal').val(ui.item.pro_cantidad);
            nuevoCampo.find('.Precio').val(ui.item.pro_cantidad);
            nuevoCampo.find('.montoreal').val(ui.item.pro_cantidad);
            nuevoCampo.find('.FKID').val(ui.item.pro_FKID);
            nuevoCampo.find('.Clavead').val(ui.item.pro_clavad);
            nuevoCampo.find('.Lote').val(ui.item.pro_lote);
            nuevoCampo.find('.Identificador').val(ui.item.IdentificadorTip);

            nuevoCampo.find('.remover_campo').click(function () {
                $(this).closest('.row').remove();
                multiplicar();
            });

            $('#FiltrarContenido').val("");
            multiplicar();
        }
    });
});
</script>

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
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="tipoDescuento" id="porcentaje" value="porcentaje" checked onchange="cambiarTipoDescuento()">
            <label class="form-check-label" for="porcentaje">Porcentaje</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="tipoDescuento" id="monto" value="monto" onchange="cambiarTipoDescuento()">
            <label class="form-check-label" for="monto">Monto</label>
          </div>
          <div id="inputPorcentaje" class="mt-3">
            <label for="cantidadadescontar">% a descontar <span class="text-danger">*</span></label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="Tarjeta"><i class="fas fa-percent"></i></span>
              </div>
              <select id="cantidadadescontar" class="form-control" onchange="aplicarDescuentoSeleccionado()">
                <option value="">Seleccionar descuento</option>
                <?php for ($i = 1; $i <= 100; $i++) echo "<option value=\"$i\">$i%</option>"; ?>
              </select>
            </div>
          </div>
          <div id="inputMonto" class="mt-3" style="display: none;">
            <label for="montoDescuento">Monto a descontar <span class="text-danger">*</span></label>
            <div class="input-group mb-3">
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
let filaActual;

function setFilaActual(boton) {
  filaActual = $(boton).closest('.row');
}

function cambiarTipoDescuento() {
  if (document.getElementById("porcentaje").checked) {
    document.getElementById("inputPorcentaje").style.display = "block";
    document.getElementById("inputMonto").style.display = "none";
  } else {
    document.getElementById("inputPorcentaje").style.display = "none";
    document.getElementById("inputMonto").style.display = "block";
  }
}

function aplicarDescuento(importe, cantidadDescuento, esPorcentaje, cantidad) {
  const totalImporte = importe * cantidad;
  const descuento = esPorcentaje ? (totalImporte * cantidadDescuento) / 100 : cantidadDescuento * cantidad;
  const valorConDescuento = totalImporte - descuento;

  return { valorConDescuento, descuento };
}

function actualizarFilaConDescuento(resultadoDescuento, cantidadDescuentoSeleccionado, cantidad, precioUnitario) {
  filaActual.find('.montoreal').val(resultadoDescuento.valorConDescuento.toFixed(2));
  filaActual.find('.Descuento').val(resultadoDescuento.descuento.toFixed(2));
  filaActual.find('#descuento1').val(parseInt(cantidadDescuentoSeleccionado));
  const precioUnitarioConDescuento = resultadoDescuento.valorConDescuento / cantidad;
  filaActual.find('.Precio').val(precioUnitarioConDescuento.toFixed(2));
}

function aplicarDescuentoEnFila(cantidadDescuento) {
  if (filaActual) {
    const precioProducto = parseFloat(filaActual.find('.Precio').val()) || 0;
    const cantidad = parseInt(filaActual.find('.Cantidad').val()) || 1;
    const esPorcentaje = document.getElementById("porcentaje").checked;
    const resultadoDescuento = aplicarDescuento(precioProducto, cantidadDescuento, esPorcentaje, cantidad);
    actualizarFilaConDescuento(resultadoDescuento, cantidadDescuento, cantidad, precioProducto);
    const tipoDescuento = esPorcentaje ? "Porcentaje" : "Monto";
    filaActual.find('.Codigodescuento').val(tipoDescuento);
  }
}

function aplicarDescuentoSeleccionado() {
  let cantidadDescuento = 0;
  if (document.getElementById("porcentaje").checked) {
    cantidadDescuento = parseFloat(document.getElementById("cantidadadescontar").value) || 0;
  } else {
    cantidadDescuento = parseFloat(document.getElementById("montoDescuento").value) || 0;
  }
  aplicarDescuentoEnFila(cantidadDescuento);
  actualizarTotal();
  $('#Descuento1detalles').modal('hide');
  resetearModal();
  Swal.fire({
    icon: 'success',
    title: 'Descuento aplicado',
    showConfirmButton: false,
    timer: 1500
  });
}

function actualizarTotal() {
  const contenedorFilas = $('#parte1');
  let sumaTotal = 0;
  contenedorFilas.find('.row').each(function () {
    const importe = parseFloat($(this).find('.montoreal').val()) || 0;
    sumaTotal += importe;
  });
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
</script>

<?php
if ($ValorCaja["Estatus"] != 'Abierta') {
    echo '<script>$(document).ready(function() { $("#NoCaja").modal("show"); });</script>';
}
?>

<script src="js/CalculaTotaldeproducto.js"></script>
<script src="js/RealizaVentas.js"></script>
<script src="js/RemueveProductos.js"></script>
<script src="js/Descuentos.js"></script>