<script type="text/javascript">
$(document).ready( function () {
    $('#GastosSucursales').DataTable({
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
$sql1="SELECT Otros_Gastos_POS.ID_Gastos,Otros_Gastos_POS.Concepto_Categoria,Otros_Gastos_POS.Importe_Total,Otros_Gastos_POS.Empleado,
Otros_Gastos_POS.Fk_sucursal,Otros_Gastos_POS.Descripcion,Otros_Gastos_POS.ID_H_O_D,
Categorias_Gastos_POS.Cat_Gasto_ID,Categorias_Gastos_POS.Nom_Cat_Gasto,SucursalesCorre.ID_SucursalC,
SucursalesCorre.Nombre_Sucursal FROM Otros_Gastos_POS,Categorias_Gastos_POS,SucursalesCorre 
where Otros_Gastos_POS.Concepto_Categoria = Categorias_Gastos_POS.Cat_Gasto_ID AND Otros_Gastos_POS.Fk_sucursal = SucursalesCorre.ID_SucursalC 
AND Otros_Gastos_POS.ID_H_O_D ='".$row['ID_H_O_D']."' AND Otros_Gastos_POS.Fk_sucursal='".$row['Fk_Sucursal']."'";


$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="GastosSucursales" class="table table-hover">
<thead>
<th>Folio</th>
<th>Concepto</th>
    <th>Importe</th>
    <th>Empleado</th>
   
	


</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>


<td > <?php echo $Usuarios['ID_Gastos']; ?></td>
<td > <?php echo $Usuarios['Nom_Cat_Gasto']; ?></td>
  <td > <?php echo $Usuarios['Importe_Total']; ?></td>
  <td > <?php echo $Usuarios['Empleado']; ?></td>
  

  
	
		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">Aún no hay GastosSucursales registrados para <?echo $row['ID_H_O_D']?></p>
<?php endif;?>
  <!-- Modal -->
  