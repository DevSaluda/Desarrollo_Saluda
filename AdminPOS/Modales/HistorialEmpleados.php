<script type="text/javascript">
$(document).ready( function () {
    var printCounter = 0;
    $('#MovimientosDeEmpleados').DataTable({
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


$user_id=null;
$sql1= "SELECT 	PersonalPOS_Audita.Audita_Pos_ID,PersonalPOS_Audita.Pos_ID,PersonalPOS_Audita.Nombre_Apellidos,PersonalPOS_Audita.file_name,PersonalPOS_Audita.Fk_Usuario,PersonalPOS_Audita.Fk_Sucursal,
PersonalPOS_Audita.ID_H_O_D,PersonalPOS_Audita.Estatus,PersonalPOS_Audita.ColorEstatus,PersonalPOS_Audita.Telefono,PersonalPOS_Audita.Password,PersonalPOS_Audita.Correo_Electronico,
PersonalPOS_Audita.AgregadoPor,PersonalPOS_Audita.AgregadoEl,Roles_Puestos.ID_rol,Roles_Puestos.Nombre_rol,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal 
FROM PersonalPOS_Audita,Roles_Puestos,SucursalesCorre WHERE PersonalPOS_Audita.Fk_Usuario= Roles_Puestos.ID_rol AND 
PersonalPOS_Audita.Fk_Sucursal = SucursalesCorre.ID_SucursalC AND PersonalPOS_Audita.Fk_Usuario='7' AND PersonalPOS_Audita.ID_H_O_D='".$row['ID_H_O_D']."' AND 
PersonalPOS_Audita.Pos_ID = ".$_POST["id"];
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="MovimientosDeEmpleados" class="table table-hover">
<thead>
<th>N°</th>
<th>Folio empleado</th>

    <th>Nombre y Apellidos</th>
    <th>Sucursal</th>
    

<th>Vigencia</th>
<th>Telefono</th>
<th>Correo</th>
<th>Contraseña</th>
	<th >Agrego</th>
    <th >Fecha y hora</th>
	


</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>

<td > <?php echo $Usuarios["Audita_Pos_ID"]; ?></td>
<td > <?php echo $Usuarios["Pos_ID"]; ?></td>
  <td > <?php echo $Usuarios["Nombre_Apellidos"]; ?></td>
    <td><?php echo $Usuarios["Nombre_Sucursal"]; ?></td>
      <td><?php echo $Usuarios["Estatus"]; ?></button></td>
      <td><?php echo $Usuarios["Telefono"]; ?></button></td>
      <td><?php echo $Usuarios["Correo_Electronico"]; ?></button></td>
      <td><?php echo $Usuarios["Password"]; ?></button></td>
      <td><?php echo $Usuarios["AgregadoPor"]; ?></button></td>
      <td><?php echo $Usuarios["AgregadoEl"]; ?></button></td>
     
      
   
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">No hay resultados</p>
<?php endif;?>