<script type="text/javascript">
$(document).ready( function () {
    $('#Empleados').DataTable({
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
$sql1="SELECT Personal_Agenda.PersonalAgenda_ID,Personal_Agenda.Nombre_Apellidos,Personal_Agenda.file_name,Personal_Agenda.Fk_Usuario,
Personal_Agenda.Telefono,Personal_Agenda.ID_H_O_D,Personal_Agenda.Estatus,Roles_Puestos.ID_rol,Roles_Puestos.Nombre_rol FROM Personal_Agenda,Roles_Puestos
 where Roles_Puestos.ID_rol = Personal_Agenda.Fk_Usuario && Personal_Agenda.Estatus !='Vigente' && Personal_Agenda.ID_H_O_D='".$row['ID_H_O_D']."' ORDER BY `Personal_Agenda`.`PersonalAgenda_ID` DESC";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="Empleados" class="table table-hover">
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
  <a data-id="<?php echo $Usuarios["PersonalAgenda_ID"];?>" class="btn-reactive dropdown-item" >Reactivar <i class="fas fa-user-plus"></i></a>
  <a data-id="<?php echo $Usuarios["PersonalAgenda_ID"];?>" class="btn-destroy dropdown-item" >Baja defitiva <i class="fas fa-user-minus"></i></a>

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
    $(".btn-reactive").click(function(){
  		id = $(this).data("id");
  		$.post("https://www.somosgrupoe.com/Administracion/RecursosHumanos/Modales/ReactivaCallCenter.php","id="+id,function(data){
              $("#form-editt").html(data);
              $("#Tituloo").html("Editar datos de empleado");
              $("#Dio").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Dio").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Dio").removeClass("modal-dialog modal-xl modal-notify modal-primary");
              $("#Dio").addClass("modal-dialog modal-sm modal-notify modal-warning");

              
  		});
  		$('#editModal2').modal('show');
    });

    $(".btn-destroy").click(function(){
  		id = $(this).data("id");
  		$.post("https://www.somosgrupoe.com/Administracion/RecursosHumanos/Modales/DestruyeCallCenter.php","id="+id,function(data){
              $("#form-editt").html(data);
              $("#Tituloo").html("Eliminar usuario");
              $("#Dio").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Dio").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Dio").removeClass("modal-dialog modal-xl modal-notify modal-primary");
              $("#Dio").addClass("modal-dialog modal-sm modal-notify modal-danger");

              
  		});
  		$('#editModal2').modal('show');
    });

  </script>
  <div class="modal fade" id="editModal2" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModal2Label" aria-hidden="true">
  <div id="Dio"class="modal-dialog modal-lg modal-notify modal-info">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="Tituloo"></p>

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
        <div id="form-editt"></div>
        
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->