
<script type="text/javascript">
$(document).ready( function () {
    $('#Solicitudes').DataTable({
      "order": [[ 0, "desc" ]],
      "lengthMenu": [[50,100,500, -1], [50,100,500, "Todos"]],   
      "language": {
        "url": "Componentes/Spanish.json"
		},
 
 
		
	  } 
	  
	  );
} );
</script>
<?php

include("db_connection.php");
include "Consultas.php";


$user_id=null;
$sql1="SELECT Solicitudes_Traspasos.ID_Sol_Traspaso,Solicitudes_Traspasos.Cod_Barra,Solicitudes_Traspasos.Nombre_Prod,
Solicitudes_Traspasos.Fk_sucursal, Solicitudes_Traspasos.Sucursal_Destino,Solicitudes_Traspasos.Fk_Sucursal_Destino,
  Solicitudes_Traspasos.Cantidad_Solicitada,Solicitudes_Traspasos.Estatus,Solicitudes_Traspasos.CodigoEstatus,
  Solicitudes_Traspasos.ID_H_O_D,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM
   SucursalesCorre,Solicitudes_Traspasos where Solicitudes_Traspasos.Fk_sucursal = SucursalesCorre.ID_SucursalC AND Solicitudes_Traspasos.Estatus='Solicitud enviada'  AND  Solicitudes_Traspasos.Sucursal_Destino = '".$row['Fk_Sucursal']."'
    AND Solicitudes_Traspasos.ID_H_O_D='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="Solicitudes" class="table table-hover">
<thead>

<th>Clave</th>
<th>Codigo de barras</th>
<th>Nombre producto</th>
<th>Sucursal origen</th>
    <th>Sucursal destino</th>
    <th>Estatus</th>

    


</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>

<td > <?php echo $Usuarios['ID_Sol_Traspaso']; ?></td>
<td > <?php echo $Usuarios['Cod_Barra']; ?></td>
<td > <?php echo $Usuarios['Nombre_Prod']; ?></td>
  <td > <?php echo $Usuarios['Nombre_Sucursal']; ?></td>
  <td > <?php echo $Usuarios['Fk_Sucursal_Destino']; ?>
  </td>
  <td >  <button class="btn btn-default btn-sm" style="<?echo $Usuarios['CodigoEstatus'];?>"><?php echo $Usuarios["Estatus"]; ?></button> </td>
  
   
	
		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">No hay disponibilidad <?echo $row['ID_H_O_D']?></p>
<?php endif;?>
  <!-- Modal -->
  <script>
  	$(".btn-editStock").click(function(){
  		id = $(this).data("id");
  		$.post("https://saludapos.com/POS2/Modales/SolicitaTraspaso.php","id="+id,function(data){
  			$("#form-editSolicitudesA").html(data);
          $("#TituloSolicitudesA").html("Solicitud de traspaso");
              $("#DiSolicitudesSA").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#DiSolicitudesSA").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#DiSolicitudesSA").removeClass("modal-dialog modal-lg modal-notify modal-primary");
              $("#DiSolicitudesSA").addClass("modal-dialog modal-lg modal-notify modal-success");
  		});
  		$('#editModalSolicitudesA').modal('show');
  	});
    
  </script>
  <div class="modal fade" id="editModalSolicitudesA" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalLabel" aria-hidden="true">
  <div id="DiSolicitudesSA"class="modal-dialog modal-lg modal-notify modal-info">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="TituloSolicitudesA"></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
        <div id="MensajeSolicitudesG"class="alert alert-info alert-styled-left text-blue-800 content-group">
						                <span id="Aviso" class="text-semibold">Estimado usuario, 
                            Verifique los campos antes de realizar alguna accion</span>
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
	        <div class="modal-body">
          <div class="text-center">
        <div id="form-editSolicitudesA"></div>
        
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->