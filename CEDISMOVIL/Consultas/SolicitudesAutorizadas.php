
<script type="text/javascript">
$(document).ready( function () {
    $('#SolicitudesAutorizadas').DataTable({
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
include "Sesion.php";

$user_id=null;
$sql1="SELECT Solicitudes_Traspasos.ID_Sol_Traspaso,Solicitudes_Traspasos.Cod_Barra,Solicitudes_Traspasos.Nombre_Prod,Solicitudes_Traspasos.Motivo_Solicitud,
Solicitudes_Traspasos.Fk_sucursal, Solicitudes_Traspasos.Sucursal_Destino,Solicitudes_Traspasos.Fk_Sucursal_Destino,
  Solicitudes_Traspasos.Cantidad_Solicitada,Solicitudes_Traspasos.Estatus,Solicitudes_Traspasos.CodigoEstatus,
  Solicitudes_Traspasos.ID_H_O_D,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM
   SucursalesCorre,Solicitudes_Traspasos where Solicitudes_Traspasos.Fk_sucursal = SucursalesCorre.ID_SucursalC AND  Solicitudes_Traspasos.Estatus='Autorizado'
    AND Solicitudes_Traspasos.ID_H_O_D='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="SolicitudesAutorizadas" class="table table-hover">
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
  <td >  <button class="btn btn-default btn-sm" style=<?if($Usuarios["Estatus"] =="Autorizado"){
   echo "background-color:#00c851!important";
} else {
   echo "background-color:#fd7e14!important";
}?>><?if($Usuarios["Estatus"] =="Autorizado"){
    echo "Autorizado";
 } else {
    echo "Error";
 }?></button> </td>

</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">Aún no hay solicitudes de <?echo $row['ID_H_O_D']?></p>
<?php endif;?>
  <!-- Modal -->
  <script>
  	$(".btn-Detalles").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/AdminPOS/Modales/DetallesTraspaso.php","id="+id,function(data){
  			$("#FormTraspasos").html(data);
          $("#TituloTraspaso").html("Detalles de solicitud");
              $("#DiTraspaso").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#DiTraspaso").removeClass("modal-dialog modal-notify modal-warning");
              $("#DiTraspaso").addClass("modal-dialog  modal-notify modal-primary");
  		});
  		$('#ModalTraspaso').modal('show');
  	});
    $(".btn-AutorizaRechaza").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/AdminPOS/Modales/AutorizaRechazaTraspaso.php","id="+id,function(data){
  			$("#FormTraspasos").html(data);
          $("#TituloTraspaso").html("Autorizacion / rechazar solicitud");
              $("#DiTraspaso").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#DiTraspaso").removeClass("modal-dialog  modal-notify modal-primary");
              $("#DiTraspaso").addClass("modal-dialog modal-notify modal-warning");
  		});
  		$('#ModalTraspaso').modal('show');
  	});
  </script>
  <div class="modal fade" id="ModalTraspaso" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalLabel" aria-hidden="true">
  <div id="DiTraspaso"class="modal-dialog modal-lg modal-notify modal-info">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="TituloTraspaso"></p>

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
        <div id="FormTraspasos"></div>
        
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->