<?php
include "Consultas/Consultas.php";

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Consulta de tickets | <?php echo isset($row['ID_H_O_D']) ? $row['ID_H_O_D'] : ''; ?> <?php echo isset($row['Nombre_Sucursal']) ? $row['Nombre_Sucursal'] : ''; ?></title>

  <?php include "Header.php"; ?>
  
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

  <?php include_once("Menu.php"); ?>

  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
    <div class="card text-center">
      <div class="card-header" style="background-color: #0057b8 !important; color: white;">
        Desglose de tickets <?php echo isset($row['Nombre_Sucursal']) ? $row['Nombre_Sucursal'] : ''; ?> al <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?>
      </div>
      
      <div>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#FiltroPorSucursalesIngresos" class="btn btn-default">
          Filtrar por sucursal <i class="fas fa-clinic-medical"></i>
        </button>
      </div>
    </div>
    
    <div id="TableVentasDelDia"></div>
  </div>

  <?php
    include("Modales/Error.php");
    include("Modales/Exito.php");
    include("Modales/ExitoActualiza.php");
    include("Modales/FiltroDeIngresosSucursales.php");
    include("footer.php");
  ?>
  
<script src="js/ControlVentasCreditoEnfermeria.js"></script>
  <script src="js/RealizaCambioDeSucursalPorFiltroDeBusqueda.js"></script>
  
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

  <script>
    $(document).ready(function() {
      // Delegación de eventos para el botón ".btn-desglose" dentro de .dropdown-menu
      $(document).on("click", ".btn-desglose", function() {
        var id = $(this).data("id");
        $.post("https://saludapos.com/AdminPOS/Modales/DesgloseTicketCreditoEnfermeria.php", { id: id }, function(data) {
            $("#FormCancelacion").html(data);
            $("#TituloCancelacion").html("Desglose del ticket");
            $("#Di3").removeClass("modal-dialog modal-lg modal-notify modal-info");
            $("#Di3").addClass("modal-dialog modal-xl modal-notify modal-primary");
        });
        $('#Cancelacionmodal').modal('show');

    });

    // Delegación de eventos para el botón ".btn-Reimpresion" dentro de .dropdown-menu
     $(document).on("click", ".btn-Reimpresion", function() {
        var id = $(this).data("id");
        $.post("https://saludapos.com/AdminPOS/Modales/ReimpresionTicketVentaCreditoEnfermeria.php", { id: id }, function(data) {
            $("#FormCancelacion").html(data);
            $("#TituloCancelacion").html("Reimpresion de tickets");
            $("#Di3").removeClass("modal-dialog modal-lg modal-notify modal-info");
            $("#Di3").addClass("modal-dialog modal-xl modal-notify modal-success");
        });
        $('#Cancelacionmodal').modal('show');
    });
});

</script>
<!-- PAGE PLUGINS -->
<div class="modal fade" id="Cancelacionmodal" tabindex="-2" role="dialog" style="overflow-y: scroll;" aria-labelledby="CancelacionmodalLabel" aria-hidden="true">
  <div id="Di3" class="modal-dialog modal-lg modal-notify modal-info">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="TituloCancelacion">Confirmacion de ticket</p>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
       
            <div class="modal-body">
          <div class="text-center">
        <div id="FormCancelacion"></div>
        
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