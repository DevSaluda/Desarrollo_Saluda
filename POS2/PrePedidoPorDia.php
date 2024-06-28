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
          Registro de ventas de Saluda al <?php echo fechaCastellano(date('d-m-Y H:i:s')); ?>  
        </div>
        <div>
          <button type="button" class="btn btn-success" id="guardarDatos" class="btn btn-default">
            Guardar Sugerencia <i class="fas fa-clinic-medical"></i>
          </button>
        </div>
      </div>

      <?php
      // Verificar si el formulario ha sido enviado
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          // Verificar si las variables están seteadas y no son nulas
          if (isset($_POST['Mes']) ) {
              // Obtener los valores del formulario
              $mes = $_POST['Mes'];
              echo "Mes seleccionado: $mes<br>";
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
        function mostrarCargando(event, settings) {
          var randomIndex = Math.floor(Math.random() * mensajesCarga.length);
          var mensaje = mensajesCarga[randomIndex];
          document.getElementById('loading-text').innerText = mensaje;
          document.getElementById('loading-overlay').style.display = 'flex';
        }

        function ocultarCargando() {
          document.getElementById('loading-overlay').style.display = 'none';
        }

        $(document).ready(function() {
          $('#Productos').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
            "language": {
              "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
            },
            "dom": 'Bfrtip',
            "buttons": [
              {
                extend: 'excelHtml5',
                text: 'Exportar a Excel',
                className: 'btn btn-primary',
                titleAttr: 'Exportar a Excel',
                exportOptions: {
                  columns: ':visible' // Exportar todas las columnas visibles
                }
              }
            ],
            "initComplete": function(settings, json) {
              ocultarCargando(); // Ocultar el overlay de carga cuando la tabla esté lista
            },
            "preDrawCallback": mostrarCargando,
            "drawCallback": ocultarCargando
          });
        });

        document.getElementById('guardarDatos').addEventListener('click', function() {
          $('#guardarDatos').prop('disabled', true);
          setTimeout(function() {
            $('#guardarDatos').prop('disabled', false);
          }, 5000);
        });

        $(document).ready(function() {
          $("#guardarDatos").click(function() {
            var mesSeleccionado = $("#mes").val();
            var fkSucursal = $("#fk_sucursal").val(); // Obtener el valor del campo oculto
            if (mesSeleccionado === null || mesSeleccionado === "") {
              alert("Por favor, seleccione un mes antes de continuar.");
              return;
            }

            $.ajax({
              url: 'consultas/ConsultasVentas.php',
              method: 'POST',
              data: {
                Mes: mesSeleccionado,
                Fk_Sucursal: fkSucursal // Incluir Fk_Sucursal en la solicitud
              },
              success: function(response) {
                console.log("Datos enviados correctamente: ", response);
                alert('Datos guardados correctamente');
                $('#guardarDatos').prop('disabled', true);
                setTimeout(function() {
                  $('#guardarDatos').prop('disabled', false);
                }, 5000);
              },
              error: function(xhr, status, error) {
                console.error("Error al enviar los datos: ", error);
                alert('Hubo un problema al guardar los datos');
              }
            });
          });
        });
      </script>
    </div>
  </div>

  <script src="js/ControlEstadoVentas.js"></script>
</body>
</html>
<?php include ("footer.php"); ?>
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
