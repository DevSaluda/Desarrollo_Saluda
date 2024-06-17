<?php
include "Consultas/Consultas.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Promociones Credito | <?php echo $row['ID_H_O_D']; ?></title>
    <?php include "Header.php"; ?>
    <style>
        .error {
            color: red;
            margin-left: 5px;
        }
    </style>
</head>
<body>
    <?php include_once("Menu.php"); ?>

    <div class="tab-pane fade show" id="pills-TipPro" role="tabpanel" aria-labelledby="pills-home-tab">
        <div class="card-header" style="background-color:#2b73bb; color: white;">
            Promociones de créditos de <?php echo $row['ID_H_O_D']; ?> al <?php echo fechaCastellano(date('d-m-Y H:i:s')); ?>
        </div>
        <div>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#AltaPromosCreditos">
                Añadir nueva promoción <i class="far fa-plus-square"></i>
            </button>
        </div>
    </div>

    <div id="TablePromosCreditos"></div>

    <?php
    include("Modales/AltaPromosCred.php");
    include("Modales/Error.php");
    include("Modales/Exito.php");
    include("Modales/ExitoActualiza.php");
    include("footer.php");
    ?>

    <!-- Scripts -->
    <script src="datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="datatables/JSZip-2.5.0/jszip.min.js"></script>
    <script src="datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script src="datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
    <script src="js/PromosCredito.js"></script>
    <script src="js/AltaProCred.js"></script>
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
