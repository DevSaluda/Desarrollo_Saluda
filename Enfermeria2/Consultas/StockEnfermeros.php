<script type="text/javascript">
$(document).ready( function () {
    $('#SignosVitales').DataTable({
      "order": [[ 0, "desc" ]],
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
$sql1="SELECT Ventas_POS.Nombre_Prod,Ventas_POS.Cod_Barra,Ventas_POS.Cantidad_Venta,Ventas_POS.Fk_sucursal, COUNT(*) 
as existencias,Ventas_POS.Importe,Ventas_POS.FormaDePago,Ventas_POS.ID_H_O_D, SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal 
FROM SucursalesCorre, Ventas_POS Where FormaDePago ='Credito Enfermería' AND SucursalesCorre.ID_SucursalC= Ventas_POS.Fk_sucursal AND 
Ventas_POS.Fk_sucursal = '".$row['Fk_Sucursal']."' GROUP by Ventas_POS.Nombre_Prod,Ventas_POS.Fk_sucursal";  
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  
	<div class="table-responsive">
    
	<table id="SignosVitales" class="table ">
<thead>
    
<th>Codigo barras</th>
<th>Nombre del producto</th>
<th>Existencias</th>
<th>Costo</th>
    <th>Sucursal</th>
   
	
	


</thead>
<?php while ($DataPacientes=$query->fetch_array()):?>
<tr>

    <td><?php echo $DataPacientes["Cod_Barra"]; ?></td>
    <td><?php echo $DataPacientes["Nombre_Prod"]; ?></td>
     <td><?php echo $DataPacientes["existencias"]; ?></td>
     <td><?php echo $DataPacientes["Importe"]; ?></td>
    <td><?php echo $DataPacientes["Nombre_Sucursal"]; ?></td>
   
  
		
</tr>
<?php endwhile;?>
</table>
</div>
<?php else:?>
	<p class="alert alert-warning">Aún no hay pacientes registrados</p>
<?php endif;?>
  <!-- Modal -->
  <script>
  	$(".btn-edit").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlconsulta.com/Enfermeria2/Modales/ConfirmaDatosP.php","id="+id,function(data){
  			$("#form-edit").html(data);
  		});
  		$('#editModal').modal('show');
  	});
  </script>
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
		<h4 class="modal-title">Editar Sucursal</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      
		</div>
		<span id="error_actualiza" class="alert alert-danger" style="display: none"></span>
	

        <p id="show_error"  class="alert alert-danger" style="display: none">No se puede completar la acción, por favor intenta de nuevo</p>
        <div class="modal-body">
        <div id="form-edit"></div>
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