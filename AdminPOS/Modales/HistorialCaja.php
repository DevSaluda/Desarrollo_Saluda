<?php $fcha = date("Y-m-d");?>
<script type="text/javascript">
$(document).ready( function () {
    var printCounter = 0;
    $('#HistorialCajas').DataTable({
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
        dom: "B<'#colvis row'><'row'><'row'<'col-md-6'><'col-md-6'>><'bottom'><'clear'>'",
          buttons:[ 
			{
				extend:    'excelHtml5',
				text:      'Exportar a Excel  <i Exportar a Excel class="fas fa-file-excel"></i> ',
                titleAttr: 'Exportar a Excel',
                title: 'MovimientosDeEmpleados ',
				className: 'btn btn-success'
			},
			{
				extend:    'pdfHtml5',
				text:      'Exportar a PDF <i class="fas fa-file-pdf"></i> ',
				titleAttr: 'Exportar a PDF',
                className: 'btn btn-danger ',
                title: 'MovimientosDeEmpleados ',
			},
			
          
            
        ],
   
	   
        	        
    });     
});
   
	  
	 
</script>
<?php
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";


$user_id=null;
$sql1= "SELECT Cajas_POS_Audita.ID_Caja,Cajas_POS_Audita.Cantidad_Fondo,Cajas_POS_Audita.Empleado,Cajas_POS_Audita.Sucursal,Cajas_POS_Audita.Estatus,Cajas_POS_Audita.CodigoEstatus,
Cajas_POS_Audita.Fecha_Apertura,Cajas_POS_Audita.Valor_Total_Caja,Cajas_POS_Audita.ID_H_O_D,Cajas_POS_Audita.Valor_Total_Caja,Cajas_POS_Audita.Hora_apertura,
SucursalesCorre.ID_SucursalC, SucursalesCorre.Nombre_Sucursal 
FROM Cajas_POS_Audita,SucursalesCorre where Cajas_POS_Audita.Sucursal = SucursalesCorre.ID_SucursalC  AND
Cajas_POS_Audita.Estatus='Abierta'AND Cajas_POS_Audita.ID_H_O_D='".$row['ID_H_O_D']."' AND Cajas_POS_Audita.ID_Caja = ".$_POST["id"];
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="HistorialCajas" class="table table-hover">
<thead>

<th>Empleado</th>

    <th>Fondo asignado</th>
    <th>Sucursal</th>
    

<th>Vigencia</th>

<th>Hora</th>
<th>Fecha</th>

<th>Total actual</th>


</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>

<td > <?php echo $Usuarios["Empleado"]; ?></td>
  <td > <?php echo $Usuarios["Cantidad_Fondo"]; ?></td>
    <td><?php echo $Usuarios["Nombre_Sucursal"]; ?></td>
      <td><?php echo $Usuarios["Estatus"]; ?></button></td>
     
        <td><?php echo date("g:i a",strtotime($Usuarios["Hora_apertura"])); ?></td>
        <td><?php echo fechaCastellano($Usuarios["Fecha_Apertura"]); ?></td>
        <td><?php echo $Usuarios["Valor_Total_Caja"]; ?></td>
        
     
      
   
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">No hay resultados</p>
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