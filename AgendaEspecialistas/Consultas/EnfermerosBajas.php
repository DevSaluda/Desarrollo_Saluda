<script type="text/javascript">
$(document).ready( function () {
    $('#EnfermerosBajas').DataTable({
      "order": [[ 0, "desc" ]],
      "language": {
        "url": "Componentes/Spanish.json"
		}
		
	  } 
	  
	  );
} );
</script>
<?php
header("Access-Control-Allow-Origin: *");
include("db_connection.php");
include "Consultas.php";
include "Sesion.php";

$user_id=null;
$sql1="SELECT Personal_Enfermeria.Enfermero_ID,Personal_Enfermeria.Nombre_Apellidos,Personal_Enfermeria.Fk_Usuario,Personal_Enfermeria.file_name,Personal_Enfermeria.Fk_Sucursal,
Personal_Enfermeria.ID_H_O_D,Personal_Enfermeria.Estatus,Personal_Enfermeria.ColorEstatus,Personal_Enfermeria.Telefono,Personal_Enfermeria.AgregadoEl,Personal_Enfermeria.Password,
Personal_Enfermeria.Correo_Electronico,Personal_Enfermeria.Estatus,Personal_Enfermeria.Biometrico,
Roles_Puestos.ID_rol,Roles_Puestos.Nombre_rol,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal 
FROM Personal_Enfermeria,Roles_Puestos,SucursalesCorre where Personal_Enfermeria.Fk_Sucursal = SucursalesCorre.ID_SucursalC 
and Personal_Enfermeria.Fk_Usuario = Roles_Puestos.ID_rol   AND Personal_Enfermeria.Fk_Usuario ='4' AND Personal_Enfermeria.Estatus!='Vigente' and Personal_Enfermeria.ID_H_O_D ='".$row['ID_H_O_D']."'";  
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
    <div class="text-center">
	<div class="table-responsive">
    
	<table id="EnfermerosBajas" class="table ">
<thead><th>ID </th>
<th>Foto perfil </th>
    <th>Nombre </th>
<th>Telefono</th>
    <th>Sucursal</th>
    <th>Huellas digitales</th>
    <th>Baja desde</th>
   
	
	


</thead>
<?php while ($PersonalEnfermeria=$query->fetch_array()):?>
<tr><td><?php echo $PersonalEnfermeria["Enfermero_ID"]; ?></td>   
<td><img  width="80" height="80" alt="avatar" class="rounded-circle img-responsive" src="https://controlconsulta.com/Perfiles/<?php echo $PersonalEnfermeria["file_name"]; ?> "></td>
<td><?php echo $PersonalEnfermeria["Nombre_Apellidos"]; ?></td>   
<td><?php echo $PersonalEnfermeria["Telefono"]; ?></td>   

    <td><?php echo $PersonalEnfermeria["Nombre_Sucursal"]; ?></td>

    <td><?if($PersonalEnfermeria['Biometrico'] == 1){
   
   echo "Verificado ";
 
} else {
  echo "Sin datos";
}?> </td>
<td><?php echo $PersonalEnfermeria["AgregadoEl"]; ?></td>   


 

	
		
</tr>
<?php endwhile;?>
</table>
</div></div>
<?php else:?>
	<p class="alert alert-warning">Aún no hay pacientes registrados</p>
<?php endif;?>
  <!-- Modal -->
  <script>
    $(".btn-reactive").click(function(){
  		id = $(this).data("id");
  		$.post("https://www.somosgrupoe.com/Administracion/RecursosHumanos/Modales/ReactivaEnfermero.php","id="+id,function(data){
              $("#form-editt").html(data);
              $("#Tituloo").html("Editar datos de empleado");
              $("#Dio").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Dio").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Dio").removeClass("modal-dialog modal-xl modal-notify modal-primary");
              $("#Dio").addClass("modal-dialog modal-sm modal-notify modal-warning");

              
  		});
  		$('#editModal2').modal('show');
    });

   
  </script>
  <div class="modal fade" id="editModal2" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModal2Label" aria-hidden="true">
  <div id="Dio"class="modal-dialog modal-lg modal-notify modal-info">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="Tituloo"></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
        <div id="Mensaje "class="alert alert-info alert-styled-left text-blue-800 content-group">
						                <span id="Aviso" class="text-semibold">Estimado usuario, 
                            Verifique los campos antes de realizar alguna accion</span>
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
	        <div class="modal-body">
          <div class="text-center">
        <div id="form-editt"></div>
        
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->