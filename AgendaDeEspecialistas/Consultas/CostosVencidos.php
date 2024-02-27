<script type="text/javascript">
$(document).ready( function () {
    $('#Costos').DataTable({
      "language": {
        "url": "Componentes/Spanish.json"
        }
      } );
} );
</script>
<?php

include("db_connection.php");
include "Consultas.php";
include "Sesion.php";

$user_id=null;
$sql1="SELECT Costos_EspecialistasV2.ID_Costo_Esp,Costos_EspecialistasV2.Costo_Especialista,Costos_EspecialistasV2.ID_H_O_D,
Costos_EspecialistasV2.FK_Especialista,Costos_EspecialistasV2.Estatus,Costos_EspecialistasV2.Codigocolor,EspecialistasV2.ID_Especialista,EspecialistasV2.Nombre_Apellidos FROM Costos_EspecialistasV2,EspecialistasV2 WHERE
Costos_EspecialistasV2.FK_Especialista = EspecialistasV2.ID_Especialista AND Costos_EspecialistasV2.Estatus ='Vencido' AND Costos_EspecialistasV2.ID_H_O_D='".$row['ID_H_O_D']."'";
 

$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center"> 
	<div class="table-responsive">
	<table id="Costos" class="table table-hover">
<thead>
	<th>Folio</th>
    <th>Nombre especialista</th>
    <th>Costo</th>
    <th>Estatus</th>
	<th>Acciones</th>



</thead>
<?php while ($Costo=$query->fetch_array()):?>
<tr>
	<td><?php echo $Costo["ID_Costo_Esp"]; ?></td>
    <td><?php echo $Costo["Nombre_Apellidos"]; ?></td>
    <td>$<?php echo $Costo["Costo_Especialista"]; ?></td>
	<td><button class="btn btn-default btn-sm" style="<?echo $Costo['Codigocolor'];?>"><?php echo $Costo["Estatus"]; ?></button></td>
	 
		
  <td>
		 <!-- Basic dropdown -->
<button class="btn btn-primary dropdown-toggle " type="button" data-toggle="dropdown"
  aria-haspopup="true" aria-expanded="false"><i class="fas fa-th-list fa-1x"></i></button>

<div class="dropdown-menu">
<a data-id="<?php echo $Costo["ID_Costo_Esp"];?>" class="btn-edit dropdown-item" >Cambiar vigencia <i class="fas fa-ban"></i></a>
<a data-id="<?php echo $Costo["ID_Costo_Esp"];?>" class="btn-edit2 dropdown-item" >Detalles <i class="fas fa-pencil-alt"></i></a>
 
 
 
 
</div>
<!-- Basic dropdown -->
	 </td>
	
	
		
	
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
  <h3 class="alert alert-warning">No se encontraron costos <i class="fas fa-exclamation-circle"></i> </h3>
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
  		$.post("https://controlfarmacia.com/ControldecitasV2/Modales/EditaCostoV.php","id="+id,function(data){
			  $("#form-edit").html(data);
			  $("#Titulo").html("Cambio de vigencia en especialistas");
			  $("#info-mensaje").show();
  		});
  		$('#editModal').modal('toggle'); 
	  });
	  $(".btn-edit2").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/ControldecitasV2/Modales/DetallesCostos.php","id="+id,function(data){
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
         <p class="heading lead" id="Titulo">Cambio de vigencia en especialistas</p>

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
