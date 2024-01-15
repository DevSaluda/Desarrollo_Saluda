<script type="text/javascript">
$(document).ready( function () {
    $('#Intendencia').DataTable({
	
      "language": {
        "url": "Componentes/Spanish.json"
		}
		
	  } 
	  
	  );
} );
</script>
<?php

include("Consultas/db_connection.php");
include "Consultas/Consultas.php";
$user_id=null;
$sql1="SELECT Personal_Intendecia.Intendencia_ID,Personal_Intendecia.Nombre_Apellidos,Personal_Intendecia.file_name,Personal_Intendecia.file_name,Personal_Intendecia.Fk_Usuario,
Personal_Intendecia.Telefono,Personal_Intendecia.Fk_Sucursal,Personal_Intendecia.Estatus ,Personal_Intendecia.ID_H_O_D,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal, Roles_Puestos.ID_rol,Roles_Puestos.Nombre_rol from Personal_Intendecia,SucursalesCorre,Roles_Puestos where 
Personal_Intendecia.Fk_Usuario = Roles_Puestos.ID_rol AND Personal_Intendecia.Fk_Sucursal = SucursalesCorre.ID_SucursalC AND Personal_Intendecia.Estatus='Vigente' AND Personal_Intendecia.ID_H_O_D ='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>


<!-- Central Modal Medium Info -->
<div class="modal fade" id="LimpiezaVigente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-="true" style="overflow-y: scroll;">
   <div class="modal-dialog modal-xl modal-notify modal-success" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div class="modal-header">
         <p class="heading lead">Médicos Vigentes</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-="true" class="white-text">&times;</span>
         </button>
       </div>
     
       <!--Body-->
       <div class="modal-body">
         <div class="text-center">
         <?php if($query->num_rows>0):?>
  <div class="text-center">
  <table id="Intendencia" class="table ">
  <thead>
	<th>Folio</th>
    <th>Foto de perfil</th>
    <th>Nombre</th>
    <th>Sucursal</th>
	<th>Especialidad</th>
	


	


</thead>
<?php while ($Especialidades=$query->fetch_array()):?>
<tr>
	<td><?php echo $Especialidades["Intendencia_ID"]; ?></td>
    <td><img  width="60" height="60" alt="avatar" class="rounded-circle img-responsive" src="https://www.somosgrupoe.com/Administracion/Perfiles/<?php echo $Especialidades["file_name"]; ?> "></td>
	<td><?php echo $Especialidades["Nombre_Apellidos"]; ?></td>
    <td><?php echo $Especialidades["Nombre_Sucursal"]; ?></td>
    <td><?php echo $Especialidades["Nombre_rol"]; ?></td>

  
	
	
		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<h3 class="alert alert-warning"> No se encontraron Especialidades <i class="fas fa-exclamation-circle"></i> </h3>
<?php endif;?>
  
     </div>
     <!--/.Content-->
   </div>
 </div>
 </div>
 </div>

