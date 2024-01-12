
<script type="text/javascript">
$(document).ready( function () {
    
    $('#TicketsCanceladosTotal').DataTable({
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
$sql1= "SELECT DISTINCT Ventas_POS_Cancelaciones.Fk_Caja,Ventas_POS_Cancelaciones.Venta_POS_ID,Ventas_POS_Cancelaciones.Folio_Ticket,Ventas_POS_Cancelaciones.Fk_sucursal,Ventas_POS_Cancelaciones.AgregadoPor,Ventas_POS_Cancelaciones.AgregadoEl,
Ventas_POS_Cancelaciones.Motivo_Cancelacion,Ventas_POS_Cancelaciones.Estatus,Ventas_POS_Cancelaciones.AgregadoPor,
Ventas_POS_Cancelaciones.Total_Venta,Ventas_POS_Cancelaciones.Lote,Ventas_POS_Cancelaciones.ID_H_O_D,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM 
Ventas_POS_Cancelaciones,SucursalesCorre WHERE Ventas_POS_Cancelaciones.Fk_sucursal= SucursalesCorre.ID_SucursalC  AND Ventas_POS_Cancelaciones.ID_H_O_D ='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="TicketsCanceladosTotal" class="table table-hover">
<thead>


<th>N° Ticket</th>
    <th>Sucursal</th>
    <th>Vendedor</th>
    <th>Motivo cancelación</th>
    <th>Estatus</th>
    <th>Fecha|Hora</th>
 



</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>



    <td><?php echo $Usuarios["Folio_Ticket"]; ?></td>
      <td><?php echo $Usuarios["Nombre_Sucursal"]; ?></td>
      <td><?php echo $Usuarios["AgregadoPor"]; ?></td>
      <td><?php echo $Usuarios["Motivo_Cancelacion"]; ?></td>
      <td><button style="<?php if($Usuarios["Estatus"] == "Cancelacion"){
   echo "background-color:#131211 !important";
} ?>"class="btn btn-default btn-sm" ><?php if($Usuarios["Estatus"] == "Cancelacion"){
  echo "Cancelado";
} ?></button></td>
      <td><?php echo fechaCastellano($Usuarios["AgregadoEl"]); ?> <br>
      <?php echo date("g:i a",strtotime($Usuarios["AgregadoEl"])); ?>
    </td>
  
    
   
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">No hay resultados</p> 
<?php endif;?>
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