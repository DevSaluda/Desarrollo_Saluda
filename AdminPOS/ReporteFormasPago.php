<?php
// Desarrollo_Saluda/AdminPOS/ReporteFormasPago.php
include "Consultas/Consultas.php";
include "Consultas/FuncionesFormasPago.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Reporte de Formas de Pago - <?php echo $row['ID_H_O_D']?></title>
  <?php include "Header.php"?>
</head>

<?php include_once ("Menu.php")?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Reporte de Formas de Pago</h1>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      
      <!-- Filtros -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Filtros</h3>
        </div>
        <div class="card-body">
          <form method="POST" action="">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Fecha Inicio:</label>
                  <input type="date" name="fechaInicio" class="form-control" 
                         value="<?php echo isset($_POST['fechaInicio']) ? $_POST['fechaInicio'] : date('Y-m-01'); ?>">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Fecha Fin:</label>
                  <input type="date" name="fechaFin" class="form-control" 
                         value="<?php echo isset($_POST['fechaFin']) ? $_POST['fechaFin'] : date('Y-m-d'); ?>">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Sucursal:</label>
                  <select name="sucursal" class="form-control">
                    <option value="">Todas las sucursales</option>
                    <?php
                    $sql = "SELECT * FROM SucursalesCorre ORDER BY Nombre_Sucursal";
                    $result = $conn->query($sql);
                    while ($sucursal = $result->fetch_assoc()) {
                        $selected = (isset($_POST['sucursal']) && $_POST['sucursal'] == $sucursal['ID_SucursalC']) ? 'selected' : '';
                        echo "<option value='{$sucursal['ID_SucursalC']}' $selected>{$sucursal['Nombre_Sucursal']}</option>";
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-search"></i> Generar Reporte
            </button>
          </form>
        </div>
      </div>

      <?php if (isset($_POST['fechaInicio']) && isset($_POST['fechaFin'])): ?>
      
      <!-- Resultados -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Resultados del Reporte</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-success btn-sm" onclick="exportarCSV()">
              <i class="fas fa-file-csv"></i> Exportar CSV
            </button>
          </div>
        </div>
        <div class="card-body">
          
          <?php
          $fechaInicio = $_POST['fechaInicio'];
          $fechaFin = $_POST['fechaFin'];
          $sucursal = !empty($_POST['sucursal']) ? $_POST['sucursal'] : null;
          
          $estadisticas = obtenerEstadisticasFormasPago($fechaInicio, $fechaFin, $sucursal);
          $totalGeneral = array_sum(array_column($estadisticas, 'total'));
          ?>
          
          <!-- Resumen -->
          <div class="row mb-4">
            <div class="col-md-12">
              <div class="alert alert-info">
                <h5><i class="fas fa-info-circle"></i> Resumen del Período</h5>
                <p><strong>Período:</strong> <?php echo date('d/m/Y', strtotime($fechaInicio)) . ' - ' . date('d/m/Y', strtotime($fechaFin)); ?></p>
                <p><strong>Total General:</strong> $<?php echo number_format($totalGeneral, 2); ?></p>
                <p><strong>Total de Transacciones:</strong> <?php echo array_sum(array_column($estadisticas, 'cantidad')); ?></p>
              </div>
            </div>
          </div>
          
          <!-- Tabla de resultados -->
          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Forma de Pago</th>
                  <th>Cantidad de Transacciones</th>
                  <th>Total</th>
                  <th>Porcentaje</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($estadisticas)): ?>
                  <?php foreach ($estadisticas as $forma => $stats): ?>
                    <?php $porcentaje = $totalGeneral > 0 ? ($stats['total'] / $totalGeneral) * 100 : 0; ?>
                    <tr>
                      <td><strong><?php echo $forma; ?></strong></td>
                      <td><?php echo number_format($stats['cantidad']); ?></td>
                      <td>$<?php echo number_format($stats['total'], 2); ?></td>
                      <td>
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" 
                               style="width: <?php echo $porcentaje; ?>%" 
                               aria-valuenow="<?php echo $porcentaje; ?>" 
                               aria-valuemin="0" aria-valuemax="100">
                            <?php echo number_format($porcentaje, 1); ?>%
                          </div>
                        </div>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="4" class="text-center text-muted">No se encontraron datos para el período seleccionado</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
          
          <!-- Gráfico (opcional) -->
          <div class="row mt-4">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Distribución por Formas de Pago</h3>
                </div>
                <div class="card-body">
                  <canvas id="graficoFormasPago" width="400" height="200"></canvas>
                </div>
              </div>
            </div>
          </div>
          
        </div>
      </div>
      
      <?php endif; ?>
      
    </div>
  </section>
</div>

<?php include "footer.php"?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Datos para el gráfico
var datosGrafico = <?php echo json_encode($estadisticas); ?>;
var labels = Object.keys(datosGrafico);
var data = Object.values(datosGrafico).map(item => item.total);

// Crear gráfico
var ctx = document.getElementById('graficoFormasPago').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: labels,
        datasets: [{
            data: data,
            backgroundColor: [
                '#FF6384',
                '#36A2EB',
                '#FFCE56',
                '#4BC0C0',
                '#9966FF',
                '#FF9F40'
            ]
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom',
            }
        }
    }
});

// Función para exportar CSV
function exportarCSV() {
    var datos = <?php echo json_encode($estadisticas); ?>;
    var csv = 'Forma de Pago,Cantidad,Total\n';
    
    for (var forma in datos) {
        csv += forma + ',' + datos[forma].cantidad + ',' + datos[forma].total + '\n';
    }
    
    var blob = new Blob([csv], { type: 'text/csv' });
    var url = window.URL.createObjectURL(blob);
    var a = document.createElement('a');
    a.href = url;
    a.download = 'reporte_formas_pago_<?php echo date('Y-m-d'); ?>.csv';
    a.click();
    window.URL.revokeObjectURL(url);
}
</script>
