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

	   
        	        
    });     
});
   
	  
	 
</script>
<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";

$user_id=null;
$sql1= "SELECT Personal_Enfermeria_Audita.Enfermero_ID,Personal_Enfermeria_Audita.Nombre_Apellidos,Personal_Enfermeria_Audita.Fk_Usuario,Personal_Enfermeria_Audita.file_name,Personal_Enfermeria_Audita.Fk_Sucursal,
Personal_Enfermeria_Audita.ID_H_O_D,Personal_Enfermeria_Audita.Estatus,Personal_Enfermeria_Audita.ColorEstatus,Personal_Enfermeria_Audita.Telefono,Personal_Enfermeria_Audita.AgregadoEl,Personal_Enfermeria_Audita.Password,
Personal_Enfermeria_Audita.Correo_Electronico,Personal_Enfermeria_Audita.Estatus,Personal_Enfermeria_Audita.Biometrico,
Roles_Puestos.ID_rol,Roles_Puestos.Nombre_rol,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal 
FROM Personal_Enfermeria_Audita,Roles_Puestos,SucursalesCorre where Personal_Enfermeria_Audita.Fk_Sucursal = SucursalesCorre.ID_SucursalC 
and Personal_Enfermeria_Audita.Fk_Usuario = Roles_Puestos.ID_rol  AND  Personal_Enfermeria_Audita.Fk_Usuario ='4' and Personal_Enfermeria_Audita.ID_H_O_D ='".$row['ID_H_O_D']."' AND 
Personal_Enfermeria_Audita.Enfermero_ID = ".$_POST["id"];
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="MovimientosDeEmpleados" class="table table-hover">
<thead>
<th>ID </th>
<th>Foto perfil </th>
    <th>Nombre </th>
<th>Telefono</th>
    <th>Sucursal</th>
    <th>Estatus</th>
    <th>Huellas digitales</th>


	


</thead>
<?php while ($PersonalEnfermeria=$query->fetch_array()):?>
<tr><td><?php echo $PersonalEnfermeria["Enfermero_ID"]; ?></td>   
<td><img  width="80" height="80" alt="avatar" class="rounded-circle img-responsive" src="https://controlconsulta.com/Perfiles/<?php echo $PersonalEnfermeria["file_name"]; ?> "></td>
<td><?php echo $PersonalEnfermeria["Nombre_Apellidos"]; ?></td>   
<td><?php echo $PersonalEnfermeria["Telefono"]; ?></td>   

    <td><?php echo $PersonalEnfermeria["Nombre_Sucursal"]; ?></td>

    <td><?php echo $PersonalEnfermeria["Estatus"]; ?></td>
    <td><?if($PersonalEnfermeria['Biometrico'] == 1){
   
   echo "Verificado ";
 
} else {
  echo "Sin datos";
}?> </td>

    
   
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">No hay resultados</p>
<?php endif;?>