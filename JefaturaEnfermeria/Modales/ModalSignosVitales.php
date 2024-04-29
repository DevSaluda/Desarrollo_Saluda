<script type="text/javascript">
$(document).ready( function () {
    $('#SignosVitalessssss').DataTable({
      "order": [[ 0, "desc" ]],
      "language": {
        "url": "Componentes/Spanish.json"
		}
		
	  } 
	  
	  );
} );
</script>
<?php




$user_id=null;
$sql1="SELECT Signos_VitalesV2.ID_SignoV,
Signos_VitalesV2.Folio_Paciente,
Signos_VitalesV2.Nombre_Paciente,
Signos_VitalesV2.Motivo_Consulta,
Signos_VitalesV2.Nombre_Doctor,
Signos_VitalesV2.Fk_Enfermero,
Signos_VitalesV2.Fk_Sucursal,
Signos_VitalesV2.FK_ID_H_O_D, 
Signos_VitalesV2.Fecha_Visita,
Signos_VitalesV2.Estatus,
Signos_VitalesV2.CodigoEstatus,SucursalesCorre.ID_SucursalC,
SucursalesCorre.Nombre_Sucursal
FROM Signos_VitalesV2,SucursalesCorre WHERE DATE(Signos_VitalesV2.Fecha_Visita) = DATE_FORMAT(CURDATE(),'%Y-%m-%d') AND Signos_VitalesV2.Fk_Enfermero='".$row['Nombre_Apellidos']."' AND Signos_VitalesV2.Fk_Sucursal = SucursalesCorre.ID_SucursalC 
AND Signos_VitalesV2.FK_ID_H_O_D='".$row['ID_H_O_D']."' ";
$query = $conn->query($sql1);
?>

<!-- Central Modal Medium Info -->
<div class="modal fade" id="SignosVitalesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-="true" style="overflow-y: scroll;">
   <div class="modal-dialog modal-xl modal-notify modal-success" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div class="modal-header">
         <p class="heading lead">Signos vitales</p>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-="true" class="white-text">&times;</span>
         </button>
       </div>
     
       <!--Body-->
       <div class="modal-body">
         <div class="text-center">
         <?php if($query->num_rows>0):?>
  <div class="text-center">
  <table id="SignosVitalessssss" class="table ">
<thead><th>Folio</th>
    <th>Nombre </th>
    <th>Sucursal</th>
    <th>Motivo consulta </th>
    <th>Registrado </th>
    <th>Doctor </th>
    <th>Estatus </th>
	
	


</thead>
<?php while ($DataPacientes=$query->fetch_array()):?>
<tr>
<td><?php echo $DataPacientes["Folio_Paciente"]; ?></td>
    <td><?php echo $DataPacientes["Nombre_Paciente"]; ?></td>
    <td><?php echo $DataPacientes["Nombre_Sucursal"]; ?></td>
    <td><?php echo $DataPacientes["Motivo_Consulta"]; ?></td>
    <td><?php echo fechaCastellano($DataPacientes["Fecha_Visita"]); ?>
      </td>
    <td><?php echo $DataPacientes["Nombre_Doctor"]; ?></td>
   
    <td><button class="btn btn-default btn-sm" style="<?php echo $DataPacientes['CodigoEstatus'];?>"><?php echo $DataPacientes["Estatus"]; ?></button></td>
	
 

	
		
</tr>
<?php endwhile;?>
</table>
</div></div>
<?php else:?>
	<p class="alert alert-warning">Aún no existen registros</p>
<?php endif;?>
  
     </div>
     <!--/.Content-->
   </div>
 </div>
 </div>
 </div>

