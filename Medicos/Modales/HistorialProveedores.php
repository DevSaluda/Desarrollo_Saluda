<script type="text/javascript">
$(document).ready( function () {
    var printCounter = 0;
    $('#MovimientosProveedores').DataTable({
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
			{
                extend:    'print',
                
				text:      'Imprimir <i class="fa fa-print"></i> ',
				titleAttr: 'Imprimir',
                className: 'btn btn-info',
                messageTop: function () {
                    printCounter++;
 
                    if ( printCounter === 1 ) {
                        return 'Primera impresion.';
                    }
                    else {
                        return 'Impresion numero '+printCounter+'';
                    }
                },
                messageBottom: null
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
$sql1= "SELECT * FROM `Proveedores_POS_Updates` where ID_H_O_D='".$row['ID_H_O_D']."' AND 	ID_Proveedor = ".$_POST["id"];
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="MovimientosProveedores" class="table table-hover">
<thead>
  
    <th>N°</th>
    <th>Folio°</th>
    <th>Nombre categoria</th>
    <th>Clave adicional</th>
    <th>Numero</th>
    <th>Correo</th>
    <th>Estatus</th>
    <th>Editado</th>
    <th>Fecha | Hora</th>
    <th>Sistema</th>
    
    
	


</thead>
<?php while ($Categorias=$query->fetch_array()):?>
<tr>
<td > <?php echo $Categorias["ID_Update_Prov"]; ?></td>
  <td > <?php echo $Categorias["ID_Proveedor"]; ?></td>
  <td > <?php echo $Categorias["Nombre_Proveedor"]; ?></td>
  <td > <?php echo $Categorias["Clave_Proveedor"]; ?></td>
  <td > <?php echo $Categorias["Numero_Contacto"]; ?></td>
  <td > <?php echo $Categorias["Correo_Electronico"]; ?></td>

  <td > <?php echo $Categorias["Estatus"]; ?></td>
 
  <td > <?php echo $Categorias["AgregadoPor"]; ?></td>
  
  <td > <?php echo $Categorias["AgregadoEl"]; ?></td>
  <td ><?php echo $Categorias["Sistema"]; ?></td>
 

		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">Por el momento no se han realizado movimientos</p>
<?php endif;?>