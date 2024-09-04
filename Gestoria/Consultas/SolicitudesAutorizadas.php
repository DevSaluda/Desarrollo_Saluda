
<script type="text/javascript">
$(document).ready( function () {
    $('#SolicitudesAutorizadas').DataTable({
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
include "Sesion.php";

$user_id=null;
$sql1="SELECT Solicitudes_Traspasos.ID_Sol_Traspaso,Solicitudes_Traspasos.Cod_Barra,Solicitudes_Traspasos.Nombre_Prod,Solicitudes_Traspasos.Motivo_Solicitud,
Solicitudes_Traspasos.Fk_sucursal, Solicitudes_Traspasos.Sucursal_Destino,Solicitudes_Traspasos.Fk_Sucursal_Destino,
  Solicitudes_Traspasos.Cantidad_Solicitada,Solicitudes_Traspasos.Estatus,Solicitudes_Traspasos.CodigoEstatus,
  Solicitudes_Traspasos.ID_H_O_D,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM
   SucursalesCorre,Solicitudes_Traspasos where Solicitudes_Traspasos.Fk_sucursal = SucursalesCorre.ID_SucursalC AND  Solicitudes_Traspasos.Estatus='Autorizado' AND Solicitudes_Traspasos.Sucursal_Destino = '".$row['Fk_Sucursal']."'
    AND Solicitudes_Traspasos.ID_H_O_D='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="SolicitudesAutorizadas" class="table table-hover">
<thead>

<th>Clave</th>
<th>Codigo de barras</th>
<th>Nombre producto</th>

<th>Sucursal origen</th>
    <th>Sucursal destino</th>
    <th>Estatus</th>
    

    


</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>

<td > <?php echo $Usuarios['ID_Sol_Traspaso']; ?></td>
<td > <?php echo $Usuarios['Cod_Barra']; ?></td>
<td > <?php echo $Usuarios['Nombre_Prod']; ?></td>
  <td > <?php echo $Usuarios['Nombre_Sucursal']; ?></td>
  <td > <?php echo $Usuarios['Fk_Sucursal_Destino']; ?>
  </td>
  <td >  <button class="btn btn-default btn-sm" style=<?if($Usuarios["Estatus"] =="Autorizado"){
   echo "background-color:#00c851!important";
} else {
   echo "background-color:#fd7e14!important";
}?>><?if($Usuarios["Estatus"] =="Autorizado"){
    echo "Autorizado";
 } else {
    echo "Error";
 }?></button> </td>

	
		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">Aún no hay solicitudes de <?echo $row['ID_H_O_D']?></p>
<?php endif;?>
  <!-- Modal -->
 