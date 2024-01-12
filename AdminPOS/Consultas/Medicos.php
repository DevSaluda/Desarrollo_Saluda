<script type="text/javascript">
$(document).ready( function () {
    $('#MedicosExpress').DataTable({
	
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
include "Sesion.php";

$user_id=null;
$sql1="SELECT Personal_Medico.Medico_ID,Personal_Medico.Nombre_Apellidos,Personal_Medico.file_name,Personal_Medico.Fk_Usuario,Personal_Medico.Fk_Sucursal,Personal_Medico.Telefono,
Personal_Medico.ID_H_O_D,Personal_Medico.Estatus,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal,Roles_Puestos.ID_rol,Roles_Puestos.Nombre_rol,Personal_Medico.Biometrico
FROM Personal_Medico,SucursalesCorre,Roles_Puestos where Personal_Medico.Fk_Usuario = Roles_Puestos.ID_rol AND 
Personal_Medico.Fk_Sucursal= SucursalesCorre.ID_SucursalC   AND Personal_Medico.Estatus='Vigente' AND Personal_Medico.ID_H_O_D='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
	<div class="text-center">
	<div class="table-responsive">
	<table id="MedicosExpress" class="table ">
<thead>
	<th>Folio</th>
  <th>Foto perfil </th>
    <th>Nombre</th>
    <th>Telefono</th>
    <th>Sucursal</th>
	<th>Especialidad</th>
  <th>Huellas Digitales</th>
	<th>Acciones</th>


	


</thead>
<?php while ($Especialidades=$query->fetch_array()):?>
<tr>
	<td><?php echo $Especialidades["Medico_ID"]; ?></td>
	<td><img  width="80" height="80" alt="avatar" class="rounded-circle img-responsive" src="https://controlconsulta.com/Perfiles/<?php echo $Especialidades["file_name"]; ?> "></td>
	<td><?php echo $Especialidades["Nombre_Apellidos"]; ?></td>
  <td><?php echo $Especialidades["Telefono"]; ?></td>
    <td><?php echo $Especialidades["Nombre_Sucursal"]; ?></td>
    <td><?php echo $Especialidades["Nombre_rol"]; ?></td>
    <td><?if($Especialidades['Biometrico'] == 1){
   
   echo "Verificado ";
 
} else {
  echo "Sin datos";
}?> </td>

    <td>
		 <!-- Basic dropdown -->
<button class="btn btn-primary dropdown-toggle " type="button" data-toggle="dropdown"
  aria-haspopup="true" aria-expanded="false"><i class="fas fa-th-list fa-1x"></i></button>

<div class="dropdown-menu">
<a data-id="<?php echo  $Especialidades["Medico_ID"];?>" class="btn-edit dropdown-item" >Datos de contacto <i class="fas fa-address-card"></i></a>
<a data-id="<?php echo $Especialidades["Medico_ID"];?>" class="btn-edit2 dropdown-item" >Editar datos <i class="fas fa-pencil-alt"></i></a>

  <a data-id="<?php echo $Especialidades["Medico_ID"];?>" class="btn-HistorialEmpleados dropdown-item" >Movimientos <i class="fas fa-history" aria-hidden="true"></i></a>
  <a  class="dropdown-item"  href="http://localhost/AdminPOS/index.php?nombrerh=<?echo $row['Nombre_Apellidos']?>&&rol=<?echo $row['Nombre_rol']?>&&file=<?echo $row['file_name']?>&&
  idempleado=<?php echo $Especialidades["Medico_ID"]; ?>&&nombreempleado=<?php echo $Especialidades["Nombre_Apellidos"]; ?>&&sucursalnombre=<?php echo $Especialidades["Nombre_Sucursal"]; ?>&&puesto=Médico" target="Blank_">Capturar datos biometricos <i class="fas fa-fingerprint"></i></a>
 
  <a  class="dropdown-item" href="https://api.whatsapp.com/send?phone=+52<?php echo $Especialidades["Telefono"]; ?>&text=Hola,<?php echo $Especialidades["Nombre_Apellidos"]; ?>,tus datos de accceso para el Sistema de enfermería son: %0A *Correo: <?php echo $Especialidades["Correo_Electronico"]; ?>*%0A *Contraseña :<?php echo $Especialidades["Password"]; ?>* %0A Recuerda que tu sistema puedes encontrarlo en el escritorio de tu tableta  o puedes ingresar  a través del siguiente link: https://controlconsulta.com/App/Secure/Enfermeria2" target="blank_" >Enviar datos por whatsapp <i class="fab fa-whatsapp"></i></a>
  <a data-id="<?php echo $Especialidades["Medico_ID"];?>" class="btn-BajaDeEmpleados dropdown-item" >Marcar como baja <i class="fas fa-user-slash"></i></a>
</div>
<!-- Basic dropdown -->
	 </td>
 
	 
	
	
		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<h3 class="alert alert-warning"> No se encontraron Especialidades <i class="fas fa-exclamation-circle"></i> </h3>
<?php endif;?>
<script>
  	$(".btn-edit").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/AdminPOS/Modales/ContactoMedico.php","id="+id,function(data){
  			$("#form-edit").html(data);
          $("#Titulo").html("Medios disponibles para contactar al empleado");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-primary");
              $("#Di").removeClass("modal-dialog modal-xl modal-notify modal-primary");
              $("#Di").addClass("modal-dialog  modal-notify modal-info");
  		});
  		$('#editModal').modal('show');
  	});
    $(".btn-edit2").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/AdminPOS/Modales/EditaMedico.php","id="+id,function(data){
              $("#form-edit").html(data);
              $("#Titulo").html("Editar datos de empleado");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Di").removeClass("modal-dialog modal-xl modal-notify modal-primary");
              $("#Di").addClass("modal-dialog modal-lg modal-notify modal-primary");

              
  		});
  		$('#editModal').modal('show');
    });

    $(".btn-HistorialEmpleados").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/AdminPOS/Modales/HistorialMedicos.php","id="+id,function(data){
              $("#form-edit").html(data);
              $("#Titulo").html("Historial datos de empleado");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Di").addClass("modal-dialog modal-xl modal-notify modal-primary");
  		});
  		$('#editModal').modal('show');
    });

    $(".btn-BajaDeEmpleados").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/AdminPOS/Modales/BajaDeMedicos.php","id="+id,function(data){
              $("#form-edit").html(data);
              $("#Titulo").html("Baja de usuario");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Di").addClass("modal-dialog modal-sm modal-notify modal-danger");
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