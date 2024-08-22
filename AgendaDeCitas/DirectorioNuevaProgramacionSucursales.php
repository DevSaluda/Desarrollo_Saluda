<?php
include "Consultas/Consultas.php";
include "Consultas/Sesion.php";

include "Consultas/ConeSelectDinamico.php";

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Programación de campañas de sucursales</title>

  <?php include "Header.php"?>
</head>
<div id="loading-overlay">
  <div class="loader"></div>
  <div id="loading-text" style="color: white; margin-top: 10px; font-size: 18px;"></div>
</div>
<?php include_once ("Menu.php")?>
<div class="card text-center">
  <div class="card-header" style="background-color: #2E64FE !important;color: white;">
  Programación de campañas de sucursales
  </div>
  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#CitaExt" style="background-color: #C80096 !important;"class="btn btn-default">
  Agendar nueva cita <i class="fas fa-file-medical"></i>
</button>
  <div >
  
</div>

</div>


    
<div id="ProgramaSucursalesExt"></div>


</div>
</div>
</div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <?php
include ("Modales/Exito.php");
include ("Modales/AgendarCitasExt.php");
  include ("footer.php");?>

<script src="js/ProgramacionSucursalesVersionFinal.js"></script>
<script src="js/ObtieneEspecialidadExt.js"></script>
<script src="js/ObtieneMedicoSucursalExt.js"></script>
<script src="js/ProgramaEnSucursalesExt.js"></script>




<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script>
  $(document).ready(function() {
    // Delegación de eventos para el botón ".btn-desglose" dentro de .dropdown-menu
    $(document).on("click", ".btn-AsigSucursal", function() {
        var id = $(this).data("id");
        $.post("https://saludapos.com/AgendaDeCitas/Modales/AutorizaFechasExtNuevo.php", { id: id }, function(data) {
          
          $("#form-edit").html(data);
          $("#Titulo").html("Apertura de fechas");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Di").removeClass("modal-dialog modal-xl modal-notify modal-primary");
              $("#Di").removeClass("modal-dialog  modal-lg modal-notify modal-primary");
              $("#Di").addClass("modal-dialog  modal-notify modal-primary");
  		});
  		$('#editModal').modal('show');
  	});


    $(document).on("click", ".btn-EditSucursal", function() {
        var id = $(this).data("id");
        $.post("https://saludapos.com/AgendaDeCitas/Modales/EdicionDeFechasEspecialidades.php", { id: id }, function(data) {
          
          $("#form-edit").html(data);
          $("#Titulo").html("Modificacion de fechas");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Di").removeClass("modal-dialog modal-xl modal-notify modal-primary");
              $("#Di").removeClass("modal-dialog  modal-lg modal-notify modal-primary");
              $("#Di").addClass("modal-dialog  modal-notify modal-primary");
  		});
  		$('#editModal').modal('show');
  	});
    
    $(document).on("click", ".btn-DeleteSucursalDatos", function() {
        var id = $(this).data("id");
        $.post("https://saludapos.com/AgendaDeCitas/Modales/EliminarFechasEspecialidades.php", { id: id }, function(data) {
          
          $("#form-edit").html(data);
          $("#Titulo").html("Modificacion de fechas");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Di").removeClass("modal-dialog modal-xl modal-notify modal-primary");
              $("#Di").removeClass("modal-dialog  modal-lg modal-notify modal-primary");
              $("#Di").addClass("modal-dialog modal-lg modal-notify modal-danger");
  		});
  		$('#editModal').modal('show');
  	});
    
    // Delegación de eventos para el botón "apertura de horarios" dentro de las opciones disponibles
    $(document).on("click", ".btn-NuevaAutorizacionHoras", function() {
        var id = $(this).data("id");
        $.post("https://saludapos.com/AgendaDeCitas/Modales/NuevaAperturaDeHorarios.php", { id: id }, function(data) {
         
          $("#form-edit").html(data);
          $("#Titulo").html("Despliegue de horas sobre fechas disponibles del especialista");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Di").addClass("modal-dialog  modal-notify modal-primary");
  		});
  		$('#editModal').modal('show');
  	});


     // Delegación de eventos para el botón "Edicion de horas" dentro de las opciones disponibles
     $(document).on("click", ".EditHoras", function() {
        var id = $(this).data("id");
        $.post("https://saludapos.com/AgendaDeCitas/Modales/EdicionDeHorarios.php", { id: id }, function(data) {
         
          $("#form-edit").html(data);
          $("#Titulo").html("Despliegue de horas sobre fechas disponibles del especialista");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Di").addClass("modal-dialog  modal-notify modal-primary");
  		});
  		$('#editModal').modal('show');
  	});
    
     // Delegación de eventos para el botón ".btn-Reimpresion" dentro de .dropdown-menu
    
});

</script>
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalLabel" aria-hidden="true">
  <div id="Di"class="modal-dialog modal-lg modal-notify modal-info">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="Titulo"></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
        
	        <div class="modal-body">
          <div class="text-center">
        <div id="form-edit"></div>
        
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
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
<? 

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