
<script type="text/javascript">
$(document).ready( function () {
    var printCounter = 0;
    $('#DatosCajasApertua').DataTable({
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
<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";

$user_id=null;
$sql1= "SELECT Cajas_POS.ID_Caja,Cajas_POS.Cantidad_Fondo,Cajas_POS.Empleado,Cajas_POS.Sucursal,Cajas_POS.Estatus,Cajas_POS.CodigoEstatus,
Cajas_POS.Fecha_Apertura,Cajas_POS.Valor_Total_Caja,Cajas_POS.ID_H_O_D,Cajas_POS.D1000,Cajas_POS.D500,Cajas_POS.D200,Cajas_POS.D100,Cajas_POS.D50, 
Cajas_POS.D20,Cajas_POS.D10,Cajas_POS.D5,Cajas_POS.D2,Cajas_POS.D1,Cajas_POS.D50C,Cajas_POS.D20C,Cajas_POS.D10C,Cajas_POS.Hora_apertura,
SucursalesCorre.ID_SucursalC, SucursalesCorre.Nombre_Sucursal 
FROM Cajas_POS,SucursalesCorre where Cajas_POS.Sucursal = SucursalesCorre.ID_SucursalC  AND
Cajas_POS.Estatus='Abierta'AND Cajas_POS.ID_H_O_D='".$row['ID_H_O_D']."' AND Cajas_POS.ID_Caja = ".$_POST["id"];
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="DatosCajasApertura" class="table table-hover">
<thead>

<th>Empleado</th>

    <th>Fondo asignado</th>
    <th>Sucursal</th>
    

<th>Vigencia</th>
<th>$1000</th>
<th>$500</th>
<th>$200</th>
<th>$100</th>
<th>$50</th>
<th>$20</th>
<th>$10</th>
<th>$5</th>
<th>$2</th>
<th>$1</th>
<th>$50 C</th>	
<th>$20 C</th>
<th>$10 C</th>
<th>Hora</th>
<th>Fecha</th>




</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>

<td > <?php echo $Usuarios["Empleado"]; ?></td>
  <td > <?php echo $Usuarios["Cantidad_Fondo"]; ?></td>
    <td><?php echo $Usuarios["Nombre_Sucursal"]; ?></td>
      <td><?php echo $Usuarios["Estatus"]; ?></button></td>
      <td><?php echo $Usuarios["D1000"]; ?></td>
      <td><?php echo $Usuarios["D500"]; ?></td>     
      <td><?php echo $Usuarios["D200"]; ?></td>
      <td><?php echo $Usuarios["D100"]; ?></td>
      <td><?php echo $Usuarios["D50"]; ?></td>
      <td><?php echo $Usuarios["D20"]; ?></td>
      <td><?php echo $Usuarios["D10"]; ?></td>
      <td><?php echo $Usuarios["D5"]; ?></td>
        <td><?php echo $Usuarios["D2"]; ?></td>
        <td><?php echo $Usuarios["D1"]; ?></td>
        <td><?php echo $Usuarios["D50C"]; ?></td>
        <td><?php echo $Usuarios["D20C"]; ?></td>
        <td><?php echo $Usuarios["D10C"]; ?></td>
        <td><?php echo date("g:i a",strtotime($Usuarios["Hora_apertura"])); ?></td>
        <td><?php echo fechaCastellano($Usuarios["Fecha_Apertura"]); ?></td>
        

     
      
   
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">No hay resultados</p>
<?php endif;?><?

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