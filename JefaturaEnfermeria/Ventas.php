<?php
include "Consultas/Consultas.php";

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Ventas realizadas por  <?php echo $row['ID_H_O_D']?> <?php echo $row['Nombre_Sucursal']?> </title>

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
   Registro de ventas de Saluda al <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?>  
  </div>
 
  <div >
  <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#FiltroEspecifico" class="btn btn-default">
  Filtrar por sucursal <i class="fas fa-clinic-medical"></i>
</button>
<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#FiltroEspecificoMesxd" class="btn btn-default">
  Busqueda por mes <i class="fas fa-calendar-week"></i>
</button>
<button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#FiltroPorProducto" class="btn btn-default">
  Filtrar por producto <i class="fas fa-prescription-bottle"></i>
</button>
<button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#FiltraPorFormasDePago" class="btn btn-default">
  Filtrar por forma de pago <i class="fas fa-prescription-bottle"></i>
</button>
<button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#" class="btn btn-default">
  Filtrar por rango de fechas <i class="fas fa-prescription-bottle"></i>
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

  include ("Modales/Error.php");
  include ("Modales/Exito.php");
  include ("Modales/ExitoActualiza.php");
  include ("Modales/FiltraEspecificamente.php");
  include ("Modales/FiltraFechasEspecialesVenta.php");
  include ("Modales/FiltraPorMes.php");
  include ("Modales/FiltroPorProducto.php");
  include ("Modales/FiltroPorFormaDePago.php");
include ("footer.php")?>

<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<script src="js/ControlVentas.js"></script>

<script src="js/RealizaCambioDeSucursalPorFiltro.js"></script>
<script src="datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>  
    <script src="datatables/JSZip-2.5.0/jszip.min.js"></script>    
    <script src="datatables/pdfmake-0.1.36/pdfmake.min.js"></script>    
    <script src="datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>

   <script>
    $(document).ready(function() {
    // Inicializar Select2
    $('#buscador').select2({
        ajax: {
            url: 'Consultas/BuscarProductosParaFiltro.php',
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                return {
                    results: data
                };
            },
            cache: true
        },
        placeholder: 'Ingrese un código o nombre',
        minimumInputLength: 1,
        // Al seleccionar un resultado, asignar el nombre del producto y el código de barras a los inputs correspondientes
        select: function(event) {
            var nombreProd = event.params.data.id; // Accedemos al nombre del producto
            var codBarra = event.params.data.cod_barra; // Accedemos al código de barras
            $('#nombreprod').val(nombreProd);
            $('#codbarra').val(codBarra);
        }
    });
});

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