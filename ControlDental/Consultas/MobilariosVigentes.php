<script type="text/javascript">
$(document).ready( function () {
    $('#Productos').DataTable({
      "order": [[ 0, "desc" ]],
      "lengthMenu": [[50,100,500, -1], [50,100,500, "Todos"]],   
      "language": {
        "url": "Componentes/Spanish.json"
		},
 
 
		
	  } 
	  
	  );
} );
$('#Productos_filter input').focus();
</script>
<?php

include("db_connection.php");
include "Consultas.php";
include "Sesion.php";

$user_id=null;
$sql1="SELECT Inventarios_Clinicas.ID_Inv_Clic,Inventarios_Clinicas.Cod_Equipo,Inventarios_Clinicas.Cod_Equipo_Repetido,Inventarios_Clinicas.Cantidad_Mobil,
Inventarios_Clinicas.FK_Tipo_Mob,Inventarios_Clinicas.Nombre_equipo,Inventarios_Clinicas.Descripcion,Inventarios_Clinicas.ID_H_O_D,
Inventarios_Clinicas.Fecha_Ingreso,Inventarios_Clinicas.Estatus,Inventarios_Clinicas.CodigoEstatus,
Tipos_Mobiliarios_POS.Tip_Mob_ID,Tipos_Mobiliarios_POS.Nom_Tip_Mob from Inventarios_Clinicas,Tipos_Mobiliarios_POS 
WHERE Inventarios_Clinicas.FK_Tipo_Mob=Tipos_Mobiliarios_POS.Tip_Mob_ID AND Inventarios_Clinicas.ID_H_O_D ='".$row['ID_H_O_D']."' ";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="Productos" class="table table-hover">
<thead>

<th>Codigo mobiliario</th>
    <th>Nombre</th>
    <th>Tipo de mobiliario </th>
<th>Descripcion</th>
<th>Cantidad</th>
<th>Fecha ingreso</th>
<th>Estatus</th>
	<th >Accciones</th>
	


</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>
<td > <?php echo $Usuarios['Cod_Equipo']; ?> <br><?php echo $Usuarios['Cod_Equipo_Repetido']; ?></td>

  <td > <?php echo $Usuarios['Nombre_equipo']; ?></td>
  <td > <?php echo $Usuarios['Nom_Tip_Mob']; ?></td>
  <td > <?php echo $Usuarios['Descripcion']; ?>  </td>
  <td > <?php echo $Usuarios['Cantidad_Mobil']; ?>  </td>
  <td > <?php echo fechaCastellano($Usuarios['Fecha_Ingreso']); ?>  </td>
  
  
  

  <td >  <button class="btn btn-default btn-sm" style="<?echo $Usuarios['CodigoEstatus'];?>"><?php echo $Usuarios["Estatus"]; ?></button> </td>
    <td>
		 <!-- Basic dropdown -->
<button class="btn btn-primary btn-sm  dropdown-toggle " type="button" data-toggle="dropdown"
  aria-haspopup="true" aria-expanded="false"><i class="fas fa-th-list fa-1x"></i></button>

<div class="dropdown-menu">
<a data-id="<?php echo $Usuarios["ID_Inv_Clic"];?>" class="btn-edit2 dropdown-item" >Editar datos <i class="fas fa-pencil-alt"></i></a>
  <a data-id="<?php echo $Usuarios["ID_Inv_Clic"];?>" class="btn-edit3 dropdown-item" >Detalles <i class="fas fa-info-circle"></i></a>
  <a data-id="<?php echo $Usuarios["ID_Inv_Clic"];?>" class="btn-HistorialMobiV dropdown-item" >Movimientos <i class="fas fa-history"></i></a>
  <a data-id="<?php echo $Usuarios["ID_Inv_Clic"];?>" class="btn-HistorialMobiV dropdown-item" >Movimientos de asignacion <i class="fas fa-history"></i></a>
 
 
 
</div>
<!-- Basic dropdown -->
	 </td>
	
		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">Aún no hay mobiliario registrado para  <?echo $row['ID_H_O_D']?></p>
<?php endif;?>
  <!-- Modal -->
  <script>
  	$(".btn-Asignacion").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/AdminPOS/Modales/ReasignaProducto.php","id="+id,function(data){
  			$("#formMobiliariosV").html(data);
          $("#TituloMobiliarios").html("Asignacion de productos en otras sucursales");
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
        <div id="MensajeProductosG"class="alert alert-info alert-styled-left text-blue-800 content-group">
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