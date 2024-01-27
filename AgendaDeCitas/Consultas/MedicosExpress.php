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

$user_id=null;
$sql1="SELECT Personal_Medico_Express.Medico_ID,Personal_Medico_Express.Nombre_Apellidos,Personal_Medico_Express.Correo_Electronico, 
Personal_Medico_Express.Telefono,Personal_Medico_Express.Especialidad_Express,Personal_Medico_Express.ID_H_O_D,Personal_Medico_Express.Estatus,
 Especialidades_Express.ID_Especialidad,Especialidades_Express.Nombre_Especialidad, Especialidades_Express.Fk_Sucursal,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal 
 FROM Personal_Medico_Express,Especialidades_Express, SucursalesCorre WHERE Personal_Medico_Express.Especialidad_Express= Especialidades_Express.ID_Especialidad
  AND Especialidades_Express.Fk_Sucursal = SucursalesCorre.ID_SucursalC AND Personal_Medico_Express.ID_H_O_D='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
	<div class="text-center">
	<div class="table-responsive">
	<table id="MedicosExpress" class="table ">
<thead>
	<th>Folio</th>
  <th>Nombre</th>
	<th>Especialidad</th>
  <th>Sucursal</th>
	<th>Estatus</th>
	<th>Acciones</th>

	


</thead>
<?php while ($Especialidades=$query->fetch_array()):?>
<tr>
	<td><?php echo $Especialidades["Medico_ID"]; ?></td>
	
	<td><?php echo $Especialidades["Nombre_Apellidos"]; ?></td>
  <td><?php echo $Especialidades["Nombre_Especialidad"]; ?></td>
  <td><?php echo $Especialidades["Nombre_Sucursal"]; ?></td>
	<td><button class="btn btn-default btn-sm" style=<?if($Especialidades['Estatus'] == 'Disponible'){
   echo "background-color:#00c851!important";
} elseif($Especialidades['Estatus'] != 'Disponible'  &&  $Especialidades['Estatus'] != 'No disponible') {
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
	 
	 <td>
		 <!-- Basic dropdown -->
<button class="btn btn-primary dropdown-toggle " type="button" data-toggle="dropdown"
  aria-haspopup="true" aria-expanded="false"><i class="fas fa-th-list fa-1x"></i></button>

<div class="dropdown-menu">

  <a data-id="<?php echo $Especialidades["Medico_ID"];?>" class="btn-detail dropdown-item" >Detalles <i class="fas fa-info-circle"></i></a>
  <a data-id="<?php echo $Especialidades["Medico_ID"];?>" class="btn-FinMed dropdown-item" >Eliminar <i class="fas fa-ban"></i></a>
  <a data-id="<?php echo $Especialidades["Medico_ID"];?>" class="btn-edicion dropdown-item" >Editar datos <i class="fas fa-edit"></i></a>
  
 
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
  	$(".btn-detail").click(function(){
  		id = $(this).data("id");
  		$.post("https://saludapos.com/AgendaDeCitas/Modales/DetallesMedicoExpress.php","id="+id,function(data){
  			$("#form-edit").html(data);
          $("#Titulo").html("Detalles médico");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di").removeClass("modal-dialog modal-notify modal-danger");
              $("#Di").removeClass("modal-dialog modal-xl modal-notify modal-primary");
              $("#Di").addClass("modal-dialog  modal-notify modal-info");
  		});
  		$('#editModal').modal('show');
  	});
    $(".btn-FinMed").click(function(){
  		id = $(this).data("id");
  		$.post("https://saludapos.com/AgendaDeCitas/Modales/BajaMedicoExpress.php","id="+id,function(data){
              $("#form-edit").html(data);
              $("#Titulo").html("Cambio de vigencia");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di").removeClass("modal-dialog  modal-notify modal-info");
              $("#Di").addClass("modal-dialog modal-notify modal-danger");
         });
  		$('#editModal').modal('show');
    });
    $(".btn-edicion").click(function(){
  		id = $(this).data("id");
  		$.post("https://saludapos.com/AgendaDeCitas/Modales/EditaMedicoExpress.php","id="+id,function(data){
  			$("#form-edit").html(data);
          $("#Titulo").html("Editar datos de Médico");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di").removeClass("modal-dialog modal-notify modal-danger");
              $("#Di").removeClass("modal-dialog modal-xl modal-notify modal-primary");
              $("#Di").addClass("modal-dialog  modal-notify modal-info");
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