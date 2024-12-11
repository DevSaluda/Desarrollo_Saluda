<?php
include_once 'db_connection.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Registro de Tickets Realizados</title>

  <!-- Estilos CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

  <style>
    .error {
      color: red;
      margin-left: 5px;
    }
    table td {
      word-wrap: break-word;
      max-width: 400px;
    }
  </style>
</head>
<body>
  <div class="wrapper">
    <div class="card text-center">
      <div class="card-header" style="background-color:#2bbbad !important;color: white;">
        Registro de Tickets al día <?php echo fechaCastellano(date('d-m-Y H:i:s')); ?>
      </div>
      <div>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#RegistroTicketSoporteModal">
          Registrar Tickets de Soporte <i class="fas fa-lightbulb"></i>
        </button>
      </div>
    </div>
    <div class="col-md-12">
      <div id="RegistrosTicketSoporteTabla"></div>
    </div>
  </div>

  <?php
    include("Modales/RegistroTicketSoporteModal.php");
    include("Modales/Error.php");
    include("Modales/Exito.php");
  ?>

  <!-- Scripts JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="dist/js/adminlte.js"></script>
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

  <script src="js/ControlTicketsSoporte.js"></script>
  <script src="js/GuardaTicketSoporte.js"></script>
</body>
</html>
