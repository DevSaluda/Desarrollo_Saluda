<script type="text/javascript">
$(document).ready( function () {
    $('#LogsSistemas').DataTable({
      "order": [[ 0, "desc" ]],
      "language": {
        "url": "Componentes/Spanish.json"
		}
		
	  } 
	  
	  );
} );
</script>
<?php

include("db_connection.php");
include "Consultas.php";
include "Sesion.php";

$user_id=null;
$sql1="SELECT  * FROM `Logs_Sistema`" ;  
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  
	<div class="table-responsive">
    
	<table id="LogsSistemas" class="table ">
<thead>
<th>Usuario </th>
    
    <th>Tipo ingreso</th>
    <th>Sistema</th>
    <th>Fecha </th>
    <th>Hora </th>
   
	
	


</thead>
<?php while ($DataPacientes=$query->fetch_array()):?>
<tr>
<td><?php echo $DataPacientes["Usuario"]; ?></td>
    <td><?php echo $DataPacientes["Tipo_log"]; ?></td>
    <td><?php echo $DataPacientes["Sistema"]; ?></td>
    <td><?php echo FechaCastellano($DataPacientes["Fecha_hora"]); ?></td>
   
    <td><?php echo $DataPacientes["Fecha_hora"]; ?></td>
 

	
		
</tr>
<?php endwhile;?>
</table>
</div>
<?php else:?>
	<p class="alert alert-warning">Aún no existen registros</p>
<?php endif;?>
  <!-- Modal -->
  
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
?>