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

include("db_connection.php");
include "Consultas.php";
include "Sesion.php";

$user_id=null;
$sql1="SELECT PersonalPOS.Pos_ID,PersonalPOS.Nombre_Apellidos,PersonalPOS.file_name,PersonalPOS.Fk_Usuario,PersonalPOS.Fk_Sucursal,PersonalPOS.Telefono,PersonalPOS.Correo_Electronico,
 PersonalPOS.ID_H_O_D,PersonalPOS.Estatus,PersonalPOS.Password,PersonalPOS.ColorEstatus,PersonalPOS.AgregadoPor,PersonalPOS.AgregadoEl,Roles_Puestos.ID_rol,Roles_Puestos.Nombre_rol,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal 
 FROM PersonalPOS,Roles_Puestos,SucursalesCorre WHERE PersonalPOS.Fk_Usuario= Roles_Puestos.ID_rol AND 
 PersonalPOS.Fk_Sucursal = SucursalesCorre.ID_SucursalC AND PersonalPOS.Estatus !='Vigente' AND PersonalPOS.Fk_Usuario='7' AND PersonalPOS.ID_H_O_D='".$row['ID_H_O_D']."' ORDER BY `PersonalPOS`.`Pos_ID` DESC";
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
    <th>Sucursal</th>
    

<th>Vigencia</th>

	
	


</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>
<td > <?php echo $Usuarios["Pos_ID"]; ?></td>
  <td><img  width="60" height="60" alt="avatar" class="rounded-circle img-responsive" src="https://controlfarmacia.com/Perfiles/<?php echo $Usuarios["file_name"]; ?> "></td>
  <td > <?php echo $Usuarios["Nombre_Apellidos"]; ?></td>
    <td><?php echo $Usuarios["Nombre_Sucursal"]; ?></td>
      <td> <button style="<?echo $Usuarios['ColorEstatus'];?>" class="btn btn-default btn-sm" > <?php echo $Usuarios["Estatus"]; ?></button></td>
  
	
		
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
  		$.post("https://www.somosgrupoe.com/Administracion/RecursosHumanos/Modales/ReactivaFarmaceutico.php","id="+id,function(data){
              $("#form-editt").html(data);
              $("#Tituloo").html("reactivación de usuario");
              $("#Dio").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Dio").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Dio").removeClass("modal-dialog modal-xl modal-notify modal-primary");
              $("#Dio").addClass("modal-dialog modal-sm modal-notify modal-warning");

              
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
     
	        <div class="modal-body">
          <div class="text-center">
        <div id="form-editt"></div>
        
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->