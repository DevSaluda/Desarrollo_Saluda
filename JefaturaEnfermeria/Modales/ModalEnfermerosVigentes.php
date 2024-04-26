<script type="text/javascript">
$(document).ready( function () {
    $('#SignosVitales2').DataTable({
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
$sql1="SELECT Personal_Enfermeria.Enfermero_ID,
Personal_Enfermeria.Nombre_Apellidos,
Personal_Enfermeria.Fk_Usuario,
Personal_Enfermeria.file_name,
Personal_Enfermeria.Fk_Sucursal,
Personal_Enfermeria.ID_H_O_D,
Personal_Enfermeria.Estatus,
Personal_Enfermeria.ColorEstatus,
Personal_Enfermeria.Telefono,
Personal_Enfermeria.AgregadoEl,
Personal_Enfermeria.Password,
Personal_Enfermeria.Correo_Electronico,
Personal_Enfermeria.Estatus,
Roles_Puestos.ID_rol,
Roles_Puestos.Nombre_rol,
SucursalesCorre.ID_SucursalC,
SucursalesCorre.Nombre_Sucursal 
FROM Personal_Enfermeria,Roles_Puestos,SucursalesCorre 
WHERE Personal_Enfermeria.Fk_Sucursal = SucursalesCorre.ID_SucursalC 
AND Personal_Enfermeria.Fk_Usuario = Roles_Puestos.ID_rol 
AND Personal_Enfermeria.Estatus='Vigente' 
AND Personal_Enfermeria.Fk_Usuario ='4' 
AND Personal_Enfermeria.ID_H_O_D ='".$row['ID_H_O_D']."'";  
$query = $conn->query($sql1);
?>

<!-- Central Modal Medium Info -->
<div class="modal fade" id="EnferVigentes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-="true" style="overflow-y: scroll;">
   <div class="modal-dialog modal-xl modal-notify modal-success" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div class="modal-header">
         <p class="heading lead">Farmacéuticos Vigentes</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-="true" class="white-text">&times;</span>
         </button>
       </div>
     
       <!--Body-->
       <div class="modal-body">
         <div class="text-center">
         <?php if($query->num_rows>0):?>
  <div class="text-center">
  <table id="SignosVitales2" class="table ">
<thead>
<th>ID </th>
<th>Foto perfil </th>
    <th>Nombre </th>
<th>Telefono</th>
    <th>Sucursal</th>

  


</thead>
<?php while ($PersonalEnfermeria=$query->fetch_array()):?>
<tr><td><?php echo $PersonalEnfermeria["Enfermero_ID"]; ?></td>   
<td><img  width="80" height="80" alt="avatar" class="rounded-circle img-responsive" src="https://saludapos.com/Perfiles/<?php echo $PersonalEnfermeria["file_name"]; ?> "></td>
<td><?php echo $PersonalEnfermeria["Nombre_Apellidos"]; ?></td>   
<td><?php echo $PersonalEnfermeria["Telefono"]; ?></td>   

<td><?php echo $PersonalEnfermeria["Nombre_Sucursal"]; ?></td>

   

  
    
</tr>
<?php endwhile;?>
</table>
</div></div>
<?php else:?>
  <p class="alert alert-warning">Aún no hay personal registrado</p>
<?php endif;?>
  
     </div>
     <!--/.Content-->
   </div>
 </div>
 </div>
 </div>

