<script type="text/javascript">
$(document).ready( function () {
    $('#TiposDeProductos').DataTable({
      "order": [[ 0, "desc" ]],
      "lengthMenu": [[25,50,150,200, -1], [25,50,150,200, "Todos"]],   
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
$sql1="SELECT * FROM TipProd_POS WHERE ID_H_O_D ='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="TiposDeProductos" class="table table-hover">
<thead>

<th style= "background-color: #0057b8 !important;">Folio</th>
<th style= "background-color: #0057b8 !important;">Nombre de tipo</th>
<th style= "background-color: #0057b8 !important;">Estatus</th>
<th style= "background-color: #0057b8 !important;">Agregado el</th>
<th style= "background-color: #0057b8 !important;">Accciones</th>
	


</thead>
<?php while ($TiposProd=$query->fetch_array()):?>
<tr>
<td > <?php echo $TiposProd['Tip_Prod_ID']; ?></td>
  <td > <?php echo $TiposProd['Nom_Tipo_Prod']; ?></td>
  <td >  <button class="btn btn-default btn-sm" style="<?echo $TiposProd['Cod_Estado'];?>"><?php echo $TiposProd["Estado"]; ?></button> </td>
  <td > <?php echo fechaCastellano($TiposProd['Agregadoel']); ?></td> 
    <td>
   
		 <!-- Basic dropdown -->
<button class="btn btn-primary  dropdown-toggle " type="button" data-toggle="dropdown"
  aria-haspopup="true" aria-expanded="false"><i class="fas fa-th-list fa-1x"></i></button>

<div class="dropdown-menu">
<a data-id="<?php echo $TiposProd["Tip_Prod_ID"];?>" class="btn-editProd dropdown-item" >Editar datos <i class="fas fa-pencil-alt"></i></a>
  <a data-id="<?php echo $TiposProd["Tip_Prod_ID"];?>" class="btn-editDetailProd dropdown-item" >Detalles <i class="fas fa-info-circle"></i></a>
  <a data-id="<?php echo $TiposProd["Tip_Prod_ID"];?>" class="btn-historialTiPoProd dropdown-item">Movimientos <i class="fas fa-history"></i></a>
 
 
 
</div>
<!-- Basic dropdown -->
	 </td>
	
		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">Aún no hay tipos productos registrados para <?echo $row['ID_H_O_D']?></p>
<?php endif;?>
  <!-- Modal -->
  <script>
  	$(".btn-editProd").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/AdminPOS/Modales/EditaTipoProducto.php","id="+id,function(data){
  			$("#form-editTP").html(data);
          $("#TituloTP").html("Editar tipo de productos");
              $("#DiTP").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#DiTP").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#DiTP").removeClass("modal-dialog modal-lg modal-notify modal-primary");
              $("#DiTP").removeClass("modal-dialog modal-xl modal-notify modal-primary");
              $("#DiTP").addClass("modal-dialog  modal-notify modal-info");
  		});
  		$('#editModalTP').modal('show');
  	});
    $(".btn-editDetailProd").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/AdminPOS/Modales/DetalleTipoProducto.php","id="+id,function(data){
              $("#form-editTP").html(data);
              $("#TituloTP").html("Detalles del tipo de producto");
              $("#DiTP").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#DiTP").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#DiTP").removeClass("modal-dialog modal-xl modal-notify modal-primary");
              $("#DiTP").addClass("modal-dialog  modal-notify modal-primary");
  		});
  		$('#editModalTP').modal('show');
    });

    $(".btn-historialTiPoProd").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/AdminPOS/Modales/HistorialTiposProducto.php","id="+id,function(data){
              $("#form-editTP").html(data);
              $("#TituloTP").html("Actualizaciones y cambios en tipos de productos");
              $("#DiTP").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#DiTP").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#DiTP").addClass("modal-dialog modal-xl modal-notify modal-primary");
  		});
  		$('#editModalTP').modal('show');
    });
  </script>
  <div class="modal fade" id="editModalTP" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalLabel" aria-hidden="true">
  <div id="DiTP"class="modal-dialog modal-lg modal-notify modal-info">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="TituloTP"></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
        <div id="Mensaje "class="alert alert-info alert-styled-left text-blue-800 content-group">
						                <span id="Aviso" class="text-semibold"><i class="fas fa-info-circle"></i><?echo $row['Nombre_Apellidos']?>, 
                            Verifique los campos antes de realizar alguna accion</span>
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
	        <div class="modal-body">
          <div class="text-center">
        <div id="form-editTP"></div>
        
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal --><?

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