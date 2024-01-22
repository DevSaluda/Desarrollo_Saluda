<script type="text/javascript">
$(document).ready( function () {
    $('#SignosVitales').DataTable({
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
$sql1="SELECT Signos_VitalesV2.Motivo_Consulta, count(*) as totalmotivosoncu,Signos_VitalesV2.Fecha_Visita, 
Signos_VitalesV2.Fk_Sucursal,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM SucursalesCorre,Signos_VitalesV2 WHERE 
Signos_VitalesV2.Fk_Sucursal= SucursalesCorre.ID_SucursalC AND DATE(Signos_VitalesV2.Fecha_Visita) = DATE_FORMAT(CURDATE(),'%Y-%m-%d') GROUP by Signos_VitalesV2.Motivo_Consulta";  
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="SalidaEmpleados" class="table table-hover">
<thead>
  
    <th>Usuario</th>
    <th>Fecha</th>
    <th>Hora</th>
    <th>Sucursal</th>
    <th>Área</th>
    <th>Retardo/ Correcto</th>
	


</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>
  <td > <?php echo $Usuarios["Nombre"]; ?></td>
  <td><?php echo FechaCastellano($Usuarios["Fecha_Registro"]); ?></td>
    <td><?php echo date('h:i A', strtotime(($Usuarios["Hora_Registro"]))); ?></td>
    <td><?php echo $Usuarios["Sucursal"]; ?></td>
    <td><?php echo $Usuarios["Area"]; ?></td>
    <td><?if(date('h:i A', strtotime(($Usuarios["Hora_Registro"])))== "7:10"){
   echo "Retardo";
} else {
   echo "Entrada Correcta";
}
?></td>
		
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
?>