<?php
include "Consultas/Consultas.php";
include "Consultas/Sesion.php";
include "Consultas/Conexion_selects.php";
include "Consultas/ConeSelectDinamico.php";

function fechaCastellano($fecha) {
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
    return $nombredia . " " . $numeroDia . " de " . $nombreMes . " de " . $anio;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Agendamiento de citas laboratorios</title>
    <? include "Header.php"?>
    <link href='js/fullcalendar/fullcalendar.css' rel='stylesheet' />
</head>

<body>
    <? include_once ("Menu.php")?>
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active " id="pills-home-tab" data-toggle="pill" href="#CrediClinicas" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fas fa-vials"></i>Laboratorios</a>
      </li>
  </ul>
    
  <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
        <div class="card text-center">
            <div class="card-header" style="background-color: #2bbbad !important; color: white;">
                Laboratorios
            </div>
        </div>
    </div>
    <div class="tab-pane fade show active" id="CrediClinicas" role="tabpanel" aria-labelledby="pills-home-tab">
        <div class="card text-center">
            <div class="card-header" style="background-color: #0057b8 !important; color: white;">
                Laboratorios agendados
            </div>

            <div>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#CitaExt" class="btn btn-default">
                    Agendar nueva cita para laboratorio <i class="fas fa-file-medical"></i>
                </button>
            </div>
        </div>

        <div id="CargaCitasLabs"></div>
        
    </div>
</div>
<!-- <script type="text/javascript">
    $(function() {
        $(document).ready(function() {
            var maxGroup = 600;
            var id = 0;

            $(".addMore").click(function() {
                id = id + 1;
                if ($('body').find('.form-group').length <= maxGroup) {
                    var fieldHTML = '<div class="form-group fieldGroup selector-' + id + '">' + $(".fieldGroupCopy").html() + '</div>';
                    $('body').find('.fieldGroupCopy:last').before(fieldHTML);
                } else {
                    alert('Maximo ' + maxGroup + ' personas, mayor a esto realize cargue masivo.');
                }

                $(".selector-" + id + " #codbarra").focus();
                $(".selector-" + id + " #codbarra").autocomplete({
                    source: "Consultas/BusquedaLabs.php",
                    minLength: 2,
                    select: function(event, ui) {
                        event.preventDefault();
                        $('.selector-' + id + ' #codbarra').val(ui.item.codbarra);
                        $('.selector-' + id + ' #nombres').val(ui.item.nombres);
                        $('.selector-' + id + ' #precioventa').val(ui.item.precioventa);
                        // $('#ajustador').trigger('click');
                        $('#agregarmasproductos').trigger('click');
                    }
                });
            });

            //remover
            $("body").on("click", ".remove", function() {
                $(this).parents(".fieldGroup").remove();
            });
        });
    });
</script> -->

    <?php
    include ("footer.php");
    include ("Modales/Error.php");
    include ("Modales/Exito.php");
    include ("Modales/Precarga.php");
    include ("Modales/ExitoActualiza.php");
    include ("Modales/EstatusAgendaGuardado.php");
    include ("Modales/AgendarCitaLab.php");
    include ("Modales/AltaEspecialista.php");
    ?>
    
    <script src="js/BuscaDataPacientes.js"></script>
    <script src="js/BuscaDataPacientesExt.js"></script>
    <script src="js/BuscarDataLab.js"></script>
    <!-- <script src="js/RevaloracionesControlLab.js"></script>
    <script src="js/AgendarevaloracionesLab.js"></script> -->
    <script src="js/AgendaLaboratorios.js"></script>
    <script src="js/LaboratoriosControl.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="dist/js/adminlte.js"></script>
    <script src="dist/js/demo.js"></script>

  </body>
</html>