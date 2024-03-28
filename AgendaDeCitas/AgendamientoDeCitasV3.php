<?php
include "Consultas/Consultas.php";



?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Agendamiento de citas </title>

  <?php include "Header.php"?>
  <link href='js/fullcalendar/fullcalendar.css' rel='stylesheet' />
</head>
<div id="loading-overlay">
  <div class="loader"></div>
  <div id="loading-text" style="color: white; margin-top: 10px; font-size: 18px;"></div>
</div>
<?php include_once ("Menu.php")?>

<div class="tab-content" id="pills-tabContent">


<div class="tab-pane fade show active" id="CrediClinicas" role="tabpanel" aria-labelledby="pills-home-tab">
<div class="card text-center">
  <div class="card-header" style="background-color: #0057B8 !important;color: white;">
  Citas con especialistas disponibles para el dia de hoy
  </div>

  <!-- Container de botones-->
  <div>
    <!-- Bonton para agregar citas-->
  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#CitaExt" style="background-color: #C80096 !important;"class="btn btn-default">
  Agendar nueva cita <i class="fas fa-file-medical"></i>
</button>
<!-- Boton para filtrar por fecha-->
<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#FiltroEspecificoMesxd" style="background-color: #C80096 !important;" class="btn btn-default">
 Citas por fechas <i class="fas fa-calendar"></i>
</button>
<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#FiltraPorSucursales" style="background-color: #C80096 !important;" class="btn btn-default">
 Citas por sucursal <i class="fas fa-calendar"></i>
</button>
<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#FiltraPorSucursalesYEspecialistas" style="background-color: #C80096 !important;" class="btn btn-default">
 Citas por especialista <i class="fas fa-calendar"></i>
</button>
</div> <!-- Fin del container -->

</div>
<div id="CitasEnLaSucursalExt"></div>
</div>
</div>


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

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
 include("Modales/BusquedaPorSucursales.php");
 include("Modales/BusquedaPorSucursalesYEspecialistas.php");
  include ("footer.php")?>



<script src="js/CampanasExpress.js"></script>
<script src="js/AgregaEspecialidad.js"></script>
<script src="js/BuscaDataPacientes.js"></script>
<script src="js/BuscaDataPacientesExt.js"></script>
<!-- <script src="js/AgregaEspecialista.js"></script>
<script src="js/ObtieneEspecialidadMedicoSucursal.js"></script>
<script src="js/ObtieneMedicoDeSucursal.js"></script>
<script src="js/ObtieneFechas.js"></script>
<script src="js/ObtieneHoras.js"></script> -->
<script src="js/ObtieneEspecialidadMedicoExt.js"></script>
<script src="js/ObtieneMedicoDeSucursalExt.js"></script>
<script src="js/ObtieneFechasExt.js"></script>
<script src="js/ObtieneHorasExt.js"></script>
<script src="js/AgendaEnSucursalesValidacion.js"></script>

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->

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