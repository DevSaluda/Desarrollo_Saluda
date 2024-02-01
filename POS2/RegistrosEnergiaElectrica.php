<?php
include "Consultas/Consultas.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Registro de uso de energia electrica</title>

<?php include "Header.php"?>
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
<?php include_once ("Menu.php")?>



  <div class="card text-center">
  <div class="card-header" style="background-color:#2bbbad !important;color: white;">
  Registro diario de uso de energia electrica al <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?>  
  </div>
 
  <div >
  <button type="button"  class="btn btn-success" data-toggle="modal" data-target="#RegistroEnergiaVentanaModal" class="btn btn-default">
 Registrar informacion de energia electrica <i class="fas fa-lightbulb"></i>
</button>

</div>
  <div >
 
</div>

</div><div class="col-md-12">
<div id="RegistrosEnergiatabla"></div>
  </div></div>
<!-- POR CADUCAR -->
  



   <!-- Modal de Mantenimiento -->
<div class="modal-dialog modal-notify modal-primary" role="document">
    <div class="modal fade" id="modalavisoterminado" tabindex="-1" role="dialog" aria-labelledby="modalMantenimientoLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalMantenimientoLabel" style="color:white;">!Aviso! 🚨🔧</h5>
                </div>
                <div class="modal-body">
                    <!-- Cambiado el mensaje de mantenimiento -->
                    <p>Hola, <?php echo $row['Nombre_Apellidos']?>. Te informamos que el registro diario de energía eléctrica ya se encuentra disponible de nuevo. 🎉🔌⚡️</p>

                    <!-- Botón para redirigir -->
                    <img src="hey.jpg" alt="" style="width: 100%; max-width: 300px; height: auto; display: block; margin: 0 auto;">
                    <p>¡Nuestros programadores han trabajado para solucionar cualquier problema! 🚀</p>
                    <br>
                    <p>¡Gracias por tu paciencia!</p> 
                    <p><strong>Recuerda que cualquier problema que se presente puedes reportarlo en tu grupo o con soporte. 🤔💬</strong></p>

                    <!-- Botón para confirmar que no desea ver el modal durante un tiempo -->
                    <button type="button" id="confirmarNoMostrar" class="btn btn-secondary">No mostrar por 5 horas</button>
                    
                    <button type="button" class="btn btn-primary" onclick="redirigirEnergiaElectria()">ir al registro de energía eléctrica</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Agrega este script al final de tu página justo antes de cerrar el cuerpo (</body>) -->
<script>
    // Espera a que el documento esté completamente cargado
    document.addEventListener("DOMContentLoaded", function() {
        // Muestra el modal al cargar la página
        $('#modalavisoterminado').modal('show');

        // Agrega un listener al botón de confirmación
        document.getElementById('confirmarNoMostrar').addEventListener('click', function() {
            // Cierra el modal
            $('#modalavisoterminado').modal('hide');

            // Establece una cookie o utiliza localStorage para recordar la decisión del usuario
            // Puedes implementar esto para que el modal no aparezca durante las próximas 5 horas
            // Aquí hay un ejemplo utilizando localStorage:
            localStorage.setItem('ocultarModal', 'true');

            // O puedes usar cookies, dependiendo de tus necesidades
            // document.cookie = "ocultarModal=true; expires=" + new Date(new Date().getTime() + 5 * 60 * 60 * 1000).toUTCString();
        });

        // Verifica si el usuario ya confirmó que no desea ver el modal
        if (localStorage.getItem('ocultarModal') === 'true') {
            $('#modalavisoterminado').modal('hide');
        }
    });
</script>

  
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
 
  <!-- Main Footer -->
<?php
  include ("Modales/RegistroEnergiaModal.php");
  include ("Modales/Error.php");
  include ("Modales/Exito.php");
  include ("footer.php")?>

<!-- ./wrapper -->


<script src="js/ControlEnergiaElectrico.js"></script>
<script src="js/GuardaDatosEnergia.js"></script>
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