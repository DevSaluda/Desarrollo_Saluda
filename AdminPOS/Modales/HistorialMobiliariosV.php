<script type="text/javascript">
$(document).ready( function () {
    var printCounter = 0;
    $('#MovimientosMobiliariosV').DataTable({
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
$sql1= "SELECT Inventarios_Clinicas_audita.ID_Inv_Clic_Audita,Inventarios_Clinicas_audita.ID_Inv_Clic,Inventarios_Clinicas_audita.Cod_Equipo,
Inventarios_Clinicas_audita.Cod_Equipo_Repetido,Inventarios_Clinicas_audita.FK_Tipo_Mob,
Inventarios_Clinicas_audita.Cantidad_Mobil,Inventarios_Clinicas_audita.Nombre_equipo,
Inventarios_Clinicas_audita.Descripcion,Inventarios_Clinicas_audita.Fecha_Ingreso,
Inventarios_Clinicas_audita.Estatus,Inventarios_Clinicas_audita.Agregado_Por,Inventarios_Clinicas_audita.AgregadoEl,
Inventarios_Clinicas_audita.Sistema,Inventarios_Clinicas_audita.ID_H_O_D, Tipos_Mobiliarios_POS.Tip_Mob_ID,Tipos_Mobiliarios_POS.Nom_Tip_Mob 
 FROM Inventarios_Clinicas_audita, Tipos_Mobiliarios_POS where Inventarios_Clinicas_audita.FK_Tipo_Mob = Tipos_Mobiliarios_POS.Tip_Mob_ID  AND 
 Inventarios_Clinicas_audita.ID_H_O_D ='".$row['ID_H_O_D']."' AND Inventarios_Clinicas_audita.ID_Inv_Clic = ".$_POST["id"];
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="MovimientosMobiliariosV" class="table table-hover">
<thead>
  
    <th>N°</th>
    <th>Estatus</th>
    <th>Cod mobiliario</th>
    <th>Nombre mobiliario</th>
    <th>Tipo mobiliario</th>
    <th>Cantidad</th>
    <th>Descripcion</th>
    <th>Fecha Ingreso</th>
    <th>Sucursal</th>
    <th>Recibio</th>
    <th>Movimiento por</th>
    <th>Fecha | Hora</th>
    <th>Sistema</th>
    
    
	


</thead>
<?php while ($Categorias=$query->fetch_array()):?>
<tr>
<td > <?php echo $Categorias["ID_Inv_Clic"]; ?></td>
<td > <?php echo $Categorias["Estatus"]; ?></td>
  <td > <?php echo $Categorias["Cod_Equipo"]; ?> <br>
  <?php echo $Categorias["Cod_Equipo_Repetido"]; ?>  </td>
  <td > <?php echo $Categorias["Nombre_equipo"]; ?></td>
  <td > <?php echo $Categorias["Nom_Tip_Mob"]; ?></td>
  <td > <?php echo $Categorias["Cantidad_Mobil"]; ?></td>
  <td > <?php echo $Categorias["Descripcion"]; ?></td>
  <td > <?php echo $Categorias["Fecha_Ingreso"]; ?></td>
  <td > <?php echo $Categorias["Nombre_Sucursal"]; ?></td>
  <td > <?php echo $Categorias["Recibido_Por"]; ?></td>
  <td > <?php echo $Categorias["Agregado_Por"]; ?></td>
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