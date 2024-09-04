<script type="text/javascript">
$(document).ready( function () {
    $('#ProductosPorVencer').DataTable({
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
$sql1="SELECT Folio_Prod_Stock,Clave_adicional,Cod_Barra,Nombre_Prod, Proveedor1,Proveedor2,Fk_sucursal,
Existencias_R,ID_H_O_D,Fecha_Caducidad, DATEDIFF(Fecha_Caducidad,NOW()) as diferencia FROM Stock_POS WHERE ID_H_O_D ='".$row['ID_H_O_D']."' AND Fk_sucursal='".$row['Fk_Sucursal']."'";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="ProductosPorVencer" class="table table-hover">
<thead>

<th>Codigo de barra</th>
    <th>Nombre producto</th>
    <th>Proveedor </th>
    <th>Stock </th>
  
<th>Fecha caducidad</th>
<th>Dias para vencer</th>



</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>



<td > <?php echo $Usuarios['Cod_Barra']; ?></td>
  <td > <?php echo $Usuarios['Nombre_Prod']; ?></td>
  <td > <?php echo $Usuarios['Proveedor1']; ?> <br>
  <?php echo $Usuarios['Proveedor2']; ?>
  </td>
  <td > <?php echo $Usuarios['Existencias_R']; ?></td>
 

  <td >  <?php echo fechaCastellano($Usuarios['Fecha_Caducidad']); ?> 	 </td>
  <td > <?php echo $Usuarios['diferencia']; ?> Días para vencer</td>
	
		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">Aún no hay productos registrados para <?echo $row['ID_H_O_D']?></p>
<?php endif;?>
  <!-- Modal -->
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