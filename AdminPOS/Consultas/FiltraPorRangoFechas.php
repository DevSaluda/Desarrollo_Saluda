<script type="text/javascript">
$(document).ready( function () {
    var printCounter = 0;
    $('#Signos_VitalesV2').DataTable({
      "order": [[ 0, "desc" ]],
      "lengthMenu": [[10,50, 150, 200, -1], [10,50, 150, 200, "Todos"]],   
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
                title: 'registros de laboratorio del <?php echo $fecha1?> al <?php echo $fecha2?>',
				className: 'btn btn-success'
			},
			
		
        ],
       
   
	   
        	        
    });     
});
   
	 
</script>
<?php 
;


$user_id=null;

$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
    <form action="javascript:void(0)" method="post" id="ActualizaConcidentes">
        
  <div class="text-center">
  
	<div class="table-responsive">
	<table  id="Signos_VitalesV2" class="table table-hover">
<thead>
<th>Nombre Paciente</th>
<th>Producto</th>
    <th>Edad</th>
    <th>Sexo</th>
    <th>Telefono</th>
    <th>Peso</th>
    <th>Talla</th>
    <th>IMC</th>
    <th>Motivo Consulta</th>
    <th>Nombre Doctor</th>
    <th>Fecha Visita</th>
    <th>Fk Sucursal</th>
    <th>Fk Enfermero</th>
    
	


</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>



<td > <?php echo $Usuarios['Nombre_Paciente']; ?></td>
<td > <?php echo $Usuarios['Edad']; ?></td>
  <td><?php echo $Usuarios["Sexo"]; ?></td>
  <td><?php echo $Usuarios["Folio_Ticket"]; ?></td>
  <td><?php echo $Usuarios["Telefono"]; ?></td>
  <td><?php echo $Usuarios["Peso"]; ?></td>
  <td><?php echo $Usuarios["Talla"]; ?></td>
  <td><?php echo $Usuarios["IMC"]; ?></td>
  <td><?php echo $Usuarios["Motivo_Consulta"]; ?></td>
  <td><?php echo $Usuarios["Nombre_Doctor"]; ?></td>
  <td><?php echo $Usuarios["Fecha_Visita"]; ?></td>
  <td><?php echo $Usuarios["Fk_Sucursal"]; ?></td>
  <td><?php echo $Usuarios["Fk_Enfermero"]; ?></td>
    
		
</tr>
<?php endwhile;?>
</form>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">No se encontraron coincidencias</p>
<?php endif;?>