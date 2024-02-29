<script type="text/javascript">
$(document).ready( function () {
    $('#Especialidades').DataTable({
	
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
FROM EspecialidadesV2,Sucursales_CampañasV2 WHERE EspecialidadesV2.Fk_Sucursal = Sucursales_CampañasV2.ID_SucursalC AND EspecialidadesV2.Estatus_Especialidad='Vencido'
AND  EspecialidadesV2.ID_H_O_D='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
	<div class="text-center">
	<div class="table-responsive">
	<table id="Especialidades" class="table ">
<thead>
	<th>Folio</th>
	<th>Sucursal</th>
	<th>Especialidad</th>
	<th>Estatus</th>
	<th>Acciones</th>
	


</thead>
<?php while ($Especialidades=$query->fetch_array()):?>
<tr>
	<td><?php echo $Especialidades["ID_Especialidad"]; ?></td>
	<td><?php echo $Especialidades["Nombre_Sucursal"]; ?></td>
	<td><?php echo $Especialidades["Nombre_Especialidad"]; ?></td>
	<td><button class="btn btn-default btn-sm" style="<?echo $Especialidades['Codigocolor'];?>"><?php echo $Especialidades["Estatus_Especialidad"]; ?></button></td>

	
	<td>
		 <!-- Basic dropdown -->
<button class="btn btn-primary dropdown-toggle " type="button" data-toggle="dropdown"
  aria-haspopup="true" aria-expanded="false"><i class="fas fa-th-list fa-1x"></i></button>

<div class="dropdown-menu">
  <a data-id="<?php echo $Especialidades["ID_Especialidad"];?>" class="btn-edit2 dropdown-item" >Detalles <i class="fas fa-info-circle"></i></a>
  <a data-id="<?php echo $Especialidades["ID_Especialidad"];?>" class="btn-edit dropdown-item" >Cambiar vigencia <i class="fas fa-ban"></i></a>
 
</div>
<!-- Basic dropdown -->
	 </td>
		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">No hay resultados</p>
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
		  $.post("https://controlfarmacia.com/ControldecitasV2/Modales/EditaEspecialidadH.php","id="+id,function(data){
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