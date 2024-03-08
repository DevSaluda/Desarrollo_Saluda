
<script type="text/javascript">
$(document).ready( function () {
    var printCounter = 0;
    $('#VEntas').DataTable({
      "order": [[ 0, "desc" ]],
      "lengthMenu": [[25,50, 150, 200, -1], [25,50, 150, 200, "Todos"]],   
        language: {
            "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
			     },
			     "sProcessing":"Procesando...",
            },
          
        //para usar los botones   
        responsive: "true",
        dom: "<'#colvis row'><'row'><'row'<'col-md-6'l><'col-md-6'f>r>t<'bottom'ip><'clear'>'",
        
   
	   
        	        
    });     
});
   
	  
	 
</script>
<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";

$user_id=null;
$sql1= "SELECT * FROM Ventas_POS WHERE Fecha_venta=CURDATE() and FormaDePago=''";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>

    <form action="javascript:void(0)" method="post" id="ActualizaFormaPago">
        
  <div class="text-center">
  <button type="submit"  id="EnviaDatosSincroniza" value="Guardar" class="btn btn-success">Ajustar <i class="fas fa-dolly-flatbed"></i></button>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="VEntas" class="table table-hover">
<thead>

<th>N ID</th>
<th>N° Ticket</th>
<th>Fecha | Hora</th>
    <th>Vendedor</th>
    <th>Acciones</th>
    


</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>


<td><input type="text" readonly value="<?php echo $Usuarios["Venta_POS_ID"]; ?>" name="codigo[]" class="form-control">  </td>
    <td><?php echo $Usuarios["Folio_Ticket"]; ?></td>
    
    
      <td><?php echo fechaCastellano($Usuarios["AgregadoEl"]); ?> <br>
      <?php echo date("g:i a",strtotime($Usuarios["AgregadoEl"])); ?>
    </td>
    <td><?php echo $Usuarios["AgregadoPor"]; ?></button></td>
  <td>
      <input class="form-control" name="formapago[]" type="text">
  </td>
   
</tr>
<?php endwhile;?>
</form>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">No hay resultados</p>
<?php endif;?>

<script src="js/ActualizaCoincideciasFormaPago.js"></script>
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
