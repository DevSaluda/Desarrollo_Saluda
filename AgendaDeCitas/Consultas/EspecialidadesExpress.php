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
$sql1="SELECT Especialidades_Express.ID_Especialidad,Especialidades_Express.Nombre_Especialidad,Especialidades_Express.Fk_Sucursal, 
Especialidades_Express.ID_H_O_D,Especialidades_Express.Estatus_Especialidad,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal 
FROM Especialidades_Express,SucursalesCorre WHERE Especialidades_Express.Fk_Sucursal = SucursalesCorre.ID_SucursalC AND Especialidades_Express.ID_H_O_D='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
	<div class="text-center">
	<div class="table-responsive">
	<table id="EspecialidadesV2" class="table ">
<thead>
	<th>Folio</th>
	<th>Especialidad</th>
	<th>Sucursal</th>
	<th>Estatus</th>
	

	


</thead>
<?php while ($Especialidades=$query->fetch_array()):?>
<tr> 
	<td><?php echo $Especialidades["ID_Especialidad"]; ?></td>
	
	<td><?php echo $Especialidades["Nombre_Especialidad"]; ?></td>
	<td><?php echo $Especialidades["Nombre_Sucursal"]; ?></td>
	<td><button class="btn btn-default btn-sm" style=<?if($Especialidades['Estatus_Especialidad'] == 'Disponible'){
   echo "background-color:#00c851!important";
} elseif($Especialidades['Estatus_Especialidad'] != 'Disponible'  &&  $Especialidades['Estatus_Especialidad'] != 'No disponible') {
  echo "background-color:#fd7e14!important";
}else {
    echo "background-color:#fd1414!important";
}
?>>
<?if($Especialidades['Estatus_Especialidad'] == ''){
   echo "No se asigno estatus";
} else {
    echo $Especialidades["Estatus_Especialidad"]; 
} ?></button></td>
	 
	
	
		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<h3 class="alert alert-warning"> No se encontraron Especialidades <i class="fas fa-exclamation-circle"></i> </h3>
<?php endif;?>
  <!-- Modal -->
  <script>
	   var modal_lv = 0;
$('.modal').on('shown.bs.modal', function (e) {
  $('.modal-backdrop:last').css('zIndex',1051+modal_lv);
  $(e.currentTarget).css('zIndex',1052+modal_lv);
  modal_lv++
});

$('.modal').on('hidden.bs.modal', function (e) {
  modal_lv--
});	
  	$(".btn-edit").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/ControldecitasV2/Modales/EditaEspecialidad.php","id="+id,function(data){
			  $("#form-edit").html(data);
			  $("#Titulo").html("Cambio de vigencia en especialidades");
			  $("#info-mensaje").show();
  		});
  		$('#editModal').modal('toggle'); 
	  });
	  $(".btn-edit2").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/ControldecitasV2/Modales/DetallesEspecialidad.php","id="+id,function(data){
			  $("#form-edit").html(data);
			  $("#Titulo").html("Detalles");
			  $("#info-mensaje").hide();
			  
  		});
  		$('#editModal').modal('toggle'); 
	  });
	
  </script>
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-notify modal-info">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead" id="Titulo">Cambio de vigencia en especialidades</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
        <div id="info-mensaje"class="alert alert-info alert-styled-left text-blue-800 content-group">
						                <span class="text-semibold">Estimado usuario, </span>
                            Antes de continuar verifiqué la información a la cual se aplicaran cambios
                          
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
        <div class="modal-body">
        <div id="form-edit"></div>
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  