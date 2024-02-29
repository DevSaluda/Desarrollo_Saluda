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
    background-color: #C80096 !important; /* Nuevo color de fondo para los encabezados */
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
"⏳ Esperando mientras cargamos con paciencia y cuidado.",
"⌛ Cargando energía y sonrisas para iluminar el día.",
"⏰ En la espera, tejemos hilos de compasión y empatía.",
"⚕️ Cargando salud y bienestar, un byte a la vez.",
"🩹 Paciencia es la medicina que administramos mientras carga la recuperación",
"⏳ Cargando tareas, completando metas, un minuto a la vez.",

"⌛ Organizando pensamientos mientras el reloj carga su siguiente paso.",
"⏰ En la pausa de carga, recalibrando el rumbo hacia la productividad.",
"📅 Cargando planes para un futuro lleno de posibilidades.",
"📝 Preparando una lista de tareas mientras el mundo carga su siguiente capítulo.",
"⏳ Cargando la próxima revolución tecnológica... ¡patience.exe!",

"⌛ En el mundo digital, incluso la paciencia debe ser procesada.",
"⏰ La espera es el precio que pagamos por la maravilla de la tecnología.",
"🔌 Cargando conexiones mientras la red teje su tela invisible.",
"💻 Esperando mientras la línea de código se carga en el lienzo digital.",
  
"🗓️ Organiza tu tiempo, controla tus citas y haz que cada momento cuente.",
"⏰ La agenda es tu aliada para no perder ni un instante importante. ¡Aprovecha al máximo tu día!",
"📅 Cada página de tu agenda es una oportunidad para planificar y crear recuerdos.",
"📆 Un día bien agendado es un paso más cerca de tus objetivos.",
"🕰️ La gestión de citas te da el poder de dirigir tu tiempo y escribir tu historia.",
"🗂️ Archiva tus días con citas bien planificadas y observa cómo se construye tu éxito.",
"🖊️ Cada cita agendada es un compromiso contigo mismo y tus metas.",
"💼 Controla tus citas como un profesional: organización es clave.",
"🕊️ El agendamiento libera tu mente, permitiéndote concentrarte en lo que realmente importa.",
"🛤️ La agenda es tu camino hacia la eficiencia y la productividad.",
"📝 Escribiendo tu futuro con cada cita agendada.",
"🗃️ Citas organizadas, día por día, paso a paso hacia el éxito.",
"🌟 Un agendamiento efectivo ilumina tu camino hacia tus sueños.",
"📊 Controla tus citas y observa cómo se despliega tu progreso.",
"🎯 Cada cita es un objetivo, y tu agenda es el mapa hacia su logro.",
"🗺️ La agenda es tu brújula en el viaje de la productividad personal.",
"🌈 Agendar citas es pintar tu vida con colores de planificación y logros.",
"✍️ Cada cita es una firma en la hoja de tu tiempo. ¡Hazlo valer!",
"📌 Cada cita es un clavo en la construcción de tus metas. Asegúrate de que estén bien colocados.",
"🌄 Agendamiento inteligente: el amanecer de tus días productivos."];


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



tabla = $('#CitasIndex').DataTable({

 "bProcessing": true,
 "ordering": true,
 "stateSave":true,
 "bAutoWidth": false,
 "order": [[ 0, "desc" ]],
 "sAjaxSource": "https://saludapos.com/AgendaDeEspecialistas/Consultas/ArrayCitasIndex.php",
 "aoColumns": [
    { mData: 'Folio' },
       { mData: 'Paciente' },
       { mData: 'Telefono' },
       { mData: 'Fecha' },
       { mData: 'Hora' },
       { mData: 'Especialidad' },
       { mData: 'Doctor' },
       { mData: 'Sucursal' },
       { mData: 'Observaciones' },
      //  { mData: 'ConfirmarCita' },
       { mData: 'AgendadoPor' },
       { mData: 'AgendamientoRealizado' },
       { mData: "ConWhatsapp" },
    
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
// Para personalizar el estilo del botón de Excel
"buttons": [
  {
    extend: 'excelHtml5',
    text: 'Exportar a Excel  <i Exportar a Excel class="fas fa-file-excel"></i> ',
    titleAttr: 'Exportar a Excel',
    title: 'Base de CitasIndex',
    className: 'btn btn-success',
    exportOptions: {
      columns: ':visible' // Exportar solo las columnas visibles
    }
  }
],
// Personalizar la posición de los elementos del encabezado
"dom": '<"d-flex justify-content-between"lBf>rtip', // Modificar la disposición aquí
"responsive": true
});
</script>
<div class="text-center">
	<div class="table-responsive">
	<table  id="CitasIndex" class="table table-hover">
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
<!-- <th>Recordartorio</th> -->

<th>Agendado por </th>
<th>Registrado el </th>
<th>Enviar Mensaje </th>
	


</thead>

</div>
</div>


