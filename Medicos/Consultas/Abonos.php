<script type="text/javascript">
$(document).ready( function () {
    $('#CreditosDisponibles').DataTable({
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
        "buttons": [
      {
        extend: 'excelHtml5',
        text: 'Exportar a Excel  <i Exportar a Excel class="fas fa-file-excel"></i> ',
        titleAttr: 'Exportar a Excel',
        title: 'registro de ventas ',
        className: 'btn btn-success',
        exportOptions: {
          columns: ':visible' // Exportar solo las columnas visibles
        }
      }
    ],
    // Personalizar la posición de los elementos del encabezado
    "dom": '<"d-flex justify-content-between"lBf>rtip', // Modificar la disposición aquí
    "responsive": true
       
   
	   
        	        
    });     
});
   
	  
	 
</script>
<?php

include("db_connection.php");
include "Consultas.php";

$user_id=null;
$sql1="SELECT AbonoCreditos_POS.Folio_Abono, AbonoCreditos_POS.Fk_Folio_Credito, AbonoCreditos_POS.Fk_tipo_Credi, AbonoCreditos_POS.Nombre_Cred, 
AbonoCreditos_POS.Cant_Apertura, AbonoCreditos_POS.Cant_Abono, AbonoCreditos_POS.Fecha_Abono, AbonoCreditos_POS.Fk_Sucursal, 
AbonoCreditos_POS.Saldo, AbonoCreditos_POS.Estatus, AbonoCreditos_POS.CodigoEstatus, AbonoCreditos_POS.ID_H_O_D, 
Tipos_Credit_POS.ID_Tip_Cred, Tipos_Credit_POS.Nombre_Tip, SucursalesCorre.ID_SucursalC, SucursalesCorre.Nombre_Sucursal 
FROM AbonoCreditos_POS, Tipos_Credit_POS, SucursalesCorre 
WHERE AbonoCreditos_POS.Fk_tipo_Credi = Tipos_Credit_POS.ID_Tip_Cred 
AND AbonoCreditos_POS.Fk_Sucursal = SucursalesCorre.ID_SucursalC  
AND DATE(AbonoCreditos_POS.Fecha_Abono) = CURDATE()";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="CreditosDisponibles" class="table table-hover">
<thead>
  
    <th style ="background-color: #0057b8 !important;">N°</th>
    <th style ="background-color: #0057b8 !important;">Tratamiento</th>
    <th style ="background-color: #0057b8 !important;">Titular</th>
    <th style ="background-color: #0057b8 !important;">Fecha abono</th>
    <th style ="background-color: #0057b8 !important;">Saldo anterior</th>
    <th style ="background-color: #0057b8 !important;">Abono</th>
    <th style ="background-color: #0057b8 !important;">Saldo</th>
    <th style ="background-color: #0057b8 !important;">Estatus</th>
    <th style ="background-color: #0057b8 !important;">Acciones</th>
    
	


</thead>
<?php while ($Categorias=$query->fetch_array()):?>
<tr>

<td > <?php echo $Categorias["Folio_Abono"]; ?></td>

  <td > <?php echo $Categorias["Nombre_Tip"]; ?></td>
  <td > <?php echo $Categorias["Nombre_Cred"]; ?></td>
 
  <td > <?php echo $Categorias["Fecha_Abono"]; ?></td>
  <td > $<?php echo $Categorias["Cant_Apertura"]; ?></td>
  <td > $<?php echo $Categorias["Cant_Abono"]; ?></td>
  <td > $<?php echo $Categorias["Saldo"]; ?></td>
  
  <td> <button style="<?echo $Categorias['CodigoEstatus'];?>" class="btn btn-default btn-sm" > <?php echo $Categorias["Estatus"]; ?></button></td>
  <td>
		 <!-- Basic dropdown -->
<button class="btn btn-primary dropdown-toggle " type="button" data-toggle="dropdown"
  aria-haspopup="true" aria-expanded="false"><i class="fas fa-list-ul"></i></button>

<div class="dropdown-menu">

<a data-id="<?php echo  $Categorias["Fk_Folio_Credito"];?>" class="btn-desglosaTicket dropdown-item" >Desglose Ticket <i class="fas fa-receipt"></i></a>
 
 
 
</div>
<!-- Basic dropdown -->
	 </td>
     
		
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