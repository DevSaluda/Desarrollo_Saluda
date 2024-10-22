<?php
include "Consultas/Consultas.php";


?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Video Tutorial para las devoluciones de  <?echo $row['ID_H_O_D']?> </title>

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



<div class="tab-content" id="pills-tabContent">

<div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
  <div class="card text-center">
 



<video id="videoTutorial" controls autoplay 
>
    <source src="https://saludapos.com/Videotutoriales/Devoluciones.mp4" type="video/mp4">
    Tu navegador no soporta la reproducción de video.
</video>

  </div></div>




    
</div></div>

    
</div></div>    
</div></div>



     
  
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
 
  <!-- Main Footer -->
<?php 
 
  include ("footer.php")?>


<!-- Modal -->
<div class="modal fade" id="registroTutorial" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg modal-notify modal-success" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Registro de visualización del tutorial</h5>
        <button type="button" class="close" disabled aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formRegistroTutorial">
          <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
            <span class="error" id="nombreError"></span>
          </div>
          <div class="form-group">
            <label for="sucursal">Sucursal:</label>
            <input type="text" class="form-control" id="sucursal" name="sucursal" required>
            <span class="error" id="sucursalError"></span>
          </div>
          <input type="hidden" name="tutorial" value="Devoluciones">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="enviarRegistro()">Guardar</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
    var videoElement = document.getElementById('videoTutorial');
    if (videoElement) {
        videoElement.addEventListener('ended', function() {
            $('#registroTutorial').modal('show');
        });
    }
});



  function enviarRegistro() {
    // Obtener valores
    var nombre = document.getElementById('nombre').value;
    var sucursal = document.getElementById('sucursal').value;

    // Validaciones simples
    if (nombre === '') {
        document.getElementById('nombreError').textContent = "El nombre es obligatorio";
        return;
    } else {
        document.getElementById('nombreError').textContent = "";
    }

    if (sucursal === '') {
        document.getElementById('sucursalError').textContent = "La sucursal es obligatoria";
        return;
    } else {
        document.getElementById('sucursalError').textContent = "";
    }

    // Enviar datos por AJAX
    var datos = {
        nombre: nombre,
        sucursal: sucursal,
        tutorial: 'Devoluciones'
    };

    $.ajax({
        url: 'guardar_registro.php',
        type: 'POST',
        data: datos,
        success: function(response) {
            if (response.success) {
                alert('Registro guardado exitosamente');
                $('#registroTutorial').modal('hide');
            } else {
                alert('Error al guardar el registro');
            }
        },
        error: function() {
            alert('Error en la solicitud');
        }
    });
}

</script>
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