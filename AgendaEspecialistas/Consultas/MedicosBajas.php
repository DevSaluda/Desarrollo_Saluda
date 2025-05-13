<script type="text/javascript">
$(document).ready( function () {
    $('#MedicosBajasGeneral').DataTable({
	
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
$sql1="SELECT Personal_Medico.Medico_ID,Personal_Medico.Nombre_Apellidos,Personal_Medico.file_name,Personal_Medico.Fk_Usuario,Personal_Medico.Fk_Sucursal,Personal_Medico.Telefono,
Personal_Medico.ID_H_O_D,Personal_Medico.Estatus,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal,Roles_Puestos.ID_rol,Roles_Puestos.Nombre_rol,Personal_Medico.Biometrico
FROM Personal_Medico,SucursalesCorre,Roles_Puestos where Personal_Medico.Fk_Usuario = Roles_Puestos.ID_rol AND 
Personal_Medico.Fk_Sucursal= SucursalesCorre.ID_SucursalC   AND Personal_Medico.Estatus!='Vigente' AND Personal_Medico.ID_H_O_D='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
	<div class="text-center">
	<div class="table-responsive">
	<table id="MedicosBajasGeneral" class="table ">
<thead>
<th>Folio</th>
  <th>Foto perfil </th>
    <th>Nombre</th>
    <th>Telefono</th>
    <th>Sucursal</th>
	<th>Especialidad</th>
  <th>Huellas Digitales</th>
	<th>Acciones</th>


	


</thead>
<?php while ($Especialidades=$query->fetch_array()):?>
<tr>
	<td><?php echo $Especialidades["Medico_ID"]; ?></td>
	<td><img  width="80" height="80" alt="avatar" class="rounded-circle img-responsive" src="https://controlconsulta.com/Perfiles/<?php echo $Especialidades["file_name"]; ?> "></td>
	<td><?php echo $Especialidades["Nombre_Apellidos"]; ?></td>
  <td><?php echo $Especialidades["Telefono"]; ?></td>
    <td><?php echo $Especialidades["Nombre_Sucursal"]; ?></td>
    <td><?php echo $Especialidades["Nombre_rol"]; ?></td>
    <td><?if($Especialidades['Biometrico'] == 1){
   
   echo "Verificado ";
 
} else {
  echo "Sin datos";
}?> </td>

	  <td>
		 <!-- Basic dropdown -->
<button class="btn btn-primary dropdown-toggle " type="button" data-toggle="dropdown"
  aria-haspopup="true" aria-expanded="false"><i class="fas fa-th-list fa-1x"></i></button>

<div class="dropdown-menu">
<a data-id="<?php echo $Especialidades["Medico_ID"];?>"  class="btn-reactive dropdown-item" >Reactivar <i class="fas fa-user-plus"></i></a>

</div>
<!-- Basic dropdown -->
	 </td>
 
	
	
		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<h3 class="alert alert-warning"> No se encontraron Especialidades <i class="fas fa-exclamation-circle"></i> </h3>
<?php endif;?>
<script>
    $(".btn-reactive").click(function(){
  		id = $(this).data("id");
  		$.post("https://www.somosgrupoe.com/Administracion/RecursosHumanos/Modales/ReactivaMedico.php","id="+id,function(data){
              $("#form-editt").html(data);
              $("#Tituloo").html("reactivación de usuario");
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
     
	        <div class="modal-body">
          <div class="text-center">
        <div id="form-editt"></div>
        
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->