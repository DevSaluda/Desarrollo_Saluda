<script type="text/javascript">
$(document).ready( function () {
    $('#PacientesData').DataTable({
      "order": [[ 0, "ASC" ]],
      "lengthMenu": [[30,100,200, -1], [30,100,200, "Todos"]],   
      "language": {
        "url": "Componentes/Spanish.json"
		}
		
	  } 
	  
	  );
} );
</script>
<?php

include ("db_connection.php");
include "Consultas.php";
include "Sesion.php";

$user_id=null;
$sql1="SELECT ID_Data_Paciente,Nombre_Paciente,Edad,Sexo,FK_ID_H_O_D,Telefono,Correo
FROM Data_Pacientes WHERE FK_ID_H_O_D ='".$row['ID_H_O_D']."' AND
Ingreso='".$row['Nombre_Apellidos']."' ORDER BY ID_Data_Paciente ASC";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table id="PacientesData" class="table ">
<thead>
    <th>Folio</th>
    <th>Nombre </th>
   
    <th>Telefono </th>
    
	  <th>Acciones </th>
	


</thead>
<?php while ($DataPacientes=$query->fetch_array()):?>
<tr>
    <td><?php echo $DataPacientes["ID_Data_Paciente"]; ?></td>
    <td><?php echo $DataPacientes["Nombre_Paciente"]; ?></td>
    <td><?php echo $DataPacientes["Telefono"]; ?></td>

 
  <td>
		 <!-- Basic dropdown -->
<button class="btn btn-primary dropdown-toggle " type="button" data-toggle="dropdown"
  aria-haspopup="true" aria-expanded="false"><i class="fas fa-th-list fa-1x"></i></button>

<div class="dropdown-menu">
<a data-id="<?php echo  $DataPacientes["ID_Data_Paciente"];?>" class="btn-edit dropdown-item" > Agendar cita <i class="fas fa-file-medical"></i>  </a>
  <a data-id="<?php echo  $DataPacientes["ID_Data_Paciente"];?>" class="btn-edit2 dropdown-item" >Editar datos <i class="fas fa-user-edit"></i></a>
  
 
</div>
<!-- Basic dropdown -->
	 </td>
	
		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">Aún no hay pacientes registrados</p>
<?php endif;?>
  <!-- Modal -->
  <script>
  	$(".btn-edit").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/ControldecitasV2/Modales/AgendaNuevo.php","id="+id,function(data){
  			$("#form-edit").html(data);
  		});
  		$('#editModal').modal('show');
    });
    $(".btn-edit2").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/ControldecitasV2/Modales/EditaDatosPaciente.php","id="+id,function(data){
              $("#form-edit").html(data);
              $("#Titulo").html("Editar datos del paciente");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Di").addClass("modal-dialog modal-lg modal-notify modal-primary");
  		});
  		$('#editModal').modal('show');
    });
  </script>
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true" style="overflow-y: scroll;">
  <div class="modal-dialog modal-lg modal-notify modal-primary" >
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead">Agendar cita con especialista</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
        <div class="alert alert-info alert-styled-left text-blue-800 content-group">
						                <span class="text-semibold">Estimado usuario, </span>
                            Por favor verifica los datos del paciente antes de realizar el rellenado de información.
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
	        <div class="modal-body">
          <div class="text-center">
        <div id="form-edit"></div>
        
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->