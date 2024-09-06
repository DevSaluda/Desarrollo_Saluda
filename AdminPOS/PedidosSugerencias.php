<?php
include "Consultas/Consultas.php";

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Sugerencias de pedidos  <?php echo $row['ID_H_O_D']?> <?php echo $row['Nombre_Sucursal']?> </title>

<?php include "Header.php"?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
   Devoluciones de productos <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?>  
  </div>
 
  <div >
  <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#FiltroEspecifico" class="btn btn-default">
  Filtrar por sucursal <i class="fas fa-clinic-medical"></i>
</button>
<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#FiltroEspecificoMesxd" class="btn btn-default">
  Busqueda por mes <i class="fas fa-calendar-week"></i>
</button>

<button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#FiltroEspecificoFechaVentas" class="btn btn-default">
  Filtrar por rango de fechas <i class="fas fa-calendar"></i>
</button>
</div>
</div>
    
<div id="TableVentasDelDia"></div>

</div>

<!-- PRESENTACIONES -->

<!-- POR CADUCAR -->
  
 

    
</div></div>





     
  
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
 
  <!-- Main Footer -->
<?php

  include ("Modales/FiltraPorMes.php");
  include ("Modales/FiltroPorProducto.php");
  include ("Modales/FiltroPorFechasBusqueda.php");
include ("footer.php")?>

<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<script src="js/SugerenciaPedidos.js"></script>
<?php include "datatables.php"?>

<script>
  	
    $(document).ready(function() {
    // Delegación de eventos para el botón ".btn-ActualizarCaducado" dentro de .dropdown-menu
    $(document).on("click", ".btn-CreaPedido", function() {
        var id = $(this).data("id"); // Obtiene el valor del atributo data-id
        var sucursal = $(this).data("sucursal"); // Obtiene el valor del atributo data-sucursal

        // Enviar los datos a través de una solicitud POST
        $.post("https://saludapos.com/AdminPOS/Modales/ConfirmaGeneracionPedido.php", 
            { id: id, sucursal: sucursal }, // Envía ambos datos
            function(data) {
                $("#form-edit").html(data);
                $("#Titulo").html("Registrando como caducados");
                $("#Di").removeClass("modal-dialog modal-notify modal-info");
                $("#Di").addClass("modal-dialog  modal-notify modal-warning");
            }
        );

        $('#editModal').modal('show');
    });



    // Delegación de eventos para el botón ".btn-edit" dentro de .dropdown-menu
    $(document).on("click", ".btn-GeneraIngreso", function() {
    
    var id = $(this).data("id");
    $.post("https://saludapos.com/AdminPOS/Modales/ActualizaComoIngreso.php", { id: id }, function(data) {
        $("#form-edit").html(data);
        $("#Titulo").html("Generando ingreso a cedis");
        $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-info");
        $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-warning");
        $("#Di").addClass("modal-dialog modal-xl modal-notify modal-primary");
    });
    $('#editModal').modal('show');
});
    $(document).on("click", ".btn-GeneraRotacion", function() {
    console.log("Botón de edición clickeado");
        var id = $(this).data("id");
        $.post("https://saludapos.com/AdminPOS/Modales/RealizaRotacionMedicamentos.php", { id: id }, function(data) {
            $("#form-edit").html(data);
            $("#Titulo").html("Generando traspaso");
            $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-info");
            $("#Di").removeClass("modal-dialog .modal-xl modal-notify modal-success");
            $("#Di").addClass("modal-dialog modal-lg modal-notify modal-warning");
        });
        $('#editModal').modal('show');
    });
});

</script>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalLabel" aria-hidden="true">
  <div id="Di"class="modal-dialog  modal-notify modal-warning">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="Titulo"></p>

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

<!-- PAGE PLUGINS -->

</body><script>const openModalBtn = document.getElementById("openModalBtn");
const closeModalBtn = document.getElementById("closeModalBtn");
const modal = document.getElementById("modal");

openModalBtn.addEventListener("click", () => {
    modal.style.display = "block";
});

closeModalBtn.addEventListener("click", () => {
    modal.style.display = "none";
});

window.addEventListener("click", (event) => {
    if (event.target === modal) {
        modal.style.display = "none";
    }
});
</script>
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