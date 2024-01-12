<script type="text/javascript">
$(document).ready( function () {
    var printCounter = 0;
    $('#Movimientos').DataTable({
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
$sql1= "SELECT Folio_Abono,Fk_Folio_Credito,Nombre_Cred,Cant_Apertura,Cant_Abono,Fecha_Abono,Saldo,Agrega FROM `AbonoCreditos_POS` where ID_H_O_D='".$row['ID_H_O_D']."' AND 
Fk_Folio_Credito = ".$_POST["id"];
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="Movimientos" class="table table-hover">
<thead>
  
    <th>N°</th>
   
    <th>Titular</th>
    <th>Fecha</th>
    <th>Saldo anterior</th>
    <th>Abono</th>
    <th>Saldo</th>
    
	


</thead>
<?php while ($Categorias=$query->fetch_array()):?>
<tr>
<td > <?php echo $Categorias["Folio_Abono"]; ?></td>
  <td > <?php echo $Categorias["Nombre_Cred"]; ?></td>
  <td > <?php echo $Categorias["Fecha_Abono"]; ?></td>
  
  <td > $<?php echo $Categorias["Cant_Apertura"]; ?></td>
  <td > $<?php echo $Categorias["Cant_Abono"]; ?></td>
  <td > $<?php echo $Categorias["Saldo"]; ?></td>

		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">No hay resultados</p>
<?php endif;?>