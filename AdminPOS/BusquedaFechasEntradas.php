<?php

include "Consultas/db_connection_Huellas.php";
include "Consultas/Consultas.php";

$fecha1=($_POST['Fecha1']);
$fecha2=($_POST['Fecha2']);

$sql2 = "SELECT
              p.Id_pernl AS Id_Pernl,
              p.Cedula AS Cedula,
              p.Nombre_Completo AS Nombre_Completo,
              p.Sexo AS Sexo,
              p.Cargo_rol AS Cargo_rol,
              p.Domicilio AS Domicilio,
              a.Id_asis AS Id_asis,
              a.FechaAsis AS FechaAsis,
              a.Nombre_dia AS Nombre_dia,
              a.HoIngreso AS HoIngreso,
              a.HoSalida AS HoSalida,
              a.Tardanzas AS Tardanzas,
              a.Justifacion AS Justifacion,
              a.tipoturno AS tipoturno,
              a.EstadoAsis AS EstadoAsis,
              a.totalhora_tr AS totalhora_tr
          FROM
              u155356178_SaludaHuellas.personal p
          JOIN u155356178_SaludaHuellas.asistenciaper a
          ON
              a.Id_Pernl = p.Id_pernl
          WHERE
              a.FechaAsis BETWEEN '$fecha1' AND '$fecha2'";
//$sql1="SELECT * FROM Reloj_ChecadorV2 WHERE DATE_FORMAT(Fecha_Registro,'%Y-%m-%d') BETWEEN '$fecha1' AND '$fecha2' UNION ALL SELECT * FROM Reloj_ChecadorV2_Salidas WHERE DATE_FORMAT(Fecha_Registro,'%Y-%m-%d') BETWEEN '$fecha1' AND '$fecha2' ORDER BY Nombre";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Registro de entradas</title>

<?php include "Header.php"?>
 <style>
        .error {
  color: red;
  margin-left: 5px; 
  
}

    </style>
</head>
<?php include_once ("Menu.php")?>

<div class="card text-center">
  <div class="card-header" style="background-color:#2b73bb !important;color: white;">
  Registro de entradas del <?php echo fechaCastellano($fecha1)?> al <?php echo fechaCastellano($fecha2)?>
  </div>
  <div >
  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#FiltroEspecificoFecha" class="btn btn-default">
  Filtrar por fechas <i class="fas fa-calendar-week"></i>
</button>
</div>
 
</div>
    
<script type="text/javascript">
$(document).ready( function () {
    var printCounter = 0;
    $('#RegistroEntradasPorFechas').DataTable({
      "order": [[ 0, "desc" ]],
      "lengthMenu": [[20,50, 150, 200, -1], [20,50, 150, 200, "Todos"]],   
        language: {
            "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
			     },
			     "sProcessing":"Procesando...",
            },
          
         //para usar los botones   
         responsive: "true",
          dom: "B<'#colvis row'><'row'><'row'<'col-md-6'l><'col-md-6'f>r>t<'bottom'ip><'clear'>'",
        buttons:[ 
			{
				extend:    'excelHtml5',
				text:      'Exportar a Excel  <i Exportar a Excel class="fas fa-file-excel"></i> ',
				titleAttr: 'Exportar a Excel',
                title: 'Registro de entradas y salidas del personal del  <?php echo $fecha1?> al <?php echo $fecha2?> ',
				className: 'btn btn-success'
			},
			
		
        ],
       
   
	   
        	        
    });     
});
   
	 
</script>
<?php


$user_id=null;

$query = $conn->query($sql2);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="RegistroEntradasPorFechas" class="table table-hover">
<thead>
  
    <th>ID</th>
    <th>Nombre completo</th>
    <th>Puesto</th>
    <th>Sucursal</th>
    <th>Fecha de asistencia</th>
    <th>Fecha corta</th>
    <th>Hora de entrada</th>
    <th>Hora de salida</th>
    <th>Estado</th>
    <th>Horas trabajadas</th>
	


</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>
  <td><?php echo $Usuarios["Id_asis"]; ?></td>
  <td><?php echo $Usuarios["Nombre_Completo"]; ?></td>
  <td><?php echo $Usuarios["Cargo_rol"]; ?></td>
  <td><?php echo $Usuarios["Domicilio"]; ?></td>
  <td><?php echo FechaCastellano($Usuarios["FechaAsis"]); ?></td>
  <td><?php echo $Usuarios["FechaAsis"]; ?></td>
  <td><?php echo $Usuarios["HoIngreso"]; ?></td>
  <td><?php echo $Usuarios["HoSalida"]; ?></td>
  <td><?php echo $Usuarios["EstadoAsis"]; ?></td>
  <td><?php echo convertirDecimalAHoraMinutosSegundos($Usuarios["totalhora_tr"]); ?></td>
		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">No hay resultados</p>
<?php endif;?>

<?php
 
  include ("Modales/BuscaPorFechaVentas.php");
  include ("Modales/FiltraEspecificamenteEntradas.php");
  
  include ("footer.php")?>

<!-- ./wrapper -->




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

function convertirDecimalAHoraMinutosSegundos($decimalHoras) {
  $horas = floor($decimalHoras);  // Parte entera: horas
  $minutosDecimal = ($decimalHoras - $horas) * 60;  // Decimal a minutos
  $minutos = floor($minutosDecimal);  // Parte entera: minutos
  $segundosDecimal = ($minutosDecimal - $minutos) * 60;  // Decimal a segundos
  $segundos = round($segundosDecimal);  // Redondear a segundos

  return sprintf("%02d:%02d:%02d", $horas, $minutos, $segundos);  // Formatear como HH:MM:SS
}

?>