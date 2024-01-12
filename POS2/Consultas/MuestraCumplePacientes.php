<script type="text/javascript">
$(document).ready( function () {
    $('#StockSucursales').DataTable({
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
$sql1=" SELECT ID_Data_Paciente, Nombre_Paciente FROM `Data_Pacientes` WHERE day(`Fecha_Nacimiento`)=day(NOW()) and month (`Fecha_Nacimiento`) = month(NOW())";

$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	
  <table  id="StockSucursales" class="table table-hover">

    <thead>
      <th>ID</th>
      <th>Nombre</th>
      <th>Acciones</th>   
    </thead>

<?php while ($Cumples=$query->fetch_array()):?>

      <tr>
         <td > <?php echo $Cumples['ID_Data_Paciente']; ?></td>
        <td > <?php echo $Cumples['Nombre_Paciente']; ?></td>
    
        <td>
               <!-- Basic dropdown -->
        <button class="btn btn-primary dropdown-toggle " type="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false"><i class="fas fa-list-ul"></i></button>

        <div class="dropdown-menu">
        <a data-id="<?php echo $Cumples["Folio_Ticket"];?>" class="btn-desglose dropdown-item" >Enviar Mensaje <i class="fas fa-comment-dots"></i></a>
        <a data-id="<?php echo $Cumples["Folio_Ticket"];?>" class="btn-Reimpresion dropdown-item" >Llamar Paciente <i class="fas fa-phone"></i></a> 
        </div>
        <!-- Basic dropdown -->
        </td>
      </tr>

      <?php endwhile;?>
</table>
</div>

</div>
<?php else:?>
	<p class="alert alert-warning">Null </p>
<?php endif;?>
  <!-- Modal -->
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