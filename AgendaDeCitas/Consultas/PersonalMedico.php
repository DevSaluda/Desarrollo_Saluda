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
$sql1="SELECT Personal_Medico.Medico_ID,Personal_Medico.Nombre_Apellidos,Personal_Medico.Fk_Usuario,Personal_Medico.Fk_Sucursal,
Personal_Medico.ID_H_O_D,Personal_Medico.Estatus,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal,Roles_Puestos.ID_rol,Roles_Puestos.Nombre_rol 
FROM Personal_Medico,SucursalesCorre,Roles_Puestos where Personal_Medico.Fk_Usuario = Roles_Puestos.ID_rol AND 
Personal_Medico.Fk_Sucursal= SucursalesCorre.ID_SucursalC AND Personal_Medico.ID_H_O_D='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
	<div class="text-center">
	<div class="table-responsive">
	<table id="MedicosExpress" class="table ">
<thead>
	<th>Folio</th>
    <th>Nombre</th>
    <th>Sucursal</th>
	<th>Especialidad</th>
	<th>Estatus</th>


	


</thead>
<?php while ($Especialidades=$query->fetch_array()):?>
<tr>
	<td><?php echo $Especialidades["Medico_ID"]; ?></td>
	
	<td><?php echo $Especialidades["Nombre_Apellidos"]; ?></td>
    <td><?php echo $Especialidades["Nombre_Sucursal"]; ?></td>
    <td><?php echo $Especialidades["Nombre_rol"]; ?></td>
	<td><button class="btn btn-default btn-sm" style=<?if($Especialidades['Estatus'] == 'Vigente'){
   echo "background-color:#00c851!important";
} elseif($Especialidades['Estatus'] != 'Disponible'  &&  $Especialidades['Estatus'] != 'Baja') {
  echo "background-color:#fd7e14!important";
}else {
    echo "background-color:#fd1414!important";
}
?>>
<?if($Especialidades['Estatus'] == ''){
   echo "No se asigno estatus";
} else {
    echo $Especialidades["Estatus"]; 
} ?></button></td>
	 
	
	
		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<h3 class="alert alert-warning"> No se encontraron Especialidades <i class="fas fa-exclamation-circle"></i> </h3>
<?php endif;?>
<script>
  	$(".btn-AsigSucursal").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/AgendaDeCitas/Modales/AsignaAlEspecialistaEnSucursal.php","id="+id,function(data){
  			$("#form-edit").html(data);
          $("#Titulo").html("Asignar sucursal a médico");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Di").removeClass("modal-dialog modal-xl modal-notify modal-primary");
              $("#Di").addClass("modal-dialog  modal-notify modal-info");
  		});
  		$('#editModal').modal('show');
  	});
    $(".btn-edit2").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/AdministracionPOS/Modales/HistorialSaldos.php","id="+id,function(data){
              $("#form-edit").html(data);
              $("#Titulo").html("Historial de pagos");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Di").addClass("modal-dialog modal-xl modal-notify modal-primary");
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
<?

function fechaCastellano ($fecha) {
  $fecha = substr($fecha, 0, 10);
  $numeroDia = date('d', strtotime($fecha));
  $dia = date('l', strtotime($fecha));
  $mes = date('F', strtotime($fecha));
  $anio = date('Y', strtotime($fecha));
  $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
  $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
  $nombredia = str_replace($dias_EN, $dias_ES, $dia);
$meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
  $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
  $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
  return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
}
?>