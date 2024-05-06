<?php
include "Consultas/Consultas.php";
include "Header.php";
include_once "Menu.php";

function fechaCastellano($fecha) {
    $fecha = substr($fecha, 0, 10);
    $numeroDia = date('d', strtotime($fecha));
    $dia = date('l', strtotime($fecha));
    $mes = date('F', strtotime($fecha));
    $anio = date('Y', strtotime($fecha));
    $dias_ES = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"];
    $dias_EN = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
    $nombredia = str_replace($dias_EN, $dias_ES, $dia);
    $meses_ES = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
    $meses_EN = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
    return "$nombredia $numeroDia de $nombreMes de $anio";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Promociones Credito | <?= $row['ID_H_O_D'] ?></title>
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>
<div class="tab-pane fade show" id="pills-TipPro" role="tabpanel" aria-labelledby="pills-home-tab">
    <div class="card-header">
        Promociones de créditos de <?= $row['ID_H_O_D'] ?> al <?= fechaCastellano(date('d-m-Y H:i:s')); ?>
    </div>
    <div class="button-container">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#AltaPromosCreditos">
            Añadir nueva promoción <i class="far fa-plus-square"></i>
        </button>
    </div>
</div>
<div id="TablePromosCreditos"></div>

<?php
include "Modales/AltaPromosCred.php";
include "Modales/Error.php";
include "Modales/Exito.php";
include "Modales/ExitoActualiza.php";
include "footer.php";
?>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="dist/js/adminlte.js"></script>
<script src="js/PromosCredito.js"></script>
<script src="js/AltaProCred.js"></script>
</body>
</html>
