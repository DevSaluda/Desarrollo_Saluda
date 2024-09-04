<script type="text/javascript">
$(document).ready( function () {
    $('#StockSucursales').DataTable({
      "order": [[ 0, "desc" ]],
      "lengthMenu": [[50,100,500, -1], [50,100,500, "Todos"]],   
      "language": {
        "url": "Componentes/Spanish.json"
		},
 
 
		
	  } 
	  
	  );
} );
</script>
<?php

include("db_connection.php");
include "Consultas.php";


$user_id=null;
$sql1=" SELECT Incidencias_Express.ID_incidencia,Incidencias_Express.Descripcion,Incidencias_Express.Reporto,
Incidencias_Express.Fecha,Incidencias_Express.Fk_Sucursal,Incidencias_Express.ID_H_O_D, 
SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM SucursalesCorre,Incidencias_Express where 
Incidencias_Express.Fk_Sucursal= SucursalesCorre.ID_SucursalC  AND Incidencias_Express.Fk_Sucursal='".$row['Fk_Sucursal']."' 
AND Incidencias_Express.ID_H_O_D ='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="StockSucursales" class="table table-hover">
<thead>

<th>Folio</th>
    <th>Descripcion</th>
    
    <th>Reporta</th>
    <th>Fecha reporte</th>


</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>



<td > <?php echo $Usuarios['ID_incidencia']; ?></td>
  <td > <?php echo $Usuarios['Descripcion']; ?></td>
  <td > <?php echo $Usuarios['Reporto']; ?> 
  </td>
	<td > <?php echo fechaCastellano($Usuarios['Fecha']); ?></td>
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">Aún no hay incidencias registradas </p>
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