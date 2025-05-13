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
$sql1="SELECT Programacion_Medicos_Sucursales.ID_Programacion,Programacion_Medicos_Sucursales.FK_Medico,Programacion_Medicos_Sucursales.Fk_Sucursal,Programacion_Medicos_Sucursales.Tipo_Programacion,Programacion_Medicos_Sucursales.Fecha_Inicio,Programacion_Medicos_Sucursales.ID_H_O_D,
Programacion_Medicos_Sucursales.Fecha_Fin,Programacion_Medicos_Sucursales.Hora_inicio,Programacion_Medicos_Sucursales.Hora_Fin,
Programacion_Medicos_Sucursales.Intervalo,Programacion_Medicos_Sucursales.Estatus,Personal_Medico.Medico_ID,Personal_Medico.Nombre_Apellidos,Personal_Medico.Fk_Usuario,Roles_Puestos.ID_rol,Roles_Puestos.Nombre_rol,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM
Programacion_Medicos_Sucursales,Personal_Medico,Roles_Puestos,SucursalesCorre WHERE Programacion_Medicos_Sucursales.FK_Medico=Personal_Medico.Medico_ID AND
Programacion_Medicos_Sucursales.Fk_Sucursal= SucursalesCorre.ID_SucursalC AND Personal_Medico.Fk_Usuario= Roles_Puestos.ID_rol AND Programacion_Medicos_Sucursales.ID_H_O_D ='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>
<div class="text-center">
  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ProgramacionDeSucursalesModal" class="btn btn-default">
  Establecer nueva programación <i class="fas fa-calendar-week"></i>
</button></div>
<?php if($query->num_rows>0):?>
	<div class="text-center">
  
	<div class="table-responsive">
	<table id="MedicosExpress" class="table ">
<thead>
	<th>Folio</th>
    <th>Nombre</th>
    <th>Sucursal</th>
	<th>Especialidad</th>
    <th>Tipo</th>
    <th>Periodo</th>
    <th>Horario</th>
	<th>Estatus</th>
	<th>Acciones</th>

	


</thead>
<?php while ($Especialidades=$query->fetch_array()):?>
<tr>
	<td><?php echo $Especialidades["ID_Programacion"]; ?></td>
	
	<td><?php echo $Especialidades["Nombre_Apellidos"]; ?></td>
    <td><?php echo $Especialidades["Nombre_Sucursal"]; ?></td>
    <td><?php echo $Especialidades["Nombre_rol"]; ?></td>
    <td><?php echo $Especialidades["Tipo_Programacion"]; ?></td>
    <td><?php echo $Especialidades["Fecha_Inicio"]; ?> <br>
    <?php echo $Especialidades["Fecha_Fin"]; ?> </td>
    <td><?php echo date("g:i a",strtotime($Especialidades["Hora_inicio"])); ?> <br>
    <?php echo date("g:i a",strtotime($Especialidades["Hora_Fin"])); ?> </td>
	<td><button class="btn btn-default btn-sm" style=<?if($Especialidades['Estatus'] == 'Autorizar Fechas'){
   echo "background-color:#fd7e14!important";
} elseif($Especialidades['Estatus'] == 'Autorizar Horas') {
  echo "background-color:#6f42c1!important";
}else {
    echo "background-color:#00c851!important";
}
?>>
<?php if($Especialidades['Estatus'] == ''){
   echo "No se asigno estatus";
} else {
    echo $Especialidades["Estatus"]; 
} ?></button></td>
	 
	 <td>
		 <!-- Basic dropdown -->
<button class="btn btn-primary dropdown-toggle " type="button" data-toggle="dropdown"
  aria-haspopup="true" aria-expanded="false"><i class="fas fa-th-list fa-1x"></i></button>

<div class="dropdown-menu">
<a data-id="<?php echo $Especialidades["ID_Programacion"];?>" style=<?if($Especialidades['Estatus'] =='Autorizar Fechas'){
   
   echo "display:block;";
} else {
  echo "display:none;";
}
?> class="btn-AsigSucursal dropdown-item" >Autorizar fechas <i class="fas fa-calendar-week"></i></a>
  <a data-id="<?php echo $Especialidades["ID_Programacion"];?>" style=<?if($Especialidades['Estatus'] =='Autorizar Horas'){
   
   echo "display:block;";
} else {
  echo "display:none;";
}
?> class="btn-horas dropdown-item" >Autorizar horarios <i class="fas fa-clock"></i></a>

<a data-id="<?php echo $Especialidades["ID_Programacion"];?>" style=<?if($Especialidades['Estatus'] =='Autorizado'){
   
   echo "display:block;";
} else {
  echo "display:none;";
}
?> class="btn-finaliza dropdown-item" >Finalizar <i class="fas fa-info-circle"></i></a>
 
 
</div>
<!-- Basic dropdown -->
	 </td>
	
		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<h3 class="alert alert-warning"> Aún no hay campañas programadas <i class="fas fa-exclamation-circle"></i> </h3>
<?php endif;?>
<script>
  	$(".btn-AsigSucursal").click(function(){
  		id = $(this).data("id");
  		$.post("https://saludapos.com/AgendaDeCitas/Modales/AutorizaFechas.php","id="+id,function(data){
  			$("#form-edit").html(data);
          $("#Titulo").html("Confirmando fechas");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Di").removeClass("modal-dialog modal-xl modal-notify modal-primary");
              $("#Di").removeClass("modal-dialog  modal-lg modal-notify modal-primary");
              $("#Di").removeClass("modal-dialog modal-sm modal-notify modal-danger");
              $("#Di").addClass("modal-dialog  modal-notify modal-primary");
  		});
  		$('#editModal').modal('show');
  	});
    $(".btn-horas").click(function(){
  		id = $(this).data("id");
  		$.post("https://saludapos.com/AgendaDeCitas/Modales/AutorizaHoras.php","id="+id,function(data){
              $("#form-edit").html(data);
              $("#Titulo").html("Confirmado horarios");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Di").removeClass("modal-dialog modal-sm modal-notify modal-danger");
              $("#Di").addClass("modal-dialog  modal-lg modal-notify modal-primary");
  		});
  		$('#editModal').modal('show');
    }); 
    $(".btn-finaliza").click(function(){
  		id = $(this).data("id");
  		$.post("https://saludapos.com/AgendaDeCitas/Modales/FinalizaProgramaSucursal.php","id="+id,function(data){
              $("#form-edit").html(data);
              $("#Titulo").html("Finalizar programacion");
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
        
	        <div class="modal-body">
          <div class="text-center">
        <div id="form-edit"></div>
        
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
<?php

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
