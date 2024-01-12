<script type="text/javascript">
$(document).ready( function () {
    $('#MobiliariosPorAsignar').DataTable({
      "order": [[ 0, "desc" ]],
      "lengthMenu": [[30,100,200 -1], [30,100,200]],   
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
$sql1="SELECT Mobiliario_Asignado.ID_Mobiliario,Mobiliario_Asignado.Cod_Mobiliario,Mobiliario_Asignado.Nombre,Mobiliario_Asignado.Tipo,
Mobiliario_Asignado.Cantidad_Asignada,Mobiliario_Asignado.Fk_sucursal,Mobiliario_Asignado.Recibio,Mobiliario_Asignado.Estado,Mobiliario_Asignado.Cod_Estado,Mobiliario_Asignado.ID_H_O_D, SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM Mobiliario_Asignado,SucursalesCorre
WHERE Mobiliario_Asignado.Fk_sucursal = SucursalesCorre.ID_SucursalC AND  Mobiliario_Asignado.ID_H_O_D ='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="MobiliariosPorAsignar" class="table table-hover">
<thead>
<th>N°</th>
<th>Codigo mobiliario</th>
    <th>Nombre</th>
    <th>Tipo de mobiliario </th>
<th>Cantidad</th>
<th>Sucursal</th>
<th>Estado</th>
	<th >Accciones</th>
	


</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>

<td><?php echo $Usuarios['ID_Mobiliario']; ?></td>
<td > <?php echo $Usuarios['Cod_Mobiliario']; ?></td>

  <td > <?php echo $Usuarios['Nombre']; ?></td>
  <td > <?php echo $Usuarios['Tipo']; ?></td>
  <td > <?php echo $Usuarios['Cantidad_Asignada']; ?>  </td>
  <td > <?php echo $Usuarios['Nombre_Sucursal']; ?>  </td>
  <td> <button style="<?echo $Usuarios['Cod_Estado'];?>" class="btn btn-default btn-sm" > <?php echo $Usuarios["Estado"]; ?></button></td>
  
  <td>
		 <!-- Basic dropdown -->
<button class="btn btn-primary btn-sm dropdown-toggle " type="button" data-toggle="dropdown"
  aria-haspopup="true" aria-expanded="false"><i class="fas fa-list-ul"></i></button>

<div class="dropdown-menu">
<a data-id="<?php echo  $Usuarios["ID_Mobiliario"];?>" class="btn-editMedico dropdown-item" >Modificar asignacion <i class="fas fa-edit"></i></a>
<a data-id="<?php echo $Usuarios["ID_Mobiliario"];?>" class="btn-HistorialMedicos dropdown-item" >Movimientos <i class="fas fa-history" aria-hidden="true"></i></a>
 
 
 
 
</div>
<!-- Basic dropdown -->
	 </td>
	
		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">Aún no hay mobiliario asignado en ninguna sucursal de  <?echo $row['ID_H_O_D']?></p>
<?php endif;?>
  <!-- Modal -->
  <script>
  	$(".btn-Asignacion").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/AdminPOS/Modales/ReasignaProducto.php","id="+id,function(data){
  			$("#formMobiliariosV").html(data);
          $("#TituloMobiliarios").html("Asignacion de MobiliariosPorAsignar en otras sucursales");
              $("#DiMobiliariosV").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#DiMobiliariosV").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#DiMobiliariosV").removeClass("modal-dialog modal-lg modal-notify modal-primary");
              $("#DiMobiliariosV").addClass("modal-dialog  modal-lg modal-notify modal-success");
  		});
  		$('#editModalMobiliariosV').modal('show');
  	});
    $(".btn-edit2").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/AdministracionPOS/Modales/DetalleProducto.php","id="+id,function(data){
              $("#form-edit").html(data);
              $("#Titulo").html("Detalles del producto");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Di").addClass("modal-dialog modal-lg modal-notify modal-primary");
  		});
  		$('#editModal').modal('show');
    });
    $(".btn-HistorialMobiV").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/AdminPOS/Modales/HistorialMobiliariosV.php","id="+id,function(data){
  			$("#formMobiliariosV").html(data);
          $("#TituloMobiliarios").html("Movimientos realizados");
              $("#DiMobiliariosV").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#DiMobiliariosV").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#DiMobiliariosV").removeClass("modal-dialog modal-lg modal-notify modal-primary");
              $("#DiMobiliariosV").addClass("modal-dialog  modal-xl modal-notify modal-info");
  		});
  		$('#editModalMobiliariosV').modal('show');
  	});
  </script>
  <div class="modal fade" id="editModalMobiliariosV" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalLabel" aria-hidden="true">
  <div id="DiMobiliariosV"class="modal-dialog modal-lg modal-notify modal-info">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="TituloMobiliarios"></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
        <div id="MensajeMobiliariosPorAsignarG"class="alert alert-info alert-styled-left text-blue-800 content-group">
						                <span id="Aviso" class="text-semibold">Estimado usuario, 
                            Verifique los campos antes de realizar alguna accion</span>
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
	        <div class="modal-body">
          <div class="text-center">
        <div id="formMobiliariosV"></div>
        
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <?

function fechaCastellano ($fecha) {
  $fecha = substr($fecha, 0, 10);
  $numeroDia = date('d', strtotime($fecha));
  $dia = date('l', strtotime($fecha));
  $mes = date('F', strtotime($fecha));
  $anio = date('Y', strtotime($fecha));
  $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
  $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
  $nombredia = str_replace($dias_EN, $dias_ES, $dia);
$meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
  $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
  $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
  return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
}
?>