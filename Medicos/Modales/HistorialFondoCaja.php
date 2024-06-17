<script type="text/javascript">
$(document).ready( function () {
    var printCounter = 0;
    $('#MovimientosMedicosCreditos').DataTable({
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
        dom: "B<'#colvis row'><'row'><'row'<'col-md-6'l><'col-md-6'f>r>t<'bottom'ip><'clear'>'",
          buttons:[ 
			{
				extend:    'excelHtml5',
				text:      'Exportar a Excel  <i Exportar a Excel class="fas fa-file-excel"></i> ',
                titleAttr: 'Exportar a Excel',
                title: 'Movimientos  de pago ',
				className: 'btn btn-success'
			},
			{
				extend:    'pdfHtml5',
				text:      'Exportar a PDF <i class="fas fa-file-pdf"></i> ',
				titleAttr: 'Exportar a PDF',
                className: 'btn btn-danger ',
                title: 'Movimientos  de pago ',
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
$sql1= "SELECT Fondos_Cajas_Audita.ID_Audita_FonCaja,Fondos_Cajas_Audita.ID_Fon_Caja,Fondos_Cajas_Audita.Fk_Sucursal,Fondos_Cajas_Audita.Fondo_Caja,
Fondos_Cajas_Audita.ID_H_O_D,Fondos_Cajas_Audita.Estatus,Fondos_Cajas_Audita.AgregadoPor,Fondos_Cajas_Audita.AgregadoEl,Fondos_Cajas_Audita.Sistema,
SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM 
Fondos_Cajas_Audita,SucursalesCorre where Fondos_Cajas_Audita.Fk_Sucursal = SucursalesCorre.ID_SucursalC AND 
Fondos_Cajas_Audita.ID_H_O_D ='".$row['ID_H_O_D']."' AND Fondos_Cajas_Audita.ID_Fon_Caja = ".$_POST["id"];
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="MovimientosMedicosCreditos" class="table table-hover">
<thead>
  
    <th>N°</th>
    <th>Folio fondo de caja</th>
    <th>Sucursal</th>
    <th>Fondo</th>
    <th>Estatus</th>
    <th>Agrego|modifico</th>
    <th>Fecha | Hora</th>
    <th>Sistema</th>
    
    
	


</thead>
<?php while ($Categorias=$query->fetch_array()):?>
<tr>
<td > <?php echo $Categorias["ID_Audita_FonCaja"]; ?></td>
<td > <?php echo $Categorias["ID_Fon_Caja"]; ?></td>
  <td > <?php echo $Categorias["Nombre_Sucursal"]; ?> </td>
  <td > $ <?php echo $Categorias["Fondo_Caja"]; ?> </td>

 
  <td > <?php echo $Categorias["Estatus"]; ?></td>
  <td > <?php echo $Categorias["AgregadoPor"]; ?></td>
  <td > <?php echo $Categorias["AgregadoEl"]; ?></td>
  <td > <?php echo $Categorias["Sistema"]; ?></td>


		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">Por el momento no se han realizado movimientos</p>
<?php endif;?>