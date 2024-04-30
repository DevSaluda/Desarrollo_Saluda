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
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<!-- Chart.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
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
        var chartsContainer = $('#chartsContainer');
        // Recorrer los datos por sucursal
        $.each(data, function(sucursal, servicios) {
            // Crear un nuevo contenedor de tarjeta Bootstrap para la sucursal
            var sucursalContainer = $('<div class="col-md-12 mb-4"><div class="card"><div class="card-header"><h5 class="card-title">' + sucursal + '</h5></div><div class="card-body row"></div></div></div>');
            chartsContainer.append(sucursalContainer);

            // Recorrer los datos de servicio para la sucursal actual
            $.each(servicios, function(servicio, total_vendido) {
                // Crear un nuevo contenedor para el gráfico del servicio
                var chartContainer = $('<div class="col-md-6"><div class="card"><div class="card-body"><canvas class="salesChart" height="180"></canvas></div></div></div>');
                sucursalContainer.find('.card-body').append(chartContainer);

                // Obtener el contexto del lienzo del gráfico
                var salesChartCanvas = chartContainer.find('.salesChart').get(0).getContext('2d');

                // Crear el gráfico para este servicio
                var salesChart = new Chart(salesChartCanvas, {
                    type: 'bar',
                    data: {
                        labels: [servicio],
                        datasets: [{
                            label: 'Sales',
                            data: [total_vendido],
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
            });
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
<?php include_once "footer.php";?>