<?php
include "Consultas/Consultas.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Busqueda de citas</title>
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
          Busqueda de citas por fechas 
        </div>
        <div>
    <!-- Bonton para agregar citas-->
  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#CitaExt" style="background-color: #C80096 !important;"class="btn btn-default">
  Agendar nueva cita <i class="fas fa-file-medical"></i>
</button>
<!-- Boton para filtrar por fecha-->
<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#FiltroEspecificoMesxd" style="background-color: #C80096 !important;" class="btn btn-default">
 Citas por fechas <i class="fas fa-calendar"></i>
</button>

</div> <!-- Fin del container -->
      </div>

      <?php
      // Verificar si el formulario ha sido enviado
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          // Verificar si las variables están seteadas y no son nulas
          if (isset($_POST['fechainicial']) && isset($_POST['fechafinal']) && isset($_POST['sucursal'])) {
              // Obtener los valores del formulario
              $Fechainicio = $_POST['fechainicial'];
              $FechaFin = $_POST['fechafinal'];
              $sucursalbusqueda= $_POST['sucursal'];

              // Realizar las operaciones que necesites con estas variables
              // Por ejemplo, imprimir su valor
              echo "Mes seleccionado: $Fechainicio<br>";
              echo "Año seleccionado: $FechaFin<br>";
              echo "Sucursal seleccionada: $sucursalbusqueda <br>";
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
              "url": "https://saludapos.com/AgendaDeCitas/Consultas/ArrayDesgloseCitasPorFechas.php",
              "data": function (d) {
        // Aquí puedes definir el código PHP directamente
        var mes = '<?php echo $Fechainicio; ?>'; // Obtén el valor de mes desde PHP
        var anual = '<?php echo $FechaFin; ?>'; // Obtén el valor de anual desde PHP

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
              { "data": "Folio" },
              { "data": "Paciente" },
              { "data": "Telefono" },
              { "data": "Fecha" },
              { "data": "Hora" },
              { "data": "Especialidad" },
              { "data": "Doctor" },
              { "data": "Sucursal" },
              { "data": "Observaciones" },
              { "data": "AgendadoPor" },
              { "data": "AgendamientoRealizado" },
              { "data": "ConWhatsapp" },
              { "data": "BotonCancelar" },
             
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
            <th>Folio</th>
<th>Paciente</th>
<th>Telefono</th>
<th>Fecha</th>
<th>Hora</th>
<th>Especialidad</th>
<th>Doctor </th>
<th>Sucursal</th>
<th>Observaciones</th>
<th>Agendado por </th>
<th>Registrado el </th>
<th>Enviar Mensaje </th>
<th>Cancelar </th>
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
 
    include ("Modales/Precarga.php");
    include ("Modales/ExitoActualiza.php");
    include ("Modales/EstatusAgendaGuardado.php");
   include ("Modales/AgendarCitasDeSucursales.php");
   include ("Modales/AgendarCitasExt.php");
  include ("Modales/AltaEspecialista.php");
  include("Modales/BusquedaPorFechas.php");
  include ("footer.php");
  ?>

  <!-- Bootstrap -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>
  <!-- OPTIONAL SCRIPTS -->
  <script src="dist/js/demo.js"></script>
  <script>
 
 $(document).ready(function() {
    // Delegación de eventos para el botón ".btn-edit" dentro de .dropdown-menu
    $(document).on("click", ".btn-edit", function() {
    console.log("Botón de edición clickeado");
        var id = $(this).data("id");
        $.post("https://saludapos.com/AgendaDeCitas/Modales/CancelaCitaExt.php", { id: id }, function(data) {
            $("#form-edit").html(data);
            $("#Titulo").html("Corte de caja");
            $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-info");
            $("#Di").addClass("modal-dialog modal-lg modal-notify modal-warning");
        });
        $('#editModal').modal('show');
    });
});
</script>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalLabel" aria-hidden="true">
  <div id="Di"class="modal-dialog  modal-notify modal-warning">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="Titulo"></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
        <div id="Mensaje "class="alert alert-info alert-styled-left text-blue-800 content-group">
						                <span id="Aviso" class="text-semibold"><?php echo $row['Nombre_Apellidos']?>
                            Verifique los campos antes de realizar alguna accion</span>
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
	        <div class="modal-body">
          <div class="text-center">
        <div id="form-edit"></div>
        
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
<style>
        .animation-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
    </style>



<script>
        document.addEventListener("DOMContentLoaded", function() {
            var enMantenimiento = false;

            if (enMantenimiento) {
                // HTML de la animación
                var animationHTML = '<div class="animation-container"><img src="https://media.tenor.com/iDYg-7xD7M4AAAAC/burning-office-spongebob.gif" style="max-width: 100%; height: auto;">' +
                '<p style="text-align: center;"><strong>Lo sentimos, estamos realizando tareas de mantenimiento en este momento.</strong><br>Es posible que algún contenido no esté disponible temporalmente. ¡Volvemos pronto!</p></div>';

                Swal.fire({
                  
                    title: 'Mantenimiento en curso',
                    html: animationHTML,
                    allowOutsideClick: false,
                    showCancelButton: false,
                    showCloseButton: false
                }).then((result) => {
                    // Aquí podrías agregar lógica adicional si es necesario después de que el usuario interactúe con la alerta
                });
            }
        });
    </script>


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
