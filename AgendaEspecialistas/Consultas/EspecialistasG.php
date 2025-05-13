<script type="text/javascript">
$(document).ready( function () {
	
    $('#EspecialistasV2').DataTable({

      "language": {
        "url": "Componentes/Spanish.json"
		},
		initComplete: function() {
        this.api().columns([0,2]).every(function() {
            var column = this;
 
            var select = $('<select class="form-control form-control-sm" ><option value="">Selecciona para filtrar</option></select>')
                .appendTo($(column.header()))
                .on('change', function() {
                    var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                    );
 
                        column
                        .search(val ? '^' + val + '$' : '', true, false)
                        .draw();
 
 
                });
                //Este codigo sirve para que no se active el ordenamiento junto con el filtro
            $(select).click(function(e) {
                e.stopPropagation();
            });
            //===================
 
            column.data().unique().sort().each(function(d, j) {
                // select.append('<option value="' + d + '">' + d + '</option>')
 
                    select.append('<option value="' + d + '">' + d + '</option>')
 
            });
 
 
 
        });
    },
    "aoColumnDefs": [
     { "bSearchable": false, "aTargets": [ 1 ] }
   ]
 
});
//********Esta bendita linea hace la magia, adjusta el header de la tabla con el body
		
      } );

</script>
<?php

include ("db_connection.php");
include "Consultas.php";
include "Sesion.php";

$user_id=null;
$sql1="SELECT EspecialistasV2.ID_Especialista,EspecialistasV2.Nombre_Apellidos,EspecialistasV2.Especialidad,EspecialistasV2.Tel,
EspecialistasV2.ID_H_O_D,EspecialistasV2.Estatus_Especialista,EspecialistasV2.CodigoColorEs,EspecialistasV2.Fk_Sucursal,
EspecialidadesV2.ID_Especialidad,EspecialidadesV2.Nombre_Especialidad,Sucursales_CampañasV2.ID_SucursalC, Sucursales_CampañasV2.Nombre_Sucursal FROM EspecialistasV2,EspecialidadesV2,Sucursales_CampañasV2
 WHERE EspecialistasV2.Especialidad = EspecialidadesV2.ID_Especialidad AND EspecialistasV2.Fk_Sucursal =Sucursales_CampañasV2.ID_SucursalC  
 AND EspecialistasV2.ID_H_O_D='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
	<div class="table-responsive">
	<table id="EspecialistasV2" class="table ">
<thead>
    <th>Nombre especialista</th>
	<th>Especialidad</th>
	<th>Sucursal</th>
	<th>Estatus</th>
	
	


</thead>
<?php while ($Especialista=$query->fetch_array()):?>
<tr>
    <td><?php echo $Especialista["Nombre_Apellidos"]; ?></td>
	<td><?php echo $Especialista["Nombre_Especialidad"]; ?></td>
	<td><?php echo $Especialista["Nombre_Sucursal"]; ?></td>
	<td><button class="btn btn-default btn-sm" style="<?echo $Especialista['CodigoColorEs'];?>"><?php echo $Especialista["Estatus_Especialista"]; ?></button></td>

	
	
		
</tr>
<?php endwhile;?>
</table>
</div>
<?php else:?>
	<h3 class="alert alert-warning"> 	No se encontraron especialistas <i class="fas fa-exclamation-circle"></i> </h3>

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
  		$.post("https://controlfarmacia.com/ControldecitasV2/Modales/EditaEspecialistaH.php","id="+id,function(data){
			  $("#form-edit").html(data);
			  $("#Titulo").html("Cambio de vigencia en especialistas");
			  $("#info-mensaje").show();
  		});
  		$('#editModal').modal('toggle'); 
	  });
	  $(".btn-edit2").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/ControldecitasV2/Modales/DetallesEspecialista.php","id="+id,function(data){
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

  