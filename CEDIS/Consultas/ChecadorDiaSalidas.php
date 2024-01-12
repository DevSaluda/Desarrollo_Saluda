<script type="text/javascript">
$(document).ready( function () {
    $('#SalidasDias').DataTable({
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
$sql1="SELECT * FROM `Reloj_Checador` Where Tipo_Registro='Salida'  AND DATE(Fecha_Registro) = DATE_FORMAT(CURDATE(),'%Y-%m-%d')";  
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  
	<div class="table-responsive">
    
	<table id="SalidasDias" class="table ">
<thead>
<th>Numero Empleado </th>
<th>Nombre</th>
    <th>Sucursal</th>
    <th>Area</th>
    <th>Hora </th>
    
   
	
	


</thead>
<?php while ($DataPacientes=$query->fetch_array()):?>
<tr>
<td><?php echo $DataPacientes["Number_Empleado"]; ?></td>
    <td><?php echo $DataPacientes["Nombre"]; ?></td>
   
    <td><?php echo $DataPacientes["Sucursal"]; ?></td>
    <td><?php echo $DataPacientes["Area"]; ?></td>
    <td><?php echo date('h:i A',strtotime($DataPacientes["Hora_Registro"])); ?></td>
   
 

	
		
</tr>
<?php endwhile;?>
</table>
</div>
<?php else:?>
	<p class="alert alert-warning">Por el momento aún no existen registros</p>
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