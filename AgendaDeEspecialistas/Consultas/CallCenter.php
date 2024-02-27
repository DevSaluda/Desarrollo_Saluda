<script type="text/javascript">
$(document).ready( function () {
    $('#EmpleadosBajas').DataTable({
      "order": [[ 0, "desc" ]],
      "lengthMenu": [[10,50,200, -1], [10,50,200, "Todos"]],   
      "language": {
        "url": "Componentes/Spanish.json"
		},
    initComplete: function() {
        this.api().columns([3]).every(function() {
            var column = this;
            var select = $('<select class="form-control form-control-sm" ><option value="">Selecciona para filtrar</option></select>')
                .appendTo($(column.header()))
                .on('change', function() {
                    var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                    );
 
                        column
                        .search(val ? '^' + val + '$' : '', true, false)
                        .draw();
 
 
                });
                //Este codigo sirve para que no se active el ordenamiento junto con el filtro
            $(select).click(function(e) {
                e.stopPropagation();
            });
            //===================
 
            column.data().unique().sort().each(function(d, j) {
                // select.append('<option value="' + d + '">' + d + '</option>')
 
                    select.append('<option value="' + d + '">' + d + '</option>')
 
            });
 
 
 
        });
    },
    "aoColumnDefs": [
     { "bSearchable": false, "aTargets": [ 1 ] }
   ]
		
	  } 
	  
	  );
} );
</script>
<?php
header("Acces-Control-Allow-Origin: *"); 
include("db_connection.php"); 
include "Consultas.php";
include "Sesion.php";

$user_id=null;
$sql1="SELECT Personal_Agenda.PersonalAgenda_ID,Personal_Agenda.Nombre_Apellidos,Personal_Agenda.file_name,Personal_Agenda.Fk_Usuario,Personal_Agenda.Correo_Electronico,Personal_Agenda.Telefono,Personal_Agenda.Password,
Personal_Agenda.Telefono,Personal_Agenda.ID_H_O_D,Personal_Agenda.Estatus,Roles_Puestos.ID_rol,Roles_Puestos.Nombre_rol FROM Personal_Agenda,Roles_Puestos
 where Roles_Puestos.ID_rol = Personal_Agenda.Fk_Usuario && Personal_Agenda.Estatus='Vigente' && Personal_Agenda.ID_H_O_D='".$row['ID_H_O_D']."' ORDER BY `Personal_Agenda`.`PersonalAgenda_ID` DESC";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="EmpleadosBajas" class="table table-hover">
<thead>
  <th>Folio empleado</th>
<th>Foto de perfil</th>
    <th>Nombre y Apellidos</th>
    <th>Rol | Puesto</th>
    <th>Telefono</th>


	<th >Accciones</th>
	


</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>
<td > <?php echo $Usuarios["PersonalAgenda_ID"]; ?></td>
  <td><img  width="60" height="60" alt="avatar" class="rounded-circle img-responsive" src="https://controlfarmacia.com/Perfiles/<?php echo $Usuarios["file_name"]; ?> "></td>
  <td > <?php echo $Usuarios["Nombre_Apellidos"]; ?></td>
    <td><?php echo $Usuarios["Nombre_rol"]; ?></td>
    <td><?php echo $Usuarios["Telefono"]; ?></td>
    <td>
		 <!-- Basic dropdown -->
<button class="btn btn-primary dropdown-toggle " type="button" data-toggle="dropdown"
  aria-haspopup="true" aria-expanded="false"><i class="fas fa-th-list fa-1x"></i></button>

<div class="dropdown-menu">

<a data-id="<?php echo $Usuarios["PersonalAgenda_ID"];?>" class="btn-edit2 dropdown-item" >Editar datos <i class="fas fa-pencil-alt"></i></a>

  <a data-id="<?php echo $Usuarios["PersonalAgenda_ID"];?>" class="btn-HistorialEmpleados dropdown-item" >Movimientos <i class="fas fa-history" aria-hidden="true"></i></a>
 
  <a  class="dropdown-item" href="https://api.whatsapp.com/send?phone=+52<?php echo $Usuarios["Telefono"]; ?>&text=Hola,<?php echo $Usuarios["Nombre_Apellidos"]; ?>,tus datos de accceso para el punto de venta son: %0A *Correo: <?php echo $Usuarios["Correo_Electronico"]; ?>*%0A *Contraseña :<?php echo $Usuarios["Password"]; ?>* %0A Recuerda que el acceso a la agenda es por medio del siguiente link: https://controlfarmacia.com/App/Secure/IngresoAgenda " target="blank_" >Enviar datos por whatsapp <i class="fab fa-whatsapp"></i></a>
  <a data-id="<?php echo $Usuarios["PersonalAgenda_ID"];?>" class="btn-baja dropdown-item" >Marcar como baja <i class="fas fa-user-slash"></i></a>
</div>
<!-- Basic dropdown -->
	 </td>
	
		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">No hay resultados</p>
<?php endif;?>
  <!-- Modal -->
  <script>
  
    $(".btn-edit2").click(function(){
  		id = $(this).data("id");
  		$.post("https://www.somosgrupoe.com/Administracion/RecursosHumanos/Modales/EditaEmpleadoCenter.php","id="+id,function(data){
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
  		$.post("https://www.somosgrupoe.com/Administracion/RecursosHumanos/Modales/HistorialEmpleadosCenter.php","id="+id,function(data){
              $("#form-edit").html(data);
              $("#Titulo").html("Historial datos de empleado");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Di").addClass("modal-dialog modal-xl modal-notify modal-primary");
  		});
  		$('#editModal').modal('show');
    });

    $(".btn-baja").click(function(){
  		id = $(this).data("id");
  		$.post("https://www.somosgrupoe.com/Administracion/RecursosHumanos/Modales/BajaCallCenter.php","id="+id,function(data){
              $("#form-edit").html(data);
              $("#Titulo").html("Historial datos de empleado");
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