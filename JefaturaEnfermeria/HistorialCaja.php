<?php
include "Consultas/Consultas.php";

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Historial de cajas | <?php echo $row['ID_H_O_D']?> </title>

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


<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
<div class="card text-center">
  <div class="card-header" style="background-color:#0057b8 !important;color: white;">
   Historial de cajas de <?php echo $row['ID_H_O_D']?> al <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?>  
  </div>
  
  <div >

</div>
</div>


    
<div id="CajasHistoricas"></div>


</div>


     
</div>

</div>

  
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
 
  <!-- Main Footer -->
<?php
  include ("footer.php")?>

<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<script src="js/ControlEstadoCajas.js"></script>




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

<!-- PAGE PLUGINS -->
<script>
   $(document).ready(function() {
    // Delegación de eventos para el botón "btn-Movimientos" dentro de .dropdown-menu
    $(document).on("click", ".dropdown-menu .btn-Movimientos", function() {
      console.log("Botón de cancelar clickeado para el ID:", id);
        var id = $(this).data("id");
        $.post("https://saludapos.com/JefaturaEnfermeria/Modales/HistorialCaja.php", { id: id }, function(data) {
            $("#FormCajas").html(data);
            $("#TitulosCajas").html("Historial de caja");
            $("#CajasDi").removeClass("modal-dialog modal-xl modal-notify modal-info");
            $("#CajasDi").addClass("modal-dialog modal-xl modal-notify modal-primary");
        });
        $('#ModalDetallesCaja').modal('show');
    });

    // Delegación de eventos para el botón "btn-Ventas" dentro de .dropdown-menu
    $(document).on("click", ".dropdown-menu .btn-Ventas", function() {
        var id = $(this).data("id");
        $.post("https://saludapos.com/JefaturaEnfermeria/Modales/HistorialVentas.php", { id: id }, function(data) {
            $("#FormCajas").html(data);
            $("#TitulosCajas").html("Historial de ventas");
            $("#CajasDi").removeClass("modal-dialog modal-xl modal-notify modal-info");
            $("#CajasDi").removeClass("modal-dialog modal-xl modal-notify modal-primary");
            $("#CajasDi").addClass("modal-dialog modal-xl modal-notify modal-success");
        });
        $('#ModalDetallesCaja').modal('show');
    });

    // Delegación de eventos para el botón "btn-Cortes" dentro de .dropdown-menu
    $(document).on("click", ".dropdown-menu .btn-Cortes", function() {
        var id = $(this).data("id");
        $.post("https://saludapos.com/JefaturaEnfermeria/Modales/CortesDeCaja.php", { id: id }, function(data) {
            $("#FormCajas").html(data);
            $("#TitulosCajas").html("Corte de caja");
            $("#CajasDi").removeClass("modal-dialog modal-xl modal-notify modal-info");
            $("#CajasDi").removeClass("modal-dialog modal-xl modal-notify modal-primary");
            $("#CajasDi").addClass("modal-dialog modal-xl modal-notify modal-success");
        });
        $('#ModalDetallesCaja').modal('show');
    });
});

</script>

  <div class="modal fade" id="ModalDetallesCaja" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="ModalDetallesCajaLabel" aria-hidden="true">
  <div id="CajasDi"class="modal-dialog  modal-notify modal-success" >
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="TitulosCajas"></p>

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
        <div id="FormCajas"></div>
        
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