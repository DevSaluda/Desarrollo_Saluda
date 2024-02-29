<?php
  // Obteniendo la fecha actual del sistema con PHP
  $fechaActual = date("Y-m-d",strtotime("+ 1 days"));
 
 $fechafinalcargasemama = date("Y-m-d",strtotime($fechaActual."+ 7 days"));
 $fechafinalcargames = date("Y-m-d",strtotime($fechaActual."+ 30 days"))
?>

<div class="modal fade" id="ProgramacionExt" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
<div class="modal-dialog  modal-lg modal-notify modal-primary">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Nueva programación</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
        <div class="alert alert-success alert-styled-left text-blue-800 content-group">
						                <span class="text-semibold">Estimado usuario, </span>
                            los campos con un  <span class="text-danger"> * </span> son campos necesarios para el correcto ingreso de datos.
                          
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
      <div class="modal-body">
 
      <label for="años">Selecciona un año:</label>
    <select id="años" onchange="cargarFechas()">
        <!-- Puedes personalizar el rango de años según tus necesidades -->
        <option value="2022">2022</option>
        <option value="2023">2023</option>
        <option value="2024">2024</option>
        <!-- Agrega más años según sea necesario -->
    </select>

    <br>

    <label for="meses">Selecciona un mes:</label>
    <select id="meses" onchange="cargarFechas()">
        <option value="1">Enero</option>
        <option value="2">Febrero</option>
        <option value="3">Marzo</option>
        <option value="4">Abril</option>
        <option value="5">Mayo</option>
        <option value="6">Junio</option>
        <option value="7">Julio</option>
        <option value="8">Agosto</option>
        <option value="9">Septiembre</option>
        <option value="10">Octubre</option>
        <option value="11">Noviembre</option>
        <option value="12">Diciembre</option>
    </select>

    <br>

    <label for="fechaInicio">Fecha de Inicio:</label>
    <input type="text" id="fechaInicio" readonly>

    <br>

    <label for="fechaFin">Fecha de Fin:</label>
    <input type="text" id="fechaFin" readonly>

    <script>
        function cargarFechas() {
            var añoSeleccionado = document.getElementById("años").value;
            var mesSeleccionado = document.getElementById("meses").value;

            // Obtener el último día del mes seleccionado
            var ultimoDiaMes = new Date(añoSeleccionado, mesSeleccionado, 0).getDate();

            // Asumiendo que el primer día siempre es 1
            var fechaInicio = new Date(añoSeleccionado, mesSeleccionado - 1, 1);
            var fechaFin = new Date(añoSeleccionado, mesSeleccionado - 1, ultimoDiaMes);

            // Formatear las fechas como 'YYYY-MM-DD'
            var fechaInicioFormateada = fechaInicio.toISOString().split('T')[0];
            var fechaFinFormateada = fechaFin.toISOString().split('T')[0];

            // Actualizar los valores de los inputs
            document.getElementById("fechaInicio").value = fechaInicioFormateada;
            document.getElementById("fechaFin").value = fechaFinFormateada;
        }
    </script>

                                        

      </div>
    </div>
  </div>
</div></div></div>


