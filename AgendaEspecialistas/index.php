
<?php
session_start();
if (!isset($_SESSION['AgendaEspecialista'])) {
    header('Location: ../login.php');
    exit();
}
$especialista_id = $_SESSION['AgendaEspecialista'];
include_once '../App/Secure/db_connect.php';
// Obtener datos del especialista
$sql_user = "SELECT Nombre_Apellidos FROM Personal_Agenda WHERE PersonalAgenda_ID = '$especialista_id'";
$result_user = mysqli_query($conn, $sql_user);
$row_user = mysqli_fetch_assoc($result_user);
$nombre_especialista = $row_user ? $row_user['Nombre_Apellidos'] : '';
// Obtener citas del especialista
$sql_citas = "SELECT * FROM AgendaCitas_Especialistas WHERE Fk_Especialista = '$especialista_id' ORDER BY Fk_Fecha DESC, Fk_Hora DESC";
$result_citas = mysqli_query($conn, $sql_citas);

 include "Consultas/Consultas.php";
include "Consultas/ConsultaEstadoConexion.php";
include "Consultas/Mensaje.php";

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>AGENDA DE CITAS |  </title>

  <!-- Font Awesome Icons -->
  <?php include "Header.php"?>

</head>
<div id="loading-overlay">
  <div class="loader"></div>
  <div id="loading-text" style="color: white; margin-top: 10px; font-size: 18px;"></div>
</div>
<?php include_once ("Menu.php")?>



<div class="container">
    <div class="card">
        <div class="card-header bg-primary text-white">
            Bienvenido, <?php echo htmlspecialchars($nombre_especialista); ?>
        </div>
        <div class="card-body">
            <h5 class="card-title">Tus citas</h5>
            <div class="table-responsive">
                <table class="table table-striped" id="tabla-citas">
                    <thead class="thead-dark">
                        <tr>
                            <th>Paciente</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Tipo Consulta</th>
                            <th>Estatus</th>
                            <th>Observaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($cita = mysqli_fetch_assoc($result_citas)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($cita['Nombre_Paciente']); ?></td>
                            <td><?php echo htmlspecialchars($cita['Fk_Fecha']); ?></td>
                            <td><?php echo htmlspecialchars($cita['Fk_Hora']); ?></td>
                            <td><?php echo htmlspecialchars($cita['Tipo_Consulta']); ?></td>
                            <td><?php echo htmlspecialchars($cita['Estatus_cita']); ?></td>
                            <td><?php echo htmlspecialchars($cita['Observaciones']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="Componentes/jquery-3.5.1.slim.min.js"></script>
<script src="Componentes/bootstrap.min.js"></script>
<script src="Componentes/datatables.min.js"></script>
<script>
    $(document).ready(function(){
        $('#tabla-citas').DataTable({
            "language": {
                "url": "Componentes/Spanish.json"
            }
        });
    });
</script>

<!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
 
  <!-- Main Footer -->
  <?php include ("Modales/Ingreso.php");
   include ("Modales/Error.php");
   include ("Modales/Eliminar.php");

 include ("footer.php");?>
<!-- ./wrapper -->

<script src="js/ControlCampanasDiasExtV2.js"></script>
<script src="js/Logs.js"></script>
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->

<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<script src="datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>  
    <script src="datatables/JSZip-2.5.0/jszip.min.js"></script>    
    <script src="datatables/pdfmake-0.1.36/pdfmake.min.js"></script>    
    <script src="datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
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
<?php
if($EstadoIngreso["Estado_Conexion"] == 1){

    
}else{

 echo '
 <script>
$(document).ready(function()
{
// id de nuestro modal

$("#Ingreso").modal("show");
});
</script>
 ';
 
 

}
?>