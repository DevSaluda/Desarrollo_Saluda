<script type="text/javascript">
$(document).ready( function () {
    $('#CajasSincronizadasDia').DataTable({
      "order": [[ 0, "desc" ]],
      bFilter: false,
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

include("db_connection.php");
include "Consultas.php";
include "Sesion.php";

$user_id=null;
$sql1="SELECT Sincronizacion_Cajas.ID_Caja,Sincronizacion_Cajas.Cantidad_Fondo,Sincronizacion_Cajas.Empleado,Sincronizacion_Cajas.Sucursal,Sincronizacion_Cajas.Estatus,Sincronizacion_Cajas.CodigoEstatus,
Sincronizacion_Cajas.Fecha_Apertura,Sincronizacion_Cajas.Valor_Total_Caja,Sincronizacion_Cajas.ID_H_O_D, SucursalesCorre.ID_SucursalC, SucursalesCorre.Nombre_Sucursal 
FROM Sincronizacion_Cajas,SucursalesCorre where Sincronizacion_Cajas.Sucursal = SucursalesCorre.ID_SucursalC AND Sincronizacion_Cajas.Fecha_Apertura = CURRENT_DATE()  AND
Sincronizacion_Cajas.Estatus='Abierta'AND Sincronizacion_Cajas.ID_H_O_D='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="CajasSincronizadasDia" class="table table-hover">
<thead>
<th>Empleado</th>
<th>Sucursal</th>
<th>Cantidad inicial</th>
<th>Fecha</th>
<th>Estatus</th>
    <th >Cantidad actual</th>
    <th >Acciones</th>
	


</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>

    <td> <?php echo $Usuarios["Empleado"]; ?></td>
    <td> <?php echo $Usuarios["Nombre_Sucursal"]; ?></td>
    <td> <?php echo $Usuarios["Cantidad_Fondo"]; ?></td>
    <td> <?php echo $Usuarios["Fecha_Apertura"]; ?></td>
    <td> <button style="<?echo $Usuarios['CodigoEstatus'];?>" class="btn btn-default btn-sm" > <?php echo $Usuarios["Estatus"]; ?></button></td>
    <td> <?php echo $Usuarios["Valor_Total_Caja"]; ?></td>
    <td>
		 <!-- Basic dropdown -->
<button class="btn btn-primary dropdown-toggle " type="button" data-toggle="dropdown"
  aria-haspopup="true" aria-expanded="false"><i class="fas fa-th-list fa-1x"></i></button>

<div class="dropdown-menu">
<a data-id="<?php echo $Usuarios["ID_Caja"];?>" class="btn-Detalles dropdown-item" >Detalles <i class="fas fa-address-card"></i></a>
<a data-id="<?php echo $Usuarios["ID_Caja"];?>" class="btn-Movimientos dropdown-item" >Historial caja <i class="fas fa-address-card"></i></a>
<a data-id="<?php echo $Usuarios["ID_Caja"];?>" class="btn-Ventas dropdown-item" >Ventas realizadas en caja<i class="fas fa-pencil-alt"></i></a>
 
 
 
 
</div>
<!-- Basic dropdown -->
	 </td>

	 
		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">No hay caja abierta</p>
<?php endif;?>
  <!-- Modal -->
  <script>
  	
    $(".btn-Detalles").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/AdminPOS/Modales/DetallesCajaSincronizada.php","id="+id,function(data){
              $("#FormCajas").html(data);
              $("#TitulosCajas").html("Detalles de apertura de caja");
              $("#CajasDi").addClass("modal-dialog modal-xl modal-notify modal-info");
  		});
  		$('#ModalDetallesCaja').modal('show');
    });

    $(".btn-Movimientos").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/AdminPOS/Modales/HistorialCajaSincronizada.php","id="+id,function(data){
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