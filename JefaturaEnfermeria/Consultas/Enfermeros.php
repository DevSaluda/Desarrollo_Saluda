<script type="text/javascript">
$(document).ready( function () {
    $('#SignosVitales').DataTable({
      "order": [[ 0, "desc" ]],
      "stateSave":true,
      "language": {
        "url": "Componentes/Spanish.json"
		}
		
	  } 
	  
	  );
} );
</script>
<?php

include("db_connection.php");
include "Consultas.php";


$user_id=null;
$sql1="SELECT Personal_Enfermeria.Enfermero_ID,Personal_Enfermeria.Nombre_Apellidos,Personal_Enfermeria.Fk_Usuario,Personal_Enfermeria.file_name,Personal_Enfermeria.Fk_Sucursal,
Personal_Enfermeria.ID_H_O_D,Personal_Enfermeria.Estatus,Personal_Enfermeria.ColorEstatus,Personal_Enfermeria.Telefono,Personal_Enfermeria.AgregadoEl,Personal_Enfermeria.Password,
Personal_Enfermeria.Correo_Electronico,Personal_Enfermeria.Estatus,Personal_Enfermeria.Biometrico,
Roles_Puestos.ID_rol,Roles_Puestos.Nombre_rol,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal 
FROM Personal_Enfermeria,Roles_Puestos,SucursalesCorre where Personal_Enfermeria.Fk_Sucursal = SucursalesCorre.ID_SucursalC 
and Personal_Enfermeria.Fk_Usuario = Roles_Puestos.ID_rol  AND 	Personal_Enfermeria.Estatus='Vigente' AND Personal_Enfermeria.Fk_Usuario ='4' and Personal_Enfermeria.ID_H_O_D ='".$row['ID_H_O_D']."'";  
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
    <div class="text-center">
	<div class="table-responsive">
    
	<table id="SignosVitales" class="table ">
<thead>
<th>ID </th>
<th>Foto perfil </th>
    <th>Nombre </th>
<th>Telefono</th>
    <th>Sucursal</th>
    <th>Huellas digitales</th>

    <th>Acciones </th>
	
	


</thead>
<?php while ($PersonalEnfermeria=$query->fetch_array()):?>
<tr><td><?php echo $PersonalEnfermeria["Enfermero_ID"]; ?></td>   
<td><img  width="80" height="80" alt="avatar" class="rounded-circle img-responsive" src="https://saludapos.com/Perfiles/<?php echo $PersonalEnfermeria["file_name"]; ?> "></td>
<td><?php echo $PersonalEnfermeria["Nombre_Apellidos"]; ?></td>   
<td><?php echo $PersonalEnfermeria["Telefono"]; ?></td>   

    <td><?php echo $PersonalEnfermeria["Nombre_Sucursal"]; ?></td>

    <td><?if($PersonalEnfermeria['Biometrico'] == 1){
   
   echo "Verificado ";
 
} else {
  echo "Sin datos";
}?> </td>

    
    <td>
		 <!-- Basic dropdown -->
<button class="btn btn-primary dropdown-toggle " type="button" data-toggle="dropdown"
  aria-haspopup="true" aria-expanded="false"><i class="fas fa-th-list fa-1x"></i></button>

<div class="dropdown-menu">
<a data-id="<?php echo  $PersonalEnfermeria["Enfermero_ID"];?>" class="btn-edit dropdown-item" >Datos de contacto <i class="fas fa-address-card"></i></a>
<a data-id="<?php echo $PersonalEnfermeria["Enfermero_ID"];?>" class="btn-edit2 dropdown-item" >Editar datos <i class="fas fa-pencil-alt"></i></a>

  <a data-id="<?php echo $PersonalEnfermeria["Enfermero_ID"];?>" class="btn-HistorialEmpleados dropdown-item" >Movimientos <i class="fas fa-history" aria-hidden="true"></i></a>
  <a data-id="<?php echo $PersonalEnfermeria["Enfermero_ID"];?>" class="btn-CambiaSucursal dropdown-item" >Cambio de sucursal <i class="fas fa-exchange-alt"></i></a>
  <a style=<?if($PersonalEnfermeria['Biometrico'] == 1){
   
   echo "display:none;";
 
} else {
  echo "display:block;";
}?> class="dropdown-item"  href="http://localhost/JefaturaEnfermeria/index.php?nombrerh=<?echo $row['Nombre_Apellidos']?>&&rol=<?echo $row['Nombre_rol']?>&&file=<?echo $row['file_name']?>&&
  idempleado=<?php echo $PersonalEnfermeria["Enfermero_ID"]; ?>&&nombreempleado=<?php echo $PersonalEnfermeria["Nombre_Apellidos"]; ?>&&sucursalnombre=<?php echo $PersonalEnfermeria["Nombre_Sucursal"]; ?>&&puesto=Enfermería" target="Blank_">Capturar datos biometricos <i class="fas fa-fingerprint"></i></a>
 
  <a  class="dropdown-item" href="https://api.whatsapp.com/send?phone=+52<?php echo $PersonalEnfermeria["Telefono"]; ?>&text=Hola,<?php echo $PersonalEnfermeria["Nombre_Apellidos"]; ?>,tus datos de accceso para el Sistema de enfermería son: %0A *Correo: <?php echo $PersonalEnfermeria["Correo_Electronico"]; ?>*%0A *Contraseña :<?php echo $PersonalEnfermeria["Password"]; ?>* %0A Recuerda que tu sistema puedes encontrarlo en el escritorio de tu tableta  o puedes ingresar  a través del siguiente link: https://controlconsulta.com/App/Secure/Enfermeria2" target="blank_" >Enviar datos por whatsapp <i class="fab fa-whatsapp"></i></a>
  <a data-id="<?php echo $PersonalEnfermeria["Enfermero_ID"];?>" class="btn-baja dropdown-item" >Marcar como baja <i class="fas fa-user-slash"></i></a>
</div>
<!-- Basic dropdown -->
	 </td>
 

	
		
</tr>
<?php endwhile;?>
</table>
</div></div>
<?php else:?>
	<p class="alert alert-warning">Aún no hay personal registrado</p>
<?php endif;?>
  <!-- Modal -->
  <script>
  	$(".btn-edit").click(function(){
  		id = $(this).data("id");
  		$.post("https://saludapos.com/JefaturaEnfermeria/Modales/ContactoEmpleadoeEnfermero.php","id="+id,function(data){
  			$("#form-edit").html(data);
          $("#Titulo").html("Medios disponibles para contactar al empleado");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-primary");
              $("#Di").removeClass("modal-dialog modal-xl modal-notify modal-primary");
              $("#Di").removeClass("modal-dialog modal-sm modal-notify modal-danger");
              $("#Di").addClass("modal-dialog  modal-notify modal-info");
  		});
  		$('#editModal').modal('show');
  	});
    $(".btn-edit2").click(function(){
  		id = $(this).data("id");
  		$.post("https://saludapos.com/JefaturaEnfermeria/Modales/EditaEmpleadoEnfermero.php","id="+id,function(data){
              $("#form-edit").html(data);
              $("#Titulo").html("Editar datos de empleado");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Di").removeClass("modal-dialog modal-xl modal-notify modal-primary");
              $("#Di").removeClass("modal-dialog modal-sm modal-notify modal-danger");
              $("#Di").addClass("modal-dialog modal-lg modal-notify modal-primary");

              
  		});
  		$('#editModal').modal('show');
    });

    $(".btn-HistorialEmpleados").click(function(){
  		id = $(this).data("id");
  		$.post("https://saludapos.com/JefaturaEnfermeria/Modales/HistorialEmpleadosEnfermero.php","id="+id,function(data){
              $("#form-edit").html(data);
              $("#Titulo").html("Historial datos de empleado");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Di").removeClass("modal-dialog modal-sm modal-notify modal-danger");
              $("#Di").addClass("modal-dialog modal-xl modal-notify modal-primary");
  		});
  		$('#editModal').modal('show');
    });

    $(".btn-baja").click(function(){
  		id = $(this).data("id");
  		$.post("https://saludapos.com/JefaturaEnfermeria/Modales/BajaEnfermero.php","id="+id,function(data){
              $("#form-edit").html(data);
              $("#Titulo").html("Historial datos de empleado");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Di").addClass("modal-dialog modal-sm modal-notify modal-danger");
  		});
  		$('#editModal').modal('show');
    });

    $(".btn-CambiaSucursal").click(function(){
  		id = $(this).data("id");
  		$.post("https://saludapos.com/JefaturaEnfermeria/Modales/CambiaSucursalEmpleadosEnfermeros.php","id="+id,function(data){
              $("#form-edit").html(data);
              $("#Titulo").html("Cambio de sucursal");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Di").addClass("modal-dialog modal-sm modal-notify modal-primary");
  		});
  		$('#editModal').modal('show');
    });
  </script>
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalLabel" aria-hidden="true">
  <div id="Di"class="modal-dialog modal-lg modal-notify modal-info">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="Titulo"></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
        <div id="Mensaje "class="alert alert-info alert-styled-left text-blue-800 content-group">
						                <span id="Aviso" class="text-semibold">Estimado usuario, 
                            Verifique los campos antes de realizar alguna accion</span>
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
	        <div class="modal-body">
          <div class="text-center">
        <div id="form-edit"></div>
        
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->