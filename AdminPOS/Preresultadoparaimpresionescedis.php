<?php
include "Consultas/Consultas.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Prueba de impresiones <?php echo $row['ID_H_O_D'] ?> </title>

  <?php include "Header.php"?>
  <style>
    .error {
      color: red;
      margin-left: 5px;

    }
  </style>
</head>
<div id="loading-overlay">
  <div class="loader"></div>
  <div id="loading-text" style="color: white; margin-top: 10px; font-size: 18px;"></div>
</div>
<?php include_once ("Menu.php")?>

<div class="card text-center">
  <div class="card-header" style="background-color:#0057b8 !important;color: white;">
    Traspasos realizados
    <?php echo $row['ID_H_O_D']?> al <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?>
  </div>

  <div>
   
  </div>
</div>

<?php
// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Depurar el contenido de $_POST para verificar los datos recibidos
   

    // Verificar si las variables están seteadas y no son nulas
    if (isset($_POST['Factura'])) {
        // Obtener los valores del formulario
        $factura = $_POST['Factura'];

        // Realizar las operaciones que necesites con estas variables
        // Por ejemplo, imprimir su valor
        echo "Factura seleccionada: $factura<br>";
    } else {
        // Si alguna de las variables no está seteada o es nula, mostrar un mensaje de error
        echo "Error: No se recibieron todas las variables necesarias.";
    }
}
?>

<style>
  /* Personalizar el diseño de la paginación con CSS */
  .dataTables_wrapper .dataTables_paginate {
    text-align: center !important;
    margin-top: 10px !important;
  }
  .dataTables_paginate .paginate_button {
    padding: 5px 10px !important;
    border: 1px solid #007bff !important;
    margin: 2px !important;
    cursor: pointer !important;
    font-size: 16px !important;
    color: #007bff !important;
    background-color: #fff !important;
  }
  .dataTables_paginate .paginate_button.current {
    background-color: #007bff !important;
    color: #fff !important;
    border-color: #007bff !important;
  }
  .dataTables_paginate .paginate_button:hover {
    background-color: #C80096 !important;
    color: #fff !important;
    border-color: #C80096 !important;
  }
</style>

<style>
  /* Estilos personalizados para la tabla */
  #Productos th {
    font-size: 12px;
    padding: 4px;
    white-space: nowrap;
  }
</style>

<style>
  /* Estilos para la tabla */
  #Productos {
    font-size: 12px;
    border-collapse: collapse;
    width: 100%;
    text-align: center;
  }
  #Productos th {
    font-size: 16px;
    background-color: #0057b8 !important;
    color: white;
    padding: 10px;
  }
  #Productos td {
    font-size: 14px;
    padding: 8px;
    border-bottom: 1px solid #ccc;
  }
  .dt-buttons {
    display: flex;
    justify-content: center;
    margin-bottom: 10px;
  }
  .dt-buttons button {
    font-size: 14px;
    margin: 0 5px;
    color: white;
    background-color: #fff;
  }
</style>

<style>
  #loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
    display: none;
  }
  .loader {
    border: 6px solid #f3f3f3;
    border-top: 6px solid #C80096;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    animation: spin 1s linear infinite;
  }
  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }
</style>
<script type="text/javascript">
    var factura = "<?php echo $factura; ?>";
</script>

<script>
  var mensajesCarga = [
    "Consultando ventas...",
    "Estamos realizando la búsqueda...",
    "Cargando datos...",
    "Procesando la información...",
    "Espere un momento...",
    "Cargando... ten paciencia, incluso los planetas tardaron millones de años en formarse.",
    "¡Espera un momento! Estamos contando hasta el infinito... otra vez.",
    "¿Sabías que los pingüinos también tienen que esperar mientras cargan su comida?",
    "¡Zapateando cucarachas de carga! ¿Quién necesita un exterminador?",
    "Cargando... ¿quieres un chiste para hacer más amena la espera? ¿Por qué los pájaros no usan Facebook? Porque ya tienen Twitter.",
    "¡Alerta! Un koala está jugando con los cables de carga. Espera un momento mientras lo persuadimos.",
    "¿Sabías que las tortugas cargan a una velocidad épica? Bueno, estamos intentando superarlas.",
    "¡Espera un instante! Estamos pidiendo ayuda a los unicornios para acelerar el proceso.",
    "Cargando... mientras nuestros programadores disfrutan de una buena taza de café.",
    "Cargando... No estamos seguros de cómo llegamos aquí, pero estamos trabajando en ello.",
    "Estamos contando en binario... 10%, 20%, 110%... espero que esto no sea un error de desbordamiento.",
    "Cargando... mientras cazamos pokémons para acelerar el proceso.",
    "Error 404: Mensaje gracioso no encontrado. Estamos trabajando en ello.",
    "Cargando... ¿Sabías que los programadores también tienen emociones? Bueno, nosotros tampoco.",
    "Estamos buscando la respuesta a la vida, el universo y todo mientras cargamos... Pista: es un número entre 41 y 43.",
    "Cargando... mientras los gatos toman el control. ¡Meowtrix está en marcha!",
    "Estamos ajustando tu espera a la velocidad de la luz. Aún no es suficientemente rápida, pero pronto llegaremos.",
    "Cargando... Ten paciencia, incluso los programadores necesitan tiempo para pensar en nombres de variables.",
    "Estamos destilando líneas de código para obtener la solución perfecta. ¡Casi listo!",
  ];

  function mostrarCargando(event, settings) {
    var randomIndex = Math.floor(Math.random() * mensajesCarga.length);
    var mensaje = mensajesCarga[randomIndex];
    document.getElementById('loading-text').innerText = mensaje;
    document.getElementById('loading-overlay').style.display = 'flex';
  }

  function ocultarCargando() {
    document.getElementById('loading-overlay').style.display = 'none';
  }

  var tabla;
$(document).ready(function() {
    tabla = $('#Productos').DataTable({
        "processing": true,
        "ordering": false, // Desactiva la capacidad de ordenar columnas
        "stateSave": true,
        "autoWidth": true,
        "order": [[ 0, "desc" ]],
        "paging": false, // Desactiva la paginación
        "info": false, // Oculta la información del número de registros
        "lengthChange": false, // Oculta la opción de cambiar el número de registros mostrados
        "ajax": {
            "type": "POST",
            "url": "https://saludapos.com/AdminPOS/Consultas/ArrayDesgloseFactura.php",
            "data": function (d) {
                var factura = '<?php echo $factura; ?>';
                var dataToSend = {
                    "Factura": factura,
                };
                return dataToSend;
            },
            "dataSrc": function (json) {
                // Actualiza la información adicional en los divs correspondientes
                if (json.additionalInfo) {
                    $('#providerInfo').text('Proveedor: ' + json.additionalInfo.provider);
                    $('#destinationBranch').text('Sucursal: ' + json.additionalInfo.destinationBranch);
                    $('#invoiceNumber').text('Factura: ' + json.additionalInfo.invoiceNumber);
                    $('#transferDate').text('Fecha del Traspaso: ' + json.additionalInfo.transferDate);
                }

                // Retorna los datos para la DataTable
                return json.aaData;
            },
            "error": function(xhr, error, code) {
                console.log(xhr);
            }
        },
        "columns": [
            // { "data": "IDTraspasoGenerado" },
            { "data": "Cod_Barra" },
            { "data": "Nombre_Prod" },
            { "data": "Cantidad_Prod" },
            { "data": "FechaEntrega" }
        ],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
        },
        "dom": 't' // Solo muestra la tabla, sin botones ni opciones adicionales
    });
});
</script>

<style>
@media print {
    body * {
        visibility: hidden;
    }
    #printArea, #printArea * {
        visibility: visible;
    }
    #printArea {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
    }
    @page {
        size: landscape;
        margin: 0;
    }
    #header {
        display: none; /* Oculta el encabezado */
    }
    #footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        text-align: center;
        border-top: 1px solid #000;
        padding: 10px;
    }
}
@page {
    size: portrait;
    margin: 0;
    @bottom-right {
        content: counter(page);
    }
}

</style>


  <button id="printButton">Imprimir</button>
 
    <div id="printArea">
    <div id="additionalInfo">
        <div id="providerInfo">Proveedor: </div> <!-- Proveedor -->
        <div id="destinationBranch">Sucursal Destino: </div> <!-- Sucursal destino -->
        <div id="invoiceNumber">Número de Factura: </div> <!-- Número de factura -->
        <div id="transferDate">Fecha del Traspaso: </div> <!-- Fecha del traspaso -->
    </div>
    <div class="text-center">
        <div class="table-responsive">
      
          <table id="Productos" class="hover" style="width:100%">
            <thead>
              
              <th style="width:10%">Codigo de barras</th>
              <th style="width:40%">Nombre del producto</th>
              <th style="width:6%" >Cantidad</th>
             
              <th style="width:20%">Observaciones</th>
            </thead>
          </table>
        </div>
      </div>
      <div style="display: flex; justify-content: space-between; margin-top: 20px;">
    <div style="flex: 1; text-align: center;">
      <strong>Recibe:</strong>
      <br><br><br>
      <hr style="height: 2px; background-color: black; border: none; width: 200px; margin: 0 auto;">
      <br>
      <strong>Nombre y firma</strong>
    </div>
    <div style="flex: 1; text-align: center;">
      <strong>Entrega:</strong>
      <br><br><br>
      <hr style="height: 2px; background-color: black; border: none; width: 200px; margin: 0 auto;">
      <br>
      <strong>Nombre y firma</strong>
    </div>
  </div>
</div>
</div>
    </div>
    
  </div>

    </div>
   

    <script>
        document.getElementById('printButton').addEventListener('click', function() {
            // Lógica para imprimir
            window.print();

            // Enviar la solicitud AJAX al servidor
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'registrar_impresion.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    console.log('Impresión registrada con éxito');
                }
            };
            xhr.send('estado=exito');
        });
    </script>
<!-- POR CADUCAR -->





<!-- /.content-wrapper -->

<!-- Control Sidebar -->

<!-- Main Footer -->

<?php
include("Modales/BusquedaTraspasosFechas.php");
include("Modales/RealizaNuevaOrdenTraspasoCEDIS.php");

include("footer.php") ?>

<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->



<?php include "datatables.php"?>


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

function fechaCastellano ($fecha) {
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
  return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
}
?>



































