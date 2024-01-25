<?php
include "Consultas/Consultas.php";


?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Estadística de venta del personal de farmacia de  <?php echo $row['ID_H_O_D']?> <?php echo $row['Nombre_Sucursal']?> </title>

<?php include "Header.php"?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js" integrity="sha256-JG6hsuMjFnQ2spWq0UiaDRJBaarzhFbUxiUTxQDA9Lk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js" integrity="sha256-XF29CBwU1MWLaGEnsELogU6Y6rcc5nCkhhx89nFMIDQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js" integrity="sha256-J2sc79NPV/osLcIpzL3K8uJyAD7T5gaEFKlLDM18oxY=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js" integrity="sha256-CfcERD4Ov4+lKbWbYqXD6aFM9M51gN4GUEtDhkWABMo=" crossorigin="anonymous"></script>    
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>

<style>
        .error {
  color: red;
  margin-left: 5px; 
  
}

    </style>
</head>
<?php include_once ("Menu.php")?>
<!--<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#Graficador" role="tab" aria-controls="pills-contact" aria-selected="false" style="color:black !important;" ></a>
  </li>
</ul>-->

<div class="tab-content" id="pills-tabContent">
<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
<div class="card text-center">
  <div class="card-header" style="background-color:#0057b8 !important;color: white;">
  Estadística de venta del personal de farmacia de <?php echo $row['ID_H_O_D']?> al <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?>  
  </div>
 
  <div >
  
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#FiltroFechasEspecificasFarmacias" class="btn btn-default">
  Filtrar por fechas <i class="fas fa-calendar-week"></i>
</button>
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#FiltroFechasEspecificasFarmaciasVendedores" class="btn btn-default">
  Filtrar por vendedor <i class="fas fa-clinic-medical"></i>
</button>
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#FiltroDeServicios" class="btn btn-default">
  Filtrar por servicio <i class="fas fa-calendar-week"></i>
</button>

</div>
</div>
    
<div id="TableVentasDelDia"></div>

</div>


<div class="tab-pane fade " id="Graficador" role="tabpanel" aria-labelledby="pills-home-tab">
<div class="card text-center">
  <div class="card-header" style="background-color:#0057b8 !important;color: white;">
  Estadística de venta del personal de farmacia de <?php echo $row['ID_H_O_D']?> al <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?>  
  </div>
 
  <div >
  
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#FiltroFechasEspecificasFarmacias" class="btn btn-default">
  Filtrar por fechas <i class="fas fa-calendar-week"></i>
</button>
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#FiltroFechasEspecificasFarmaciasVendedores" class="btn btn-default">
  Filtrar por vendedor <i class="fas fa-clinic-medical"></i>
</button>


</div>
</div>
    
 
 
 
       <canvas width="600" height="300"  id="miGrafico"></canvas> 
              
   
</div>
 


</div>
</div>
</div>
</div>




<script>
   
$(document).ready(function() {
  $.ajax({
        url: "https://saludapos.com/AdminPOS/Consultas/DatosGraficaVespertino.php",
        dataType: 'json',
        contentType: "application/json; charset=utf-8",
        method: "POST",
        success: function(data) {
           
          
        
            var AgregadoPor = [];
            var TotalGeneradoo = [];
            console.log(data);
 
            for (var i in data) {
             
              
                AgregadoPor.push(data[i].AgregadoPor);
                TotalGeneradoo.push(data[i].TotalGenerado);
            }
 
    $.ajax({
        url: "https://saludapos.com/AdminPOS/Consultas/DatosGrafica.php",
        dataType: 'json',
        contentType: "application/json; charset=utf-8",
        method: "POST",
        success: function(data) {
            
            var Nombre_Sucursal = [];
            var AgregadoPor = [];
            var TotalGenerado = [];
           console.log(data);
 
            for (var i in data) {
               
                Nombre_Sucursal.push(data[i].Nombre_Sucursal);
                AgregadoPor.push(data[i].AgregadoPor);
                TotalGenerado.push(data[i].TotalGenerado);
            }

        
            $.ajax({
        url: "https://saludapos.com/AdminPOS/Consultas/DatosGraficaNocturno.php",
        dataType: 'json',
        contentType: "application/json; charset=utf-8",
        method: "POST",
        success: function(data) {
           
           
            var AgregadoPor = [];
            var TotalGeneradooo = [];
            console.log(data);
 
            for (var i in data) {
                
               
                AgregadoPor.push(data[i].AgregadoPor);
                TotalGeneradooo.push(data[i].TotalGenerado);
            }


            
            const $grafica = document.querySelector("#miGrafico");
// Las etiquetas son las que van en el eje X. 
const etiquetas = Nombre_Sucursal
// Podemos tener varios conjuntos de datos

const datosVentas2018 = {
    label: "Ventas del turno matutino",
    data: TotalGenerado, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
    backgroundColor: 'rgba(211,93,110, 0.2)',// Color de fondo
    borderColor: 'rgba(211,93,110, 1)',// Color del borde
    borderWidth: 1,// Ancho del borde
};
const datosVentas2019 = {
    label: "Ventas del turno vespertino",
    data: TotalGeneradoo, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
    backgroundColor: 'rgba(255,255,102,0.5)',// Color de fondo
    borderColor: 'rgba(209,234,163,1)',// Color del borde
    borderWidth: 1,// Ancho del borde
};
const datosVentas2020 = {
    label: "Ventas del turno nocturno",
    data: TotalGeneradooo, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
    backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo
    borderColor: 'rgba(54, 162, 235, 1)', // Color del borde
    borderWidth: 1,// Ancho del borde
};


new Chart($grafica, {
    type: 'line',// Tipo de gráfica
    data: {
        labels: etiquetas,
        datasets: [
            datosVentas2018,
            datosVentas2019,
            datosVentas2020,
           
            // Aquí más datos...
        ]
    },
    options: {
      responsive: true,
      plugins: [ ChartDataLabels ],
      dataLabel: { visible: true },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }],
        },
    }
});

          
 
          
        
        },
        error: function(data) {
            console.log(data);
        }
        
      });
    
    }
});
        }
});});
</script> 
   
  
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
 
  <!-- Main Footer -->
<?php

  include ("Modales/Error.php");
  include ("Modales/Exito.php");
  include ("Modales/ExitoActualiza.php");
  include ("Modales/ModalesFiltroEstadisticas.php");
include ("footer.php")?>

<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<script src="js/ControlEstadisticaVentasPersonalFarmacia.js"></script>

<script src="js/ObtieneVendedorDeFarmacia.js"></script>
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