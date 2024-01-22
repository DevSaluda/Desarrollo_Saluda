<script type="text/javascript">
$(document).ready( function () {
    $('#CreditosPorVencer').DataTable({
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
<?php

include("db_connection.php");
include "Consultas.php";


$user_id=null;
$sql1="SELECT Creditos_POS.Folio_Credito,Creditos_POS.Fk_tipo_Credi,Creditos_POS.Nombre_Cred,
Creditos_POS.Cant_Apertura,Creditos_POS.Costo_Tratamiento,Creditos_POS.Fk_Sucursal,Creditos_POS.Validez,
Creditos_POS.Saldo,Creditos_POS.Promocion,Creditos_POS.Costo_Descuento, Creditos_POS.Estatus,
Creditos_POS.CodigoEstatus,Creditos_POS.ID_H_O_D,Tipos_Credit_POS.ID_Tip_Cred, 
Tipos_Credit_POS.Nombre_Tip,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM Creditos_POS,Tipos_Credit_POS,SucursalesCorre WHERE
 Creditos_POS.Fk_tipo_Credi=Tipos_Credit_POS.ID_Tip_Cred AND Creditos_POS.Fk_Sucursal = SucursalesCorre.ID_SucursalC 
  AND Creditos_POS.Saldo !=0.00   AND Creditos_POS.Fk_Sucursal='".$row['Fk_Sucursal']."' AND Creditos_POS.Validez = CURDATE() + INTERVAL 7 DAY AND Creditos_POS.ID_H_O_D='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
 
  <div class="text-center">
	<div class="table-responsive">
	<table  id="CreditosPorVencer" class="table table-hover">
<thead>
  
    <th>N°</th>
    <th>Tipo de credito</th>
    <th>Titular</th>
    <th>Sucursal</th>
    <th>Costo tratamiento</th>
    <th>Promocion</th>
    <th>Descuento promocion</th>
    <th>Costo total</th>
    <th>Saldo</th>

    <th>Validez</th>
    
	


</thead>
<?php while ($Categorias=$query->fetch_array()):?>
<tr>
<td > <?php echo $Categorias["Folio_Credito"]; ?></td>
  <td > <?php echo $Categorias["Nombre_Tip"]; ?></td>
  <td > <?php echo $Categorias["Nombre_Cred"]; ?></td>
  <td > <?php echo $Categorias["Nombre_Sucursal"]; ?></td>
  <td > $<?php echo $Categorias["Costo_Tratamiento"]; ?></td>
  <td > <?php echo $Categorias["Promocion"]; ?></td>

  <td > $<?php echo $Categorias["Costo_Descuento"]; ?></td>
  
  <td > $<?php echo $Categorias["Cant_Apertura"]; ?></td>
  <td > $<?php echo $Categorias["Saldo"]; ?></td>
  <td ><?php echo fechaCastellano($Categorias["Validez"]); ?></td>
  
 
 
		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">No hay créditos por vencer</p>
<?php endif;?>

<?php

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