<script type="text/javascript">
$(document).ready( function () {
    $('#SalidaEmpleados').DataTable({
      "order": [[ 0, "desc" ]],
      "lengthMenu": [[10,50, 150, 200, -1], [10,50, 150, 200, "Todos"]],   
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
                title: 'Entradas del personal ',
				className: 'btn btn-success'
			},
			{
				extend:    'pdfHtml5',
				text:      'Exportar a PDF <i class="fas fa-file-pdf"></i> ',
				titleAttr: 'Exportar a PDF',
                title: 'Entradas del personal ',
				className: 'btn btn-danger '
			},
		
        ],
       
   
	   
        	        
    });     
});
   
	  
	 
</script>
<?php

include("db_connection.php");
include "Consultas.php";
include "Sesion.php";

$user_id=null;
//$sql1="SELECT * FROM Reloj_ChecadorV2 WHERE DATE(Fecha_Registro) = DATE_FORMAT(CURDATE(),'%Y-%m-%d')  UNION ALL SELECT * FROM Reloj_ChecadorV2_Salidas WHERE DATE(Fecha_Registro) = DATE_FORMAT(CURDATE(),'%Y-%m-%d') ORDER BY Nombre";
$sql1 = "SELECT
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
    somosgr1_Huellas.personal p
JOIN somosgr1_Huellas.asistenciaper a
    ON a.Id_Pernl = p.Id_pernl
WHERE
    a.FechaAsis = CURDATE()"; 
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="SalidaEmpleados" class="table table-hover">
<thead>
  
    <th>ID</th>
    <th>Nombre completo</th>
    <th>Puesto</th>
    <th>Sucursal</th>
    <th>Fecha de asistencia</th>
    <th>Fecha de corta</th>
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
<?

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