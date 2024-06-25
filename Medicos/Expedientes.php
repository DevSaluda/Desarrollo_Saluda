<?php
include "Consultas/Consultas.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Lista De Expedientes | <?php echo $row['ID_H_O_D']?> <?php echo $row['Nombre_Sucursal']?> </title>

  <?php include "Header.php"?>
  <style>
    .error {
      color: red;
      margin-left: 5px;
    }
    /* Estilos personalizados para la tabla */
    #Expedientes {
      font-size: 12px; /* Tamaño de letra para el contenido de la tabla */
      border-collapse: collapse; /* Colapsar los bordes de las celdas */
      width: 100%;
      text-align: center; /* Centrar el contenido de las celdas */
    }

    #Expedientes th {
      font-size: 16px; /* Tamaño de letra para los encabezados de la tabla */
      background-color: #0057b8 !important; /* Nuevo color de fondo para los encabezados */
      color: white; /* Cambiar el color del texto a blanco para contrastar */
      padding: 10px; /* Ajustar el espaciado de los encabezados */
    }

    #Expedientes td {
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
</head>
<body>
<div id="loading-overlay">
  <div class="loader"></div>
  <div id="loading-text" style="color: white; margin-top: 10px; font-size: 18px;"></div>
</div>
<?php include_once ("Menu.php")?>

<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
  <div class="card text-center">
    <div class="card-header" style="background-color: #0057b8 !important; color: white;">
      Lista De Expedientes al <?php echo fechaCastellano(date('d-m-Y H:i:s')); ?>  
    </div>
    <div>
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#FiltroPorSucursalesIngresos">
        Filtrar por sucursal <i class="fas fa-clinic-medical"></i>
      </button>
    </div>
  </div>
  <div id="ListaDeExpedientes">
    <div class="text-center">
      <div class="table-responsive">
        <table id="Expedientes" class="table table-hover">
          <thead>
            <tr>
              <th>Folio</th>
              <th>Nombre del Paciente</th>
              <th>Fecha de Nacimiento</th>
              <th>Edad</th>
              <th>Sexo</th>
              <th>Teléfono</th>
              <th>Expediente</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal para filtro por sucursales -->
<?php
  include ("Modales/Error.php");
  include ("Modales/Exito.php");
  include ("Modales/ExitoActualiza.php");
  include ("Modales/FiltroDeIngresosSucursales.php");
  include ("footer.php");
?>

<!-- ./wrapper -->

<script src="js/ControlDeExpedientes.js"></script>
<script src="datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="datatables/JSZip-2.5.0/jszip.min.js"></script>
<script src="datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script src="datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script src="datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="dist/js/adminlte.js"></script>
<script src="dist/js/demo.js"></script>

<script>
  // Definir una lista de mensajes para el mensaje de carga
  var mensajesCarga = [
    "Consultando expedientes médicos...",
    "Estamos realizando la búsqueda...",
    "Cargando datos...",
    "Procesando la información...",
    "Espere un momento...",
    "Cargando... ten paciencia, incluso los planetas tardaron millones de años en formarse.",
    // ... otros mensajes de carga ...
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

  $(document).ready(function() {
    var tabla = $('#Expedientes').DataTable({
      "bProcessing": true,
      "ordering": true,
      "stateSave": true,
      "bAutoWidth": false,
      "order": [[ 0, "desc" ]],
      "sAjaxSource": "https://saludapos.com/AdminPOS/Consultas/ArrayExpedientes.php",
      "aoColumns": [
        { mData: 'Folio' },
        { mData: 'Nombre_Paciente' },
        { mData: 'Fecha_Nacimiento' },
        { mData: 'Edad' },
        { mData: 'Sexo' },
        { mData: 'Telefono' },
        {
          mData: 'Folio',
          render: function(data, type, row) {
            return '<button class="btn btn-primary" onclick="verExpediente(' + data + ')">Ver Expediente</button>';
          }
        }
      ],
      "lengthMenu": [[20, 150, 250, 500, -1], [20, 50, 250, 500, "Todos"]],
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
        },
        "drawCallback": function( settings ) {
          ocultarCargando();
        }
      },
      "dom": 'lBfrtip',
      "buttons": [
        {
          extend: 'excelHtml5',
          text: '<i class="fas fa-file-excel"></i> Exportar a Excel',
          titleAttr: 'Exportar a Excel',
          className: 'btn btn-success btn-sm'
        }
      ]
    });

     // Función para redirigir al expediente completo
  window.verExpediente = function(idExpediente) {
    window.location.href = "https://saludapos.com/Medicos/ExpedienteCompleto.php?id=" + idExpediente;
  };
});
</script>

<!-- Modal para mostrar expediente completo -->
<div class="modal fade" id="ModalExpediente" tabindex="-1" role="dialog" aria-labelledby="ModalExpedienteLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #0057b8 !important; color: white;">
        <h5 class="modal-title" id="TituloExpediente">Expediente Completo del Paciente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="FormExpediente"></div>
      </div>
    </div>
  </div>
</div>

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

function fechaCastellano($fecha) {
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

