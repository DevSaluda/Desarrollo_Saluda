<script type="text/javascript">
$(document).ready( function () {
    $('#CajasSucursalesAbiertas').DataTable({
      "order": [[ 0, "desc" ]],
      "info": false,
      "lengthMenu": [[10,50,200, -1], [10,50,200, "Todos"]],   
      "language": {
        "url": "Componentes/Spanish.json"
		},
 
    
		
	  } 
	  
	  );
} );
</script>
<?php

include ("db_connection.php");
include "Consultas.php";
include "Sesion.php";

$user_id=null;
$sql1="SELECT Solicitudes_Traspasos.ID_Sol_Traspaso,Solicitudes_Traspasos.Cod_Barra,Solicitudes_Traspasos.Nombre_Prod,Solicitudes_Traspasos.Motivo_Solicitud,
Solicitudes_Traspasos.Fk_sucursal, Solicitudes_Traspasos.Sucursal_Destino,Solicitudes_Traspasos.Fk_Sucursal_Destino,
  Solicitudes_Traspasos.Cantidad_Solicitada,Solicitudes_Traspasos.Estatus,Solicitudes_Traspasos.CodigoEstatus,
  Solicitudes_Traspasos.ID_H_O_D,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM
   SucursalesCorre,Solicitudes_Traspasos where Solicitudes_Traspasos.Fk_sucursal = SucursalesCorre.ID_SucursalC AND  Solicitudes_Traspasos.Estatus='Solicitud Enviada'
    AND Solicitudes_Traspasos.ID_H_O_D='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>

<!-- Central Modal Medium Info -->
<div class="modal fade" id="ConsultaCajas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-="true" style="overflow-y: scroll;">
   <div class="modal-dialog modal-xl modal-notify modal-success" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div class="modal-header">
         <p class="heading lead">Cajas abiertas</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-="true" class="white-text">&times;</span>
         </button>
       </div>
     
       <!--Body-->
       <div class="modal-body">
         <div class="text-center">
         <?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="CajasSucursalesAbiertas" class="table table-hover">
<thead>
<th>Clave</th>
<th>Codigo de barras</th>
<th>Nombre producto</th>
<th>Motivo de solicitud</th>
<th>Sucursal origen</th>
    <th>Sucursal destino</th>
    <th>Estatus</th>
 

    


</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>

<td > <?php echo $Usuarios['ID_Sol_Traspaso']; ?></td>
<td > <?php echo $Usuarios['Cod_Barra']; ?></td>
<td > <?php echo $Usuarios['Nombre_Prod']; ?></td>
<td > <?php echo $Usuarios['Motivo_Solicitud']; ?></td>

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
	<p class="alert alert-warning">No hay caja abierta</p>
<?php endif;?>                
<script>
  	
    $(".btn-Detalles").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/AdminPOS/Modales/DetallesCaja.php","id="+id,function(data){
              $("#FormCajas").html(data);
              $("#TitulosCajas").html("Detalles de apertura de caja");
              $("#CajasDi").addClass("modal-dialog modal-xl modal-notify modal-info");
  		});
  		$('#ModalDetallesCaja').modal('show');
    });

    $(".btn-Movimientos").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/AdminPOS/Modales/HistorialCaja.php","id="+id,function(data){
              $("#FormCajas").html(data);
              $("#TitulosCajas").html("Historial de caja");
              $("#CajasDi").removeClass("modal-dialog modal-xl modal-notify modal-info");
              $("#CajasDi").addClass("modal-dialog modal-xl modal-notify modal-primary");
  		});
  		$('#ModalDetallesCaja').modal('show');
    });

    
    $(".btn-Ventas").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/AdminPOS/Modales/HistorialVentas.php","id="+id,function(data){
              $("#FormCajas").html(data);
              $("#TitulosCajas").html("Historial de ventas");
              $("#CajasDi").removeClass("modal-dialog modal-xl modal-notify modal-info");
              $("#CajasDi").removeClass("modal-dialog modal-xl modal-notify modal-primary");
              $("#CajasDi").addClass("modal-dialog modal-xl modal-notify modal-success");
  		});
  		$('#ModalDetallesCaja').modal('show');
    });
  </script>
  <div class="modal fade" id="ModalDetallesCaja" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="ModalDetallesCajaLabel" aria-hidden="true">
  <div id="CajasDi"class="modal-dialog  modal-notify modal-success" >
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="TitulosCajas"></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
        <div id="Mensaje "class="alert alert-info alert-styled-left text-blue-800 content-group">
						                <span id="Aviso" class="text-semibold"><?echo $row['Nombre_Apellidos']?>
                            Verifique los campos antes de realizar alguna accion</span>
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
	        <div class="modal-body">
          <div class="text-center">
        <div id="FormCajas"></div>
        
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
       </div>
     </div>
     <!--/.Content-->
   </div>
 </div>
 </div>
 </div>

