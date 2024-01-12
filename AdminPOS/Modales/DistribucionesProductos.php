<script type="text/javascript">
$(document).ready( function () {
    var printCounter = 0;
    $('#StockSucursalesDistribucion').DataTable({
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
                title: 'Distribucion medicamentos ',
				className: 'btn btn-success'
			},
			{
				extend:    'pdfHtml5',
				text:      'Exportar a PDF <i class="fas fa-file-pdf"></i> ',
				titleAttr: 'Exportar a PDF',
                className: 'btn btn-danger ',
                title: 'Distribucion medicamentos ',
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
$sql1="SELECT Stock_POS.Folio_Prod_Stock,Stock_POS.ID_Prod_POS,Stock_POS.Clave_adicional,Stock_POS.Cod_Barra,Stock_POS.Nombre_Prod,Stock_POS.Fk_sucursal,
Stock_POS.Existencias_R,Stock_POS.Proveedor1,Stock_POS.Proveedor2,Stock_POS.CodigoEstatus,Stock_POS.Estatus,Stock_POS.ID_H_O_D,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal
FROM Stock_POS,SucursalesCorre WHERE Stock_POS.Fk_Sucursal = SucursalesCorre.ID_SucursalC  AND Stock_POS.ID_H_O_D ='".$row['ID_H_O_D']."' 
AND Stock_POS.ID_Prod_POS = ".$_POST["id"];
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="StockSucursalesDistribucion" class="table table-hover">
<thead>
<th>Clav A</th>
<th>Clave</th>
    <th>Nombre producto</th>
    <th>Proveedor </th>
    <th>Stock </th>
    <th>Sucursal </th>

	


</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>


<td > <?php echo $Usuarios['Clave_adicional']; ?></td>
<td > <?php echo $Usuarios['Cod_Barra']; ?></td>
  <td > <?php echo $Usuarios['Nombre_Prod']; ?></td>
  <td > <?php echo $Usuarios['Proveedor1']; ?> <br>
  <?php echo $Usuarios['Proveedor2']; ?>
  </td>
  <td > <?php echo $Usuarios['Existencias_R']; ?></td>
  <td > <?php echo $Usuarios['Nombre_Sucursal']; ?></td>

  <!-- <td >  <button class="btn btn-default btn-sm" style="<?echo $Usuarios['CodigoEstatus'];?>"><?php echo $Usuarios["Estatus"]; ?></button> </td> -->
    
	
		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">Aún no hay distribucion para <?echo $row['ID_H_O_D']?></p>
<?php endif;?>