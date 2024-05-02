<?php
include "Consultas/Consultas.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Ventas realizadas por <?php echo $row['ID_H_O_D']?> <?php echo $row['Nombre_Sucursal']?> </title>
  <?php include "Header.php"?>
  <style>
    .error {
      color: red;
      margin-left: 5px; 
    }
  </style>
</head>
<body>
  <div id="loading-overlay">
    <div class="loader"></div>
    <div id="loading-text" style="color: white; margin-top: 10px; font-size: 18px;"></div>
  </div>
  <?php include_once ("Menu.php")?>
  <div class="tab-content" id="pills-tabContent">
<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
<div class="card text-center">
  <div class="card-header" style="background-color:#0057b8 !important;color: white;">
   Registro de ventas de Saluda <?php echo $row['Nombre_Sucursal']?> al <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?>  
  </div>
 
  <div >
  <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#FiltroEspecifico" class="btn btn-default">
  Filtrar por sucursal <i class="fas fa-clinic-medical"></i>
</button>
<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#FiltroEspecificoMesxd" class="btn btn-default">
  Busqueda por mes <i class="fas fa-calendar-week"></i>
</button>
<button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#FiltroPorProducto" class="btn btn-default">
  Filtrar por producto <i class="fas fa-prescription-bottle"></i>
</button>
<button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#FiltraPorFormasDePago" class="btn btn-default">
  Filtrar por forma de pago <i class="fas fa-prescription-bottle"></i>
</button>
<button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#" class="btn btn-default">
  Filtrar por rango de fechas <i class="fas fa-prescription-bottle"></i>
</button>
</div>
</div>

      <?php
      // Verificar si el formulario ha sido enviado
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          // Verificar si las variables están seteadas y no son nulas
          if (isset($_POST['Mes']) && isset($_POST['anual'])) {
              // Obtener los valores del formulario
              $mes = $_POST['Mes'];
              $anual = $_POST['anual'];

              // Realizar las operaciones que necesites con estas variables
              // Por ejemplo, imprimir su valor
              echo "Mes seleccionado: $mes<br>";
              echo "Año seleccionado: $anual<br>";
          } else {
              // Si alguna de las variables no está seteada o es nula, mostrar un mensaje de error
              echo "Error: No se recibieron todas las variables necesarias.";
          }
      }
      ?>

      <style>
        /* Personalizar el diseño de la paginación con CSS */
        .dataTables_wrapper .dataTables_paginate {
          text-align: center !important; /* Centrar los botones de paginación */
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

        /* Cambiar el color del paginado seleccionado */
        .dataTables_paginate .paginate_button.current {
          background-color: #007bff !important;
          color: #fff !important;
          border-color: #007bff !important;
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
        #Productos th {
          font-size: 12px; /* Tamaño de letra para los encabezados */
          padding: 4px; /* Ajustar el espaciado entre los encabezados */
          white-space: nowrap; /* Evitar que los encabezados se dividan en varias líneas */
        }
      </style>

      <style>
        /* Estilos para la tabla */
        #Productos {
          font-size: 12px; /* Tamaño de letra para el contenido de la tabla */
          border-collapse: collapse; /* Colapsar los bordes de las celdas */
          width: 100%;
          text-align: center; /* Centrar el contenido de las celdas */
        }

        #Productos th {
          font-size: 16px; /* Tamaño de letra para los encabezados de la tabla */
          background-color: #0057b8 !important; /* Nuevo color de fondo para los encabezados */
          color: white; /* Cambiar el color del texto a blanco para contrastar */
          padding: 10px; /* Ajustar el espaciado de los encabezados */
        }

        #Productos td {
          font-size: 14px; /* Tamaño de letra para el contenido de la tabla */
          padding: 8px; /* Ajustar el espaciado de las celdas */
          border-bottom: 1px solid #ccc; /* Agregar una línea de separación entre las filas */
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

      <style>
        /* Estilos para la capa de carga */
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
          z-index: 9999; /* Asegurarse de que el overlay esté encima de todo */
          display: none; /* Ocultar inicialmente el overlay */
        }

        /* Estilo para el ícono de carga */
        .loader {
          border: 6px solid #f3f3f3; /* Color del círculo externo */
          border-top: 6px solid #C80096; /* Color del círculo interno */
          border-radius: 50%;
          width: 60px;
          height: 60px;
          animation: spin 1s linear infinite; /* Animación de rotación */
        }

        @keyframes spin {
          0% { transform: rotate(0deg); }
          100% { transform: rotate(360deg); }
        }
      </style>

      <script>
        // Definir una lista de mensajes para el mensaje de carga
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

        // Función para mostrar el mensaje de carga con un texto aleatorio
        function mostrarCargando(event, settings) {
          var randomIndex = Math.floor(Math.random() * mensajesCarga.length);
          var mensaje = mensajesCarga[randomIndex];
          document.getElementById('loading-text').innerText = mensaje;
          document.getElementById('loading-overlay').style.display = 'flex';
        }

        // Función para ocultar el mensaje de carga
        function ocultarCargando() {
          document.getElementById('loading-overlay').style.display = 'none';
        }

        var tabla;
        $(document).ready(function() {
          tabla = $('#Productos').DataTable({
            "processing": true,
            "ordering": true,
            "stateSave": true,
            "autoWidth": true,
            "order": [[ 0, "desc" ]],
            "ajax": {
              "type": "POST", // Especifica el método de envío de la solicitud AJAX
              "url": "https://saludapos.com/JefaturaEnfermeria/Consultas/ArrayDesgloseVentasMes.php",
              "data": function (d) {
        // Aquí puedes definir el código PHP directamente
        var mes = '<?php echo $mes; ?>'; // Obtén el valor de mes desde PHP
        var anual = '<?php echo $anual; ?>'; // Obtén el valor de anual desde PHP

        // Construye el objeto de datos para enviar al servidor
        var dataToSend = {
            "Mes": mes,
            "anual": anual
        };

        return dataToSend;
    },
              "error": function(xhr, error, thrown) {
            console.log("Error en la solicitud AJAX:", error);
        }
    },
            "columns": [
              { "data": "Cod_Barra" },
              { "data": "Nombre_Prod" },
              { "data": "FolioTicket" },
              { "data": "Sucursal" },
              { "data": "Turno" },
              { "data": "Cantidad_Venta" },
              { "data": "Total_Venta" },
              { "data": "Importe" },
              { "data": "Descuento" },
              { "data": "FormaPago" },
              { "data": "Cliente" },
              { "data": "FolioSignoVital" },
              { "data": "NomServ" },
              { "data": "AgregadoEl" },
              { "data": "AgregadoEnMomento" },
              { "data": "AgregadoPor" },
              { "data": "Enfermero" },
              { "data": "Doctor" }
            ],
            "lengthMenu": [[10,20,150,250,500, -1], [10,20,50,250,500, "Todos"]],
            "language": {
              "lengthMenu": "Mostrar _MENU_ registros",
              "sPaginationType": "extStyle",
              "zeroRecords": "No se encontraron resultados",
              "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
              "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
              "infoFiltered": "(filtrado de un total de _MAX_ registros)",
              "sSearch": "Buscar:",
              "paginate": {
                "first": '<i class="fas fa-angle-double-left"></i>',
                "last": '<i class="fas fa-angle-double-right"></i>',
                "next": '<i class="fas fa-angle-right"></i>',
                "previous": '<i class="fas fa-angle-left"></i>'
              },
              "processing": function () {
                mostrarCargando();
              }
            },
            "initComplete": function() {
              // Al completar la inicialización de la tabla, ocultar el mensaje de carga
              ocultarCargando();
            },
            "buttons": [
              {
                extend: 'excelHtml5',
                text: 'Exportar a Excel  <i Exportar a Excel class="fas fa-file-excel"></i> ',
                titleAttr: 'Exportar a Excel',
                title: 'registro de ventas ',
                className: 'btn btn-success',
                exportOptions: {
                  columns: ':visible' // Exportar solo las columnas visibles
                }
              }
            ],
            "dom": '<"d-flex justify-content-between"lBf>rtip', // Modificar la disposición aquí
            "responsive": true
          });
        });
      </script>

      <div class="text-center">
        <div class="table-responsive">
          <table id="Productos" class="hover" style="width:100%">
            <thead>
              <th>Cod</th>
              <th>Nombre</th>
              <th>N° Ticket</th>
              <th>Sucursal</th>
              <th>Turno</th>
              <th>Cantidad</th>
              <th>P.U</th>
              <th>Importe</th> 
              <th>Descuento</th>
              <th>Forma de pago</th>
              <th>Cliente</th>
              <th>Folio Signo Vital</th>
              <th>Servicio</th>
              <th>Fecha</th>
              <th>Hora</th>   
              <th>Vendedor</th>
              <th>Enfermero</th>
              <th>Doctor</th>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Modales y scripts -->
  <?php
  include ("Modales/Error.php");
  include ("Modales/Exito.php");
  include ("Modales/ExitoActualiza.php");
  include ("Modales/FiltraEspecificamente.php");
  include ("Modales/FiltraFechasEspecialesVenta.php");
  include ("Modales/FiltraPorMes.php");
  include ("Modales/FiltroPorProducto.php");
  include ("footer.php");
  ?>

<script src="js/ControlVentas.js"></script>

<script src="js/RealizaCambioDeSucursalPorFiltro.js"></script>

<script src="datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>  
    <script src="datatables/JSZip-2.5.0/jszip.min.js"></script>    
    <script src="datatables/pdfmake-0.1.36/pdfmake.min.js"></script>    
    <script src="datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
  <!-- Bootstrap -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>
  <!-- OPTIONAL SCRIPTS -->
  <script src="dist/js/demo.js"></script>
  
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
