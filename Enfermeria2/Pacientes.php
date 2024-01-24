<?php
include "Consultas/Consultas.php";

include "Consultas/Conexion_selects.php";
include "Consultas/ConeSelectDinamico.php";

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title> Cita en sucursal <?php echo $row['Nombre_Sucursal']?></title>

  <?php  include "Header.php"?>
</head>
<div id="loading-overlay">
  <div class="loader"></div>
  <div id="loading-text" style="color: white; margin-top: 10px; font-size: 18px;"></div>
</div>
<?php include_once ("Menu.php")?>

<div class="card text-center">
  <div class="card-header" style="background-color: #0057b8 !important;color: white;">
  Cita en sucursal <?php echo $row['Nombre_Sucursal']?> al <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?>  
  </div>
  <div >
  <a type="button" class="btn btn-success" href="AltaPacientes">
  Alta de paciente <i class="fas fa-plus-square"></i>
  </a>
</div>

</div>

 
  
 
    
<div id="tabla"></div>


</div>
</div>
</div>




  <!-- Main Footer -->
  <?php
include ("Modales/AltaCitaSucursal.php");
include ("Modales/Exito.php");
include ("Modales/Confirmacion.php");
include ("Modales/Precarga.php");
  include ("footer.php");?>
<!-- ./wrapper -->
<script src="js/ControlPacientes.js"></script>

<script src="js/ControlSignosVitales.js"></script>
<script src="js/GuardaCita.js"></script>
<script src="js/Capturadata.js"></script>
<script src="js/CalculaIMC.js"></script>

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
        // Delegación de eventos para el botón ".btn-edit"
        $(document).on("click", ".btn-edit", function() {
            var id = $(this).data("id");
            $.post("https://saludapos.com/Enfermeria2/Modales/ConfirmaDatosP.php", "id=" + id, function(data) {
                $("#form-edit").html(data);
            });
            $('#editModal').modal('show');
        });
    });
</script>



<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true"  style="overflow-y: scroll;">
  <div class="modal-dialog modal-lg modal-notify modal-success" >
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="TituloModal">Confirmación de datos de paciente</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
        <div class="alert alert-info alert-styled-left text-blue-800 content-group">
						                <span class="text-semibold"><?php echo $row['Nombre_Apellidos']?>, </span>
                            Antes iniciar el proceso de captura de datos de signos vitales del paciente, se requiere una previa confirmación de sus datos, por favor verifica los campos antes de continuar.
                            
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
                            <div class="alert alert-warning alert-styled-left text-blue-800 content-group">
                            <span class="text-semibold"><?php echo $row['Nombre_Apellidos']?>, </span>
                            los campos con un  <span class="text-danger" style="font-weight: 900;"> * </span> son campos necesarios para el correcto ingreso de datos.
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
	        <div class="modal-body">
          <div class="text-center">
        <div id="form-edit"></div>
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
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