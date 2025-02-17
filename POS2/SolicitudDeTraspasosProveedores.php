<?php
include_once "Consultas/Consultas.php";
$fechaActual = date('Y-m-d'); // Esto obtiene la fecha actual en el formato 'Año-Mes-Día'$fecha
$sql = "SELECT * FROM Solicitudes_Ingresos ORDER BY IdProdCedis DESC LIMIT 1";
$resultset = mysqli_query($conn, $sql);

if (!$resultset) {
    die("database error: " . mysqli_error($conn));
}

$Ticketss = mysqli_fetch_assoc($resultset);



$monto1 = isset($Ticketss['NumOrden']) ? $Ticketss['NumOrden'] : 0;
$monto2 = 1;
$totalmonto = $monto1 + $monto2;

  

  
  




?><!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Solicitud de traspasos</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
   

    <?php
   include "Header.php";?>
  

   <div id="loading-overlay">
  <div class="loader"></div>
  <div id="loading-text" style="color: white; margin-top: 10px; font-size: 18px;"></div>
</div>
<body>
<style>        .loader-container {
            text-align: center; /* Centrar el contenido */
        }
        .loaderPill-text {
            margin-top: 10px; /* Añadir espacio entre la imagen y el texto */
            color: #C80096;
        }
    </style>
    </style>
        <!-- Spinner End -->
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
  <style>
  /* Personalizar el diseño de la paginación con CSS */
  .dataTables_wrapper .dataTables_paginate {
    text-align: center !important; /* Centrar los botones de paginación */
    margin-top: 10px !important;
  }

  .dataTables_paginate .paginate_button {
    padding: 5px 10px !important;
    border: 1px solid #ef7980 !important;
    margin: 2px !important;
    cursor: pointer !important;
    font-size: 16px !important;
    color: #ef7980 !important;
    background-color: #fff !important;
  }

  /* Cambiar el color del paginado seleccionado */
  .dataTables_paginate .paginate_button.current {
    background-color: #ef7980 !important;
    color: #fff !important;
    border-color: #ef7980 !important;
  }

  /* Cambiar el color del hover */
  .dataTables_paginate .paginate_button:hover {
    background-color: #C80096 !important;
    color: #fff !important;
    border-color: #C80096 !important;
  }
</style>

<style>
  /* Estilos personalizados para la tabla */
  #tablaAgregarArticulos th {
    font-size: 12px; /* Tamaño de letra para los encabezados */
    padding: 4px; /* Ajustar el espaciado entre los encabezados */
    white-space: nowrap; /* Evitar que los encabezados se dividan en varias líneas */
  }
</style>

<style>
  /* Estilos para la tabla */
  #tablaAgregarArticulos {
    font-size: 12px; /* Tamaño de letra para el contenido de la tabla */
    border-collapse: collapse; /* Colapsar los bordes de las celdas */
    width: 100%;
    text-align: center; /* Centrar el contenido de las celdas */
  }

  #tablaAgregarArticulos th {
    font-size: 16px; /* Tamaño de letra para los encabezados de la tabla */
    background-color: #e83e8c !important; /* Nuevo color de fondo para los encabezados */
    color: white; /* Cambiar el color del texto a blanco para contrastar */
    padding: 10px; /* Ajustar el espaciado de los encabezados */
  }

  #tablaAgregarArticulos td {
    font-size: 14px; /* Tamaño de letra para el contenido de la tabla */
    padding: 8px; /* Ajustar el espaciado de las celdas */
    border-bottom: 1px solid #ccc; /* Agregar una línea de separación entre las filas */
    color:#000000;
  }

  /* Estilos para el botón de Excel */
  .dt-buttons {
    display: flex;
    justify-content: center;
    margin-bottom: 10px;
  }

  .dt-buttons button {
    font-size: 14px;
    margin: 0 5px;
    color: white; /* Cambiar el color del texto a blanco */
    background-color: #fff; /* Cambiar el color de fondo a blanco */
  }

 
</style>

        <?php include_once "Menu.php" ?>

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
     
            <!-- Navbar End -->


            <!-- Table Start -->
          
            <script>
  // Mensajes de carga aleatorios
  const loadingMessages = [
    'Cargando...',
    'Por favor, espera...',
    'Procesando...',
    'Cargando datos...',
    'Cargando contenido...',
    '¡Casi listo!',
    'Estamos preparando todo...',
  ];

  function getRandomMessage() {
            var mensajesCarga = [
                "Consultando ventas...",
                "Estamos realizando la búsqueda...",
                "Cargando datos...",
                "Procesando la información...",
                "Espere un momento...",
                // more messages...
            ];
            return mensajesCarga[Math.floor(Math.random() * mensajesCarga.length)];
        }
        
// Function to show the instructions message
function showInstructions() {
            Swal.fire({
                title: 'Instrucciones',
                html: `
                    <ol style="text-align: left;">
                    <p>El campo escanear productos esta bloqueado, para desbloquearlo sigue las instrucciones<p/>
                        <li>Selecciona el <b>proveedor</b> del cual solicitas su ingreso</li>
                        <li>Coloca el <b>número de factura</b>.</li>
                        <li>Revisa que todos los datos sean correctos.</li>
                        <li>El campo escanear productos se desbloqueara automaticamente</li>
                        <li>Escanea tu producto, si es un encargo recuerda generar la solicitud de encargo</li>
                        <li>Recuerda llenar los campos fecha de caducidad,lote y precio maximo de venta</li>
                    </ol>
                    <div style="margin-top: 20px;">
                        <label>
                            <input type="checkbox" id="noMostrar"> No volver a mostrar esta información durante una semana
                        </label>
                    </div>
                `,
                icon: 'info',
                confirmButtonText: 'Entendido',
                customClass: {
                    container: 'animated fadeInDown'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    if (document.getElementById('noMostrar').checked) {
                        localStorage.setItem('noMostrarInstrucciones', Date.now());
                    }
                }
            });
        }
        // Mostrar SweetAlert2 de carga al iniciar la página
       
        // Ocultar SweetAlert2 de carga cuando la página se haya cargado por completo
        window.addEventListener('load', function() {
            Swal.close();
           
             // Verificar si debe mostrarse el mensaje de instrucciones
             const noMostrarInstrucciones = localStorage.getItem('noMostrarInstrucciones');
            const unaSemana = 7 * 24 * 60 * 60 * 1000; // Milisegundos en una semana

            if (!noMostrarInstrucciones || (Date.now() - noMostrarInstrucciones) > unaSemana) {
                showInstructions();
            }
            
        });
     
        
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Verificar si el elemento 'proveedoresSelect' existe antes de agregar el event listener
        var selectElement = document.getElementById('proveedoresSelect');
        if (selectElement) {
            selectElement.addEventListener('change', toggleCodigoEscaneado);
        } else {
            console.error('El elemento proveedoresSelect no existe.');
        }

        // Verificar si el elemento 'numerofactura' existe antes de agregar el event listener
        var facturaElement = document.getElementById('numerofactura');
        if (facturaElement) {
            facturaElement.addEventListener('input', toggleCodigoEscaneado);
        } else {
            console.error('El elemento numerofactura no existe.');
        }

        // Llamar a la función para establecer el estado inicial del input
        toggleCodigoEscaneado();
    });

    // Función para deshabilitar o habilitar el input según el valor del select
    function toggleCodigoEscaneado() {
        var selectElement = document.getElementById('proveedoresSelect');
        var inputElement = document.getElementById('codigoEscaneado');
        var facturaElement = document.getElementById('numerofactura');
        if (selectElement && facturaElement && inputElement) {
            if (selectElement.value === "" || facturaElement.value.trim() === "") {
                inputElement.disabled = true;
            } else {
                inputElement.disabled = false;
            }
        }
    }
</script>

<style>
 
 .loader-container {
    
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


<div class="container-fluid">

<div class="row mb-3">



<div class="card-body p-3">
            
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="row">
                  <!-- INPUT PARA INGRESO DEL CODIGO DE BARRAS O DESCRIPCION DEL PRODUCTO -->
                  <div class="col-md-12 mb-3">

                    <div class="form-group mb-2">
                    <!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#FiltroEspecifico" class="btn btn-default">
 Cambiar de sucursal <i class="fas fa-clinic-medical"></i>
</button> -->
                      <div class="row">
                        <input hidden type="text" class="form-control " readonly value="<?php echo $row['Nombre_Apellidos'] ?>">

                        <div class="col">

                          <label for="exampleFormControlInput1" style="font-size: 0.75rem !important;">Proveedor</label>
                          <div class="input-group mb-3">
                            <div class="input-group-prepend"> <span class="input-group-text" id="Tarjeta2"><i class="fas fa-barcode"></i></span>
                            </div>
                            <select id="proveedoresSelect" class="form-control" style="font-size: 0.75rem !important;">
            <option value="">Proveedor</option>
        </select>
                
                           
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

<label for="exampleFormControlInput1" style="font-size: 0.75rem !important;"># de solicitud
</label>
<div class="input-group mb-3">
  <div class="input-group-prepend"> <span class="input-group-text" id="Tarjeta2"><i class="fas fa-barcode"></i></span>
  </div>
  <input type="text" class="form-control " style="font-size: 0.75rem !important;" readonly value="<?php echo  $totalmonto?>">
 
</div>
</div>            


                      </div>

                      <label class="col-form-label" for="iptCodigoVenta">
                        <i class="fas fa-barcode fs-6"></i>
                        <span class="small">Escanear productos</span>
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
                  <div class="table-responsive">
                    <div class="col-md-12">
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
                      </style>
                      <form action="javascript:void(0)"  method="post" id="SolicitaTraspasosPOs">
                      <div class="text-center">
        <button type="submit" class="btn btn-primary">Enviar Información</button>
    </div>
                        <table class="table table-striped" id="tablaAgregarArticulos" class="display">
                          <thead>
                            <tr>
                              <th>Codigo</th>
                              <th style="width:20%">Producto</th>
                              <th style="width:6%">Piezas</th>
                              <th >Fecha caducidad</th>
                              <th >Lote</th>
                              <th>Precio Maximo</th>
                              
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

  
  function actualizarSumaTotal() {
  var iptTarjeta = parseFloat(document.getElementById("iptTarjeta").value);
  var iptEfectivo = parseFloat(document.getElementById("iptEfectivoRecibido").value);
  var cambio;

  if (iptTarjeta > 0) {
    cambio = 0; // Si se ingresa un valor en el campo de tarjeta, el cambio se establece en cero
  } else {
    cambio = iptEfectivo; // Si no se ingresa un valor en el campo de tarjeta, el cambio se calcula como el efectivo recibido
  }

  // Actualizar el valor del elemento <span> con el cambio
  document.getElementById("Vuelto").textContent = cambio.toFixed(2);
}








</script>

<script>
  $(document).ready(function() {
    // Bloquear el botón al cargar la página
    $('#btnIniciarVenta').prop('disabled', true);

    // Agregar un controlador de eventos al input
    $('#iptEfectivoRecibido').on('input', function() {
      var valorInput = $(this).val();
      var miBoton = $('#btnIniciarVenta');

      if (valorInput.length > 0) {
        // Desbloquear el botón si el input contiene datos
        miBoton.prop('disabled', false);
      } else {
        // Bloquear el botón si el input está vacío
        miBoton.prop('disabled', true);
      }
    });
  });


  $(document).ready(function() {
    $("#chkEfectivoExacto").change(function() {
      if ($(this).is(":checked")) {
        var boletaTotal = parseFloat($("#boleta_total").text());
        $("#Vuelto").text("0.00");
        $("#iptEfectivoRecibido").val(boletaTotal.toFixed(2));
      }
    });

    $("#iptEfectivoRecibido").change(function() {
      var boletaTotal = parseFloat($("#boleta_total").text());
      var efectivoRecibido = parseFloat($(this).val());

      if ($("#chkEfectivoExacto").is(":checked") && boletaTotal >= efectivoRecibido) {
        $("#Vuelto").text("0.00");
        $("#boleta_total").text(efectivoRecibido.toFixed(2));
      } else {
        var vuelto = efectivoRecibido - boletaTotal;
        $("#Vuelto").text(vuelto.toFixed(2));
        $("#cambiorecibidocliente").val(vuelto.toFixed(2));
        
      }
    });
  });
</script>

<script>
  $("#btnVaciarListado").click(function() {
    console.log("Click en el botón");
    $("#tablaAgregarArticulos tbody").empty();
    actualizarImporte($('#tablaAgregarArticulos tbody tr:last-child'));
    calcularIVA();
    actualizarSuma();
    mostrarTotalVenta();
    mostrarSubTotal();
    mostrarIvaTotal()
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
       let selectedAdjustment = "";

document.getElementById('proveedoresSelect').addEventListener('change', function() {
    selectedAdjustment = this.value;
});

    </script>


<script>
       let selectedfactura = "";

document.getElementById('numerofactura').addEventListener('change', function() {
  selectedfactura = this.value;
});

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
      {
        "data": "descuentos"

      },
      {
        "data": "descuentos2"
      },
    ],

    "order": [
      [0, 'desc']

    ],
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    },
    //para usar los botones   
    responsive: "true",

  });

 // Función que realiza la búsqueda vía AJAX (original modificada)
function buscarArticulo(codigoEscaneado) {
  var formData = new FormData();
  formData.append('codigoEscaneado', codigoEscaneado);

  $.ajax({
    url: "Consultas/BusquedaPorEscanerTraspasos.php",
    type: 'POST',
    data: formData,
    processData: false,
    contentType: false,
    dataType: 'json',
    success: function (data) {
      if (data.length === 0) {
        msjError('No Encontrado');
      } else if (data.codigo) {
        // Verificar si la respuesta incluye múltiples lotes
        if (data.lotes && data.lotes.length > 0) {
          data.lotes = data.lotes.filter(lote => lote.cantidad > 0); // Filtrar lotes con existencia
          if (data.lotes.length === 0) {
            msjError('No hay existencias disponibles');
            return;
          }
        }
        agregarArticulo(data);
      }
      limpiarCampo();
    },
    error: function (data) {
      msjError('Error en la búsqueda');
    }
  });
}

// Función mejorada para agregar/actualizar artículos
function agregarArticulo(articulo) {
  if (!articulo?.id) {
    mostrarMensaje('Artículo inválido');
    return;
  }

  // Manejo de múltiples lotes
  if (articulo.lotes?.length > 1) {
    mostrarModalLotes(articulo);
    return;
  }

  // Asignación directa si hay un solo lote
  if (articulo.lotes?.length === 1) {
    Object.assign(articulo, {
      lote: articulo.lotes[0].lote,
      fechacaducidad: articulo.lotes[0].fecha_caducidad,
      stockDisponible: articulo.lotes[0].cantidad
    });
    delete articulo.lotes;
  }

  // Buscar existencia del mismo artículo + lote + fecha
  const existe = $(`#tablaAgregarArticulos tr[data-id="${articulo.id}"][data-lote="${articulo.lote}"][data-fecha="${articulo.fechacaducidad}"]`);

  if (existe.length) {
    const inputCantidad = existe.find('.cantidad-vendida-input');
    const nuevaCantidad = parseInt(inputCantidad.val()) + 1;
    inputCantidad.val(nuevaCantidad);
    inputCantidad.trigger('change');
    mostrarMensaje('Cantidad actualizada', 'success');
  } else {
    agregarFilaArticulo(articulo);
  }
  limpiarCampo();
}

// Modal de selección de lotes (nueva implementación)
function mostrarModalLotes(articulo) {
  let html = `<div class="table-responsive">
                <table class="table table-hover table-sm">
                  <thead class="bg-light">
                    <tr>
                      <th></th>
                      <th>Lote</th>
                      <th>Caducidad</th>
                      <th>Disponible</th>
                    </tr>
                  </thead>
                  <tbody>`;

  articulo.lotes.forEach(lote => {
    html += `<tr class="lote-row cursor-pointer" 
                 data-lote="${lote.lote}"
                 data-fcad="${lote.fecha_caducidad}"
                 data-cant="${lote.cantidad}">
               <td><input type="radio" name="selectedLote" class="form-check-input"></td>
               <td>${lote.lote}</td>
               <td>${lote.fecha_caducidad}</td>
               <td>${lote.cantidad}</td>
             </tr>`;
  });

  html += `</tbody></table></div>`;

  Swal.fire({
    title: 'Seleccione un Lote',
    html: html,
    width: '60%',
    showCancelButton: true,
    confirmButtonText: 'Seleccionar',
    customClass: {
      confirmButton: 'btn btn-primary',
      cancelButton: 'btn btn-secondary'
    },
    didOpen: () => {
      $('.lote-row').click(function() {
        $(this).find('input[type="radio"]').prop('checked', true);
        $('.lote-row').removeClass('table-primary');
        $(this).addClass('table-primary');
      });
    },
    preConfirm: () => {
      const selected = $('input[name="selectedLote"]:checked').closest('.lote-row');
      if (!selected.length) {
        Swal.showValidationMessage('Seleccione un lote');
        return;
      }
      return {
        lote: selected.data('lote'),
        fechacaducidad: selected.data('fcad'),
        stockDisponible: selected.data('cant')
      };
    }
  }).then((result) => {
    if (result.isConfirmed) {
      articulo.lote = result.value.lote;
      articulo.fechacaducidad = result.value.fechacaducidad;
      articulo.stockDisponible = result.value.stockDisponible;
      agregarArticulo(articulo);
    }
  });
}

// Función para agregar filas (modificada)
function agregarFilaArticulo(articulo) {
  const tr = $(`
    <tr data-id="${articulo.id}" data-lote="${articulo.lote}" data-fecha="${articulo.fechacaducidad}">
      <td class="codigo">
        <input class="form-control form-control-sm codigo-barras-input" 
               value="${articulo.codigo}" 
               name="CodBarras[]" readonly>
      </td>
      <td class="descripcion">
        <textarea class="form-control form-control-sm" 
                  name="NombreDelProducto[]" 
                  readonly>${articulo.descripcion}</textarea>
      </td>
      <td class="cantidad">
        <input class="form-control form-control-sm cantidad-vendida-input" 
               type="number" 
               value="1" 
               min="1" 
               max="${articulo.stockDisponible}"
               name="Contabilizado[]">
      </td>
      <td class="ExistenciasEnBd">
        <input class="form-control form-control-sm" 
               type="date" 
               value="${articulo.fechacaducidad}" 
               name="FechaCaducidad[]" 
               readonly>
      </td>
      <td class="Diferenciaresultante">
        <input class="form-control form-control-sm" 
               type="text" 
               value="${articulo.lote}" 
               name="Lote[]" 
               readonly>
      </td>
      <td>
        <button class="btn btn-danger btn-sm" 
                onclick="eliminarFila(this)">
          <i class="fas fa-minus-circle"></i>
        </button>
      </td>
      <!-- Campos ocultos adicionales -->
      ${generarCamposOcultos(articulo)}
    </tr>
  `);

  $('#tablaAgregarArticulos tbody').append(tr);
  actualizarTotales();
}

// Función auxiliar para campos ocultos
function generarCamposOcultos(articulo) {
  return `
    <td style="display:none;">
      <input type="hidden" name="IdBasedatos[]" value="${articulo.id}">
      <input type="hidden" class="preciocompra-input" name="PrecioCompra[]" value="${articulo.preciocompra}">
      <input type="hidden" class="preciou-input" name="PrecioVenta[]" value="${articulo.precio}">
    </td>`;
}

// Función para limpiar y enfocar el campo de búsqueda (original)
function limpiarCampo() {
  $('#codigoEscaneado').val('').focus();
}

// Eventos y configuraciones iniciales (originales modificadas)
$(document).ready(function() {
  // Autocompletado
  $('#codigoEscaneado').autocomplete({
    source: 'Consultas/DespliegaAutoCompleteTraspasos.php',
    minLength: 2,
    select: function(event, ui) {
      buscarArticulo(ui.item.value);
    }
  });

  // Detección de Enter
  $('#codigoEscaneado').keypress(function(e) {
    if (e.which === 13) {
      buscarArticulo($(this).val());
      return false;
    }
  });
});

// Función de utilidad para mensajes
function mostrarMensaje(titulo, texto, icono = 'success') {
  Swal.fire({ title: titulo, text: texto, icon: icono });
}

function actualizarTotales() {
    let total = 0;
    
    $('#tablaAgregarArticulos tbody tr').each(function() {
        const precio = parseFloat($(this).find('.preciou-input').val()) || 0;
        const cantidad = parseInt($(this).find('.cantidad-vendida-input').val()) || 0;
        total += precio * cantidad;
    });
    
    $('#totalGeneral').text(total.toFixed(2));
}
</script>

<script src="js/CompletaSolicitudTraspaso.js"></script>

<script src="js/ConectaProveedores.js"></script>
<!-- Control Sidebar -->
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="dist/js/demo.js"></script>
<?php

include("Modales/Error.php");
include("Modales/Exito.php");
            
include "footer.php";?>


  

  <!-- Bootstrap -->


  <!-- PAGE PLUGINS -->

 

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


           
</body>

</html>