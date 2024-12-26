<?php
include "Consultas/Consultas.php";

include("Consultas/db_connection.php");


$fechaActual = date('Y-m-d'); // Esto obtiene la fecha actual en el formato 'Año-Mes-Día'

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Ingreso de medicamentos <?php echo $row['ID_H_O_D'] ?> </title>

  <?php include "Header.php" ?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
 
  <style>
    .error {
      color: red;
      margin-left: 5px;

    }

    #Tarjeta2 {
      background-color: #e83e8c !important;
      color: white;
    }
    .btn-container {
  display: flex;
  justify-content: center;
  align-items: center;
}

.input-container {
  display: flex;
  flex-direction: column;
  align-items: center;
}

    
  </style>


</head>
<?php include_once("Menu.php") ?>
<!-- Aquí se carga la pantalla de inicio -->
<!-- Aquí se carga la pantalla de inicio -->


<style>
  .loader-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 180px;
  }

  .absCenter {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }

  .loaderPill {
    text-align: center;
  }

  .loaderPill-anim {
    height: 160px;
  }

  .loaderPill-anim-bounce {
    animation: loaderPillBounce 1800ms linear infinite;
  }

  .loaderPill-anim-flop {
    transform-origin: 50% 50%;
    animation: loaderPillFlop 1800ms linear infinite;
  }

  .loaderPill-pill {
    display: inline-block;
    box-sizing: border-box;
    width: 80px;
    height: 30px;
    border-radius: 15px;
    border: 1px solid #237db5;
    background-image: linear-gradient(to right, #C80096 50%, #ffffff 50%);
  }

  .loaderPill-floor {
    display: block;
    text-align: center;
  }

  .loaderPill-floor-shadow {
    display: inline-block;
    width: 70px;
    height: 7px;
    border-radius: 50%;
    background-color: rgba(35, 125, 181, 0.26);
    transform: translateY(-15px);
    animation: loaderPillScale 1800ms linear infinite;
  }

  .loaderPill-text {
    font-weight: bold;
    color: #C80096;
    text-transform: uppercase;
  }

  @keyframes loaderPillBounce {
    0% {
      transform: translateY(123px);
      animation-timing-function: cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    25% {
      transform: translateY(40px);
      animation-timing-function: cubic-bezier(0.55, 0.085, 0.68, 0.53);
    }
    50% {
      transform: translateY(120px);
      animation-timing-function: cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    75% {
      transform: translateY(20px);
      animation-timing-function: cubic-bezier(0.55, 0.085, 0.68, 0.53);
    }
    100% {
      transform: translateY(120px);
    }
  }

  @keyframes loaderPillFlop {
    0% {
      transform: rotate(0);
    }
    25% {
      transform: rotate(90deg);
    }
    50% {
      transform: rotate(180deg);
    }
    75% {
      transform: rotate(450deg);
    }
    100% {
      transform: rotate(720deg);
    }
  }

  @keyframes loaderPillScale {
    0% {
      transform: translateY(-15px) scale(1, 1);
      animation-timing-function: cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    25% {
      transform: translateY(-15px) scale(0.7, 1);
      animation-timing-function: cubic-bezier(0.55, 0.085, 0.68, 0.53);
    }
    50% {
      transform: translateY(-15px) scale(1, 1);
      animation-timing-function: cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    75% {
      transform: translateY(-15px) scale(0.6, 1);
      animation-timing-function: cubic-bezier(0.55, 0.085, 0.68, 0.53);
    }
    100% {
      transform: translateY(-15px) scale(1, 1);
    }
  }
</style>

<!-- Main content -->
<div class="content">


  <div class="container-fluid">

    <div class="row mb-3">

  

          <div class="card-body p-3">
            
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="row">
                  <!-- INPUT PARA INGRESO DEL CODIGO DE BARRAS O DESCRIPCION DEL PRODUCTO -->
                  <div class="col-md-12 mb-3">

                    <div class="form-group mb-2">
                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#FiltroEspecifico" class="btn btn-default">
 Cambiar de sucursal <i class="fas fa-clinic-medical"></i>
</button>



                      <div class="row">
                        <input hidden type="text" class="form-control " readonly value="<?php echo $row['Nombre_Apellidos'] ?>">

                        <div class="col">

                          <label for="exampleFormControlInput1" style="font-size: 0.75rem !important;">Sucursal</label>
                          <div class="input-group mb-3">
                            <div class="input-group-prepend"> <span class="input-group-text" id="Tarjeta2"><i class="fas fa-barcode"></i></span>
                            </div>
                            <input type="text" class="form-control " style="font-size: 0.75rem !important;" readonly value="<?php echo $row['Nombre_Sucursal'] ?>">
                           
                          </div>
                        </div>

                        <div class="col">

                          <label for="exampleFormControlInput1" style="font-size: 0.75rem !important;">Fecha</label>
                          <div class="input-group mb-3">
                            <div class="input-group-prepend"> <span class="input-group-text" id="Tarjeta2"><i class="fas fa-barcode"></i></span>
                            </div>
                            <input type="text" class="form-control " style="font-size: 0.75rem !important;" readonly value="<?php echo $fechaActual ?>">
                           
                          </div>
                        </div>
                        <div class="col">

<label for="exampleFormControlInput1" style="font-size: 0.75rem !important;">Factura</label>
<div class="input-group mb-3">
  <div class="input-group-prepend"> <span class="input-group-text" id="Tarjeta2"><i class="fas fa-barcode"></i></span>
  </div>
  <input type="text" class="form-control " id="numerofactura" style="font-size: 0.75rem !important;" >
 
</div>
</div>
      
<div class="col">

<label for="exampleFormControlInput1" style="font-size: 0.75rem !important;">Valor Total Factura</label>
<div class="input-group mb-3">
  <div class="input-group-prepend"> <span class="input-group-text" id="Tarjeta2"><i class="fas fa-barcode"></i></span>
  </div>
  <input type="number" class="form-control " id="totalfactura" style="font-size: 0.75rem !important;" >

</div>
</div>      

        </div>
    </div>
    <script>
       let selectedfactura = "";

document.getElementById('numerofactura').addEventListener('change', function() {
  selectedfactura = this.value;
});

    </script>


                       
<script>
// Función para obtener el valor de una cookie
function getCookie(name) {
    let value = "; " + document.cookie;
    let parts = value.split("; " + name + "=");
    if (parts.length === 2) return parts.pop().split(";").shift();
}

// Función para establecer una cookie
function setCookie(name, value, days) {
    let expires = "";
    if (days) {
        let date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

// Verifica si la cookie "ocultarInfo" está establecida
if (!getCookie("ocultarInfo")) {
    Swal.fire({
        title: "Información Importante",
        text: "Para garantizar que la información de los productos se guarde correctamente, es necesario ingresar el número de factura con la que se reciben. Si los productos a ingresar no cuentan con factura usar la fecha y lugar de ingreso (ejemplo: 26/12/2024CEDIS   O    26/12/2024OFICINA)",
        icon: "info",
        showCancelButton: true,
        cancelButtonText: "No mostrar de nuevo en 7 días",
        confirmButtonText: "OK"
    }).then((result) => {
        // Si se selecciona "No mostrar de nuevo en 7 días"
        if (result.dismiss === Swal.DismissReason.cancel) {
            setCookie("ocultarInfo", "true", 7);
        }
    });
}
</script>

                     <!-- Importa SweetAlert 2 -->


                      </div>

                      <label class="col-form-label" for="iptCodigoVenta">
                        <i class="fas fa-barcode fs-6"></i>
                        <span class="small">Productos</span>
                      </label>

                      <div class="input-group">

                        <input type="text" class="form-control producto" name="codigoEscaneado" id="codigoEscaneado" style="position: relative;" onchange="buscarArticulo();">
                      </div>
                    </div>

                  </div>

                  <!-- ETIQUETA QUE MUESTRA LA SUMA TOTAL DE LOS PRODUCTOS AGREGADOS AL LISTADO -->
               

                  <!-- BOTONES PARA VACIAR LISTADO Y COMPLETAR LA VENTA -->
                  <!-- <div class="col-md-5 text-right">

                    <button class="btn btn-danger btn-sm" id="btnVaciarListado">
                      <i class="far fa-trash-alt"></i> Vaciar Listado
                    </button>
                  </div> -->

                  <!-- LISTADO QUE CONTIENE LOS PRODUCTOS QUE SE VAN AGREGANDO PARA LA COMPRA -->
                
                      <style>
                        #tablaAgregarArticulos {
                          width: 100%;
                          table-layout: fixed;
                        }

                        #tablaAgregarArticulos td,
                        #tablaAgregarArticulos th {
                          white-space: nowrap;
                          overflow: hidden;
                          text-overflow: visible;


                        }

                        .smaller-button {
                          padding: 0.25rem 0.5rem;
                          font-size: 0.8rem;
                        }


                        div.card-body p-2 {
                          margin-top: -10px !important;
                          margin-bottom: 5px !important;
                        }
                        .no-click {
  pointer-events: none; /* Desactiva los eventos de puntero */
  cursor: default; /* Opcional: cambia el cursor a la apariencia predeterminada para que parezca no interactivo */
}

                        
                      </style>
                      
                      <form action="javascript:void(0)"  method="post" id="IngresoDeMedicamentos">
                      <div class="text-center">
        <button type="submit" class="btn btn-primary">Guardar datos</button>
    </div>
    <input type="number" class="form-control " hidden id="totalfactura2" name="CostototalFactura[]" style="font-size: 0.75rem !important;" >
                        <table class="table table-striped" id="tablaAgregarArticulos" class="display">
                          <thead>
                            <tr>

                              <th class="no-click">Codigo</th>
                              <th style="width:20%" class="no-click">Producto</th>
                              <th style="width:5%" class="no-click">Enviado</th>
                              <th style="width:3%" class="no-click">Existencia actual</th>
                              <th style="width:5%" class="no-click">Nueva existencias</th>
                              <th style="width:5%" class="no-click">Precio</th>
                              <th class="no-click" ># de Factura</th>
                     
                              <!-- <th>Precio compra</th>
                              <th>Importe</th> -->
                              <!-- <th>importe_Sin_Iva</th>
            <th>Iva</th>
            <th>valorieps</th> -->
                              <th>Eliminar</th>
                            
                            </tr>
                          </thead>
                          <tbody>

                          </tbody>
                        </table>
                        <!-- / table -->
                        
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
                
              </div>
            
              </form>

              

            </div>

          </div> <!-- ./ end card-body -->
        </div>

      </div>
     
</div>
</div>
</div>
</div>
<!-- function actualizarSumaTotal  -->
<script>
    function actualizarSuma() {
      // Obtener todos los inputs dinámicos
      const cantidadInputs = document.querySelectorAll('.cantidad-vendida-input');
      let suma = 0;

      // Calcular la suma de los valores
      cantidadInputs.forEach(input => {
        suma += parseFloat(input.value) || 0;
      });

      // Actualizar el valor de los inputs #totalfactura y #totalfacturareaal
      document.getElementById('totalfactura').value = suma;
      document.getElementById('totalfactura2').value = suma;
    }

    // Añadir el evento input a todos los inputs dinámicos
    document.addEventListener('DOMContentLoaded', () => {
      const cantidadInputs = document.querySelectorAll('.cantidad-vendida-input');

      cantidadInputs.forEach(input => {
        input.addEventListener('input', actualizarSuma);
      });

      // Llamar a la función para inicializar la suma en caso de que haya valores predeterminados
      actualizarSuma();
    });
  </script>

<script>
        function actualizarTotal() {
            let total = 0;

            // Obtén todos los elementos de cantidad y precio
            const cantidades = document.querySelectorAll('.cantidad-vendida-input');
            const precios = document.querySelectorAll('.preciou-input');

            // Itera sobre cada fila para calcular el total
            for (let i = 0; i < cantidades.length; i++) {
                const cantidad = parseFloat(cantidades[i].value) || 0;
                const precio = parseFloat(precios[i].value) || 0;
                total += cantidad * precio;
            }

            // Actualiza el valor del input totalfactura
            document.getElementById('totalfactura').value = total.toFixed(2);
            document.getElementById('totalfactura2').value = total.toFixed(2);
        }

        // Asegúrate de que la función actualizarTotal se llama cuando se cargan los inputs dinámicos
        document.addEventListener('DOMContentLoaded', actualizarTotal);
    </script>

<script>
  $("#btnVaciarListado").click(function() {
    console.log("Click en el botón");
    $("#tablaAgregarArticulos tbody").empty();
    actualizarImporte($('#tablaAgregarArticulos tbody tr:last-child'));
    calcularIVA();
    actualizarSuma();
    mostrarTotalVenta();

  });


  function actualizarEfectivoEntregado() {
  var inputEfectivo = document.getElementById("iptEfectivoRecibido");
  var spanEfectivoEntregado = document.getElementById("EfectivoEntregado");
  var inputEfectivoOculto = document.getElementById("iptEfectivoOculto");

  spanEfectivoEntregado.innerText = inputEfectivo.value;
  inputEfectivoOculto.value = inputEfectivo.value;
}

</script>




<script>
  table = $('#tablaAgregarArticulos').DataTable({
    searching: false, // Deshabilitar la funcionalidad de búsqueda
    paging: false, // Deshabilitar el paginador
    "columns": [{
        "data": "id"
      },
      {
        "data": "codigo"
      },
      {
        "data": "descripcion"
      },
      {
        "data": "cantidad"
      },
      {
        "data": "stockactual"
      },{
        "data": "diferencia"
      },
      {
        "data": "precio"
      },
      {
        "data": "tipodeajuste"
      },
      {
        "data": "anaquel"
      },
      {
        "data": "repisa"
      },
      // {
      //     "data": "importesiniva"
      // },
      // {
      //     "data": "ivatotal"
      // },
      // {
      //     "data": "ieps"
      // },
      {
        "data": "eliminar"
      },
     
    ],

    "order": [
      [0, 'desc']

    ],
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    },
    //para usar los botones   
    responsive: "false",

  });

  function mostrarTotalVenta() {
    var totalVenta = 0;
    $('#tablaAgregarArticulos tbody tr').each(function() {
        var importe = parseFloat($(this).find('.importe').val().replace(/[^\d.-]/g, ''));
        if (!isNaN(importe)) {
            totalVenta += importe;
        }
    });

 
    $('#totalVenta').text(totalVenta.toFixed(2));
    $('#boleta_total').text(totalVenta.toFixed(2));
    $("#totaldeventacliente").val(totalVenta.toFixed(2));
    
}



var Fk_sucursal = <?php echo json_encode($row['Fk_Sucursal']); ?>;
var scanBuffer = "";
var scanInterval = 5; // Milisegundos

function procesarBuffer() {
  // Buscar el carácter delimitador
  var delimiter = "\n";
  var delimiterIndex = scanBuffer.indexOf(delimiter);

  while (delimiterIndex !== -1) {
    // Extraer el código hasta el delimitador
    var codigoEscaneado = scanBuffer.slice(0, delimiterIndex);
    scanBuffer = scanBuffer.slice(delimiterIndex + 1);

    if (esCodigoBarrasValido(codigoEscaneado)) {
      buscarArticulo(codigoEscaneado);
    } else {
      console.warn('Código de barras inválido:', codigoEscaneado);
    }

    // Buscar el siguiente delimitador
    delimiterIndex = scanBuffer.indexOf(delimiter);
  }
}

function agregarEscaneo(escaneo) {
  scanBuffer += escaneo;
}

function esCodigoBarrasValido(codigoEscaneado) {
  // Verificar si el código de barras tiene una longitud válida
  var longitud = codigoEscaneado.length;
  return longitud >= 2 && longitud <= 13; // Ajusta el rango según sea necesario
}

function buscarArticulo(codigoEscaneado) {
  if (!codigoEscaneado.trim()) return; // No hacer nada si el código está vacío

  $.ajax({
    url: "Consultas/escaner_articulo.php",
    type: 'POST',
    data: { codigoEscaneado: codigoEscaneado },
    dataType: 'json',
    success: function (data) {
      if (data && data.codigo) {
        agregarArticulo(data);
        calcularDiferencia($('#tablaAgregarArticulos tbody tr:last-child'));
      }
      limpiarCampo();
    },
    error: function (data) {
      console.error('Error en la solicitud AJAX', data);
    }
  });
}

 
function limpiarCampo() {
  $('#codigoEscaneado').val('');
  $('#codigoEscaneado').focus();
}

var isScannerInput = false;

$('#codigoEscaneado').keyup(function (event) {
  if (event.which === 13) { // Verificar si la tecla presionada es "Enter"
    if (!isScannerInput) { // Verificar si el evento no viene del escáner
      var codigoEscaneado = $('#codigoEscaneado').val();
      agregarEscaneo(codigoEscaneado + '\n'); // Agregar el código escaneado al buffer de escaneo con un delimitador
      event.preventDefault(); // Evitar que el formulario se envíe al presionar "Enter"
    }
    isScannerInput = false; // Restablecer la bandera del escáner
  }
});

// Configurar un intervalo para procesar el buffer de escaneo a intervalos regulares
setInterval(procesarBuffer, scanInterval);
// Agrega el autocompletado al campo de búsqueda
$('#codigoEscaneado').autocomplete({
  source: function (request, response) {
    // Realiza una solicitud AJAX para obtener los resultados de autocompletado
    $.ajax({
      url: 'Consultas/autocompletado.php',
      type: 'GET',
      dataType: 'json',
      data: {
        term: request.term
      },
      success: function (data) {
        response(data);
      }
    });
  },
  minLength: 3, // Especifica la cantidad mínima de caracteres para activar el autocompletado
  select: function (event, ui) {
    // Cuando se selecciona un resultado del autocompletado, llamar a la función buscarArticulo() con el código seleccionado
    var codigoEscaneado = ui.item.value;
    isScannerInput = true; // Establece la bandera del escáner
    $('#codigoEscaneado').val(codigoEscaneado);
    buscarArticulo(codigoEscaneado);
  }
});
  

// Agregar evento change al input de cantidad vendida
$(document).on('change', '.cantidad-vendida-input', function() {
    // Obtener la fila actual
    var fila = $(this).closest('tr');
    
    // Obtener el valor del input de cantidad vendida
    var cantidadVendida = parseInt($(this).val());
    
    // Obtener el valor del input de existencias en la base de datos
    var existenciasBd = parseInt(fila.find('.cantidad-existencias-input').val());
    
    // Calcular la diferencia
    var diferencia = cantidadVendida + existenciasBd;
    
    // Actualizar el valor del input de diferencia
    fila.find('.cantidad-diferencia-input').val(diferencia);
});
// Función para calcular la diferencia entre la cantidad vendida y las existencias en la base de datos
function calcularDiferencia(input) {
    var fila = $(input).closest('tr');  // Convierte el input a jQuery y luego busca el tr más cercano
    var cantidadVendida = parseInt(fila.find('.cantidad-vendida-input').val());
    var existenciasBd = parseInt(fila.find('.cantidad-existencias-input').val());

    // Calcular la diferencia
    var diferencia = cantidadVendida + existenciasBd;

    // Actualizar el valor del input de diferencia en la fila actual
    fila.find('.cantidad-diferencia-input').val(diferencia);

    // Llama a actualizarTotal para recalcular el total de la factura
    actualizarTotal();
}


  var tablaArticulos = ''; // Variable para almacenar el contenido de la tabla



  // Variable para almacenar el total del IVA
  var totalIVA = 0;

  function agregarArticulo(articulo) {
  if (!articulo || !articulo.id) {
    mostrarMensaje('El artículo no es válido');
    return;
  }

  let row = $('#tablaAgregarArticulos tbody').find('tr[data-id="' + articulo.id + '"]');
  if (row.length) {
    let cantidadActual = parseInt(row.find('.cantidad input').val());
    let nuevaCantidad = cantidadActual + parseInt(articulo.cantidad);
    if (nuevaCantidad < 0) {
      mostrarMensaje('La cantidad no puede ser negativa');
      return;
    }
    row.find('.cantidad input').val(nuevaCantidad);
    mostrarToast('Cantidad actualizada para el producto: ' + articulo.descripcion);
    actualizarImporte(row);
    calcularDiferencia(row);
    calcularIVA();
    actualizarSuma();
    mostrarTotalVenta();
  } else {
    let tr = `
      <tr data-id="${articulo.id}">
        <td class="codigo"><input class="form-control codigo-barras-input" readonly style="font-size: 0.75rem !important;" type="text" value="${articulo.codigo}" name="CodBarras[]" /></td>
        <td class="descripcion"><textarea class="form-control descripcion-producto-input" readonly style="font-size: 0.75rem !important;" name="NombreDelProducto[]">${articulo.descripcion}</textarea></td>
        <td class="cantidad"><input class="form-control cantidad-vendida-input" style="font-size: 0.75rem !important;" type="number" name="Contabilizado[]" value="${articulo.cantidad}" onchange="calcularDiferencia(this)" /></td>
        <td class="ExistenciasEnBd"><input class="form-control cantidad-existencias-input" readonly style="font-size: 0.75rem !important;" type="number" name="StockActual[]" value="${articulo.existencia}" /></td>
        <td class="Diferenciaresultante"><input class="form-control cantidad-diferencia-input" style="font-size: 0.75rem !important;" readonly type="number" name="Diferencia[]" /></td>
        <td class="preciofijo"><input class="form-control preciou-input" readonly style="font-size: 0.75rem !important;" type="number" name="preciocompraAguardar[]" value="${articulo.preciocompra}" /></td>
        tr += '<td  class="factura"><input class="form-control factura-input" style="font-size: 0.75rem !important;" id="facturanumber" readonly type="text" name="FacturaNumber[]" /></td>';
        <td style="display:none;"><input id="importe_${articulo.id}" class="form-control importe" name="ImporteGenerado[]" style="font-size: 0.75rem !important;" type="number" readonly /></td>
        <td style="display:none;" class="idbd"><input class="form-control" style="font-size: 0.75rem !important;" type="text" value="${articulo.id}" name="IdBasedatos[]" /></td>
        <td style="display:none;" class="ResponsableInventario"><input hidden id="VendedorFarma" type="text" class="form-control" name="AgregoElVendedor[]" readonly value="<?php echo $row['Nombre_Apellidos']; ?>" /></td>
        <td style="display:none;" class="Sucursal"><input hidden type="text" class="form-control" name="Fk_sucursal[]" readonly value="<?php echo $row['Fk_Sucursal']; ?>" /></td>
        <td style="display:none;" class="Empresa"><input hidden type="text" class="form-control" name="Sistema[]" readonly value="POS" /></td>
        <td style="display:none;" class="Empresa"><input hidden type="text" class="form-control" name="TipoMov[]" readonly value="Actualizacion por ingreso" /></td>
        <td style="display:none;" class="Empresa"><input hidden type="text" class="form-control" name="ID_H_O_D[]" readonly value="Saluda" /></td>
                <td style="display:none;" class="Empresa"><input hidden type="text" class="form-control" name="Loteeee[]" readonly  /></td>
                        <td style="display:none;" class="Empresa"><input hidden type="text" class="form-control" name="fechacadd[]" readonly value="Saluda" /></td>
        <td style="display:none;" class="Fecha"><input hidden type="text" class="form-control" name="FechaInv[]" readonly value="<?php echo $fechaActual; ?>" /></td>
        <td><div class="btn-container"><button type="button" class="btn btn-danger btn-sm" onclick="eliminarFila(this);"><i class="fas fa-minus-circle fa-xs"></i></button></div></td>
      </tr>`;

    $('#tablaAgregarArticulos tbody').prepend(tr);
    let newRow = $('#tablaAgregarArticulos tbody tr:first-child');
    $('#tablaAgregarArticulos tbody tr:first-child').find('.factura-input').val(selectedfactura);
    actualizarImporte(newRow);
    calcularDiferencia(newRow);
    calcularIVA();
    actualizarSuma();
    mostrarTotalVenta();
  }

  limpiarCampo();
  $('#codigoEscaneado').focus();
}

  






  function mostrarToast(mensaje) {
  var toast = $('<div class="toast"></div>').text(mensaje);
  $('body').append(toast);
  toast.fadeIn(400).delay(3000).fadeOut(400, function() {
    $(this).remove();
  });
}
  function actualizarImporte(row) {
  var cantidad = parseInt(row.find('.cantidad-vendida-input').val());
  var precio = parseFloat(row.find('.precio input').val());

  

  if (cantidad < 0) {
    mostrarMensaje('La cantidad no puede ser negativa');
    return;
  }

  if (precio < 0) {
    mostrarMensaje('El precio no puede ser negativo');
    return;
  }

  var importe = cantidad * precio;
  var iva = importe / 1.16 * 0.16;
  var importeSinIVA = importe - iva;
  var ieps = importe * 0.08;

  row.find('input.importe').val(importe.toFixed(2));
  row.find('input.importe_siniva').val(importeSinIVA.toFixed(2));
  row.find('input.valordelniva').val(iva.toFixed(2));
  row.find('input.ieps').val(ieps.toFixed(2));

  // Llamar a la función para recalcular la suma de importes
  actualizarSuma();
  mostrarTotalVenta();


}



  // Función para calcular el IVA
  function calcularIVA() {
    totalIVA = 0;

    $('#tablaAgregarArticulos tbody tr').each(function() {
      var iva = parseFloat($(this).find('.valordelniva input').val());
      totalIVA += iva;
    });

    $('#totalIVA').text(totalIVA.toFixed(2));
  }

  
  // Función para mostrar un mensaje
  function mostrarMensaje(mensaje) {
    // Mostrar el mensaje en una ventana emergente de alerta
    alert(mensaje);
  }
// Modificar la función eliminarFila() para llamar a las funciones necesarias después de eliminar la fila
function eliminarFila(element) {
  var fila = $(element).closest('tr'); // Obtener la fila más cercana al elemento
  fila.remove(); // Eliminar la fila

  // Llamar a las funciones necesarias después de eliminar la fila
  calcularIVA();
  actualizarSuma();
  mostrarTotalVenta();
 

}


</script>




<script>
            document.addEventListener("DOMContentLoaded", function(){
                // Invocamos cada 5 segundos ;)
                const milisegundos = 600 *1000;
                setInterval(function(){
                    // No esperamos la respuesta de la petición porque no nos importa
                    fetch("./Refrescacontenido.php");
                },milisegundos);
            });
        </script>


<script>
  $(document).on('keydown', '.cantidad-vendida-input', function(event) {
    // Si la tecla presionada es "Enter", bloquear la acción
    if (event.key === "Enter") {
        event.preventDefault();
    }
});

</script>
<style>
.toast {
  position: fixed;
  bottom: 10px;
  right: 10px;
  background-color: #333;
  color: #fff;
  padding: 10px 20px;
  border-radius: 5px;
  opacity: 0.9;
  z-index: 1000;
  display: none;
}
</style>
<!-- Control Sidebar -->

<!-- Main Footer -->
<?php

include("Modales/Error.php");
include ("Modales/FiltraEspecificamenteInventarios.php");
include("footer.php") ?>


  <!-- ./wrapper -->


  <script src="js/RealizaCambioDeSucursalPorFiltro.js"></script>
  <script src="js/RegistraIngresoDeMedicamentos.js"></script>
  <!-- Bootstrap -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>

  <!-- OPTIONAL SCRIPTS -->
  <script src="dist/js/demo.js"></script>

  <!-- PAGE PLUGINS -->

  </body>

</html>


<?php

function fechaCastellano($fecha)
{
  $fecha = substr($fecha, 0, 10);
  $numeroDia = date('d', strtotime($fecha));
  $dia = date('l', strtotime($fecha));
  $mes = date('F', strtotime($fecha));
  $anio = date('Y', strtotime($fecha));
  $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
  $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
  $nombredia = str_replace($dias_EN, $dias_ES, $dia);
  $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
  $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
  $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
  return $nombredia . " " . $numeroDia . " de " . $nombreMes . " de " . $anio;
}
?>
<script>




</script>

