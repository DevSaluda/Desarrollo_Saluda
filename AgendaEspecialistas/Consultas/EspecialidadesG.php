<script type="text/javascript">
$(document).ready( function () {
    $('#EspecialidadesV2').DataTable({
	
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
$sql1="SELECT EspecialidadesV2.ID_Especialidad,EspecialidadesV2.Nombre_Especialidad,EspecialidadesV2.Fk_Sucursal,
EspecialidadesV2.ID_H_O_D,EspecialidadesV2.Estatus_Especialidad,EspecialidadesV2.Codigocolor,
Sucursales_CampañasV2.ID_SucursalC,Sucursales_CampañasV2.Nombre_Sucursal 
FROM EspecialidadesV2,Sucursales_CampañasV2 WHERE EspecialidadesV2.Fk_Sucursal = Sucursales_CampañasV2.ID_SucursalC AND EspecialidadesV2.ID_H_O_D='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
	<div class="text-center">
	<div class="table-responsive">
	<table id="EspecialidadesV2" class="table ">
<thead>
	<th>Folio</th>
	<th>Sucursal</th>
	<th>Especialidad</th>
	<th>Estatus</th>


	


</thead>
<?php while ($Especialidades=$query->fetch_array()):?>
<tr>
	<td><?php echo $Especialidades["ID_Especialidad"]; ?></td>
	<td><?php echo $Especialidades["Nombre_Sucursal"]; ?></td>
	<td><?php echo $Especialidades["Nombre_Especialidad"]; ?></td>
	<td><button class="btn btn-default btn-sm" style="<?echo $Especialidades['Codigocolor'];?>"><?php echo $Especialidades["Estatus_Especialidad"]; ?></button></td>
	 
	
		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<h3 class="alert alert-warning"> No se encontraron Especialidades <i class="fas fa-exclamation-circle"></i> </h3>
<?php endif;?>
  <!-- Modal -->
  
  