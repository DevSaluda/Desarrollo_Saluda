<?php


  include "Consultas/Consultas.php";
  include "Consultas/ContadorIndex.php";

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>INICIO <?php echo $row['ID_H_O_D']?>  </title>

  <!-- Font Awesome Icons -->
  <?php include "Header.php"?>
</head>
<?php include_once ("Menu.php")?>

<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">CPU Traffic</span>
                <span class="info-box-number">
                  10
                  <small>%</small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Likes</span>
                <span class="info-box-number">41,410</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Sales</span>
                <span class="info-box-number">760</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">New Members</span>
                <span class="info-box-number">2,000</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
      
      
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
              <h5 class="card-title">Ventas del día</h5>
                </div>
                <!-- /.card-header -->
                <div id="chartsContainer" class="row"></div>
        </div>
    </div>
</div>
</div>
</div>

<!-- Chart.js -->

<script>
$(document).ready(function() {
    // Función para obtener los datos de venta del día en curso mediante AJAX
    function getSalesData() {
        $.ajax({
            url: 'Consultas/EstadisticaEntrada.php', // URL de tu backend que maneja la consulta SQL y devuelve los datos en formato JSON
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                renderCharts(response);
            },
            error: function(xhr, status, error) {
                console.error('Error al obtener datos de ventas:', error);
            }
        });
    }

    // Función para renderizar los gráficos de ventas por sucursal y servicio
    function renderCharts(data) {
        // Crear un nuevo contenedor para los gráficos
        var chartsContainer = $('#chartsContainer');

        // Crear un nuevo canvas para el gráfico
        var canvas = $('<canvas id="salesChart" height="400"></canvas>');
        chartsContainer.append(canvas);

        // Obtener el contexto del lienzo del gráfico
        var salesChartCanvas = document.getElementById('salesChart').getContext('2d');

        // Crear un array para almacenar los datos de etiquetas y datos
        var labels = [];
        var dataValues = [];

        // Recorrer los datos para cada sucursal
        $.each(data, function(sucursal, servicios) {
            // Recorrer los datos de servicio para la sucursal actual
            $.each(servicios, function(servicio, total_vendido) {
                // Agregar los datos de etiquetas y valores
                labels.push(sucursal + ' - ' + servicio);
                dataValues.push(total_vendido);
            });
        });

        // Crear el gráfico utilizando Chart.js
        var salesChart = new Chart(salesChartCanvas, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Vendido',
                    data: dataValues,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    // Llamar a la función para obtener los datos de venta del día en curso
    getSalesData();
});
</script>
      </section>
      <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="dist/js/demo.js"></script>

<?php include_once "footer.php";?>