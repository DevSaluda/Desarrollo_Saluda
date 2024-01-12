<script type="text/javascript">
$(document).ready( function () {
    $('#MobiliariosPoragregar').DataTable({
      "order": [[ 0, "desc" ]],
      "lengthMenu": [[1,5 -1], [1,5]],   
      "language": {
        "url": "Componentes/Spanish.json"
		},
    responsive: "true",
        dom: "<'col-sm-12 col-md-6'f>'",
 
		
	  } 
	  
	  );
} );

</script>
<?php

include("db_connection.php");
include "Consultas.php";
include "Sesion.php";

$user_id=null;
$sql1="SELECT Inventarios_Clinicas.ID_Inv_Clic,Inventarios_Clinicas.Cod_Equipo,Inventarios_Clinicas.Cod_Equipo_Repetido,Inventarios_Clinicas.Cantidad_Mobil,
Inventarios_Clinicas.FK_Tipo_Mob,Inventarios_Clinicas.Nombre_equipo,Inventarios_Clinicas.Descripcion,Inventarios_Clinicas.ID_H_O_D,
Inventarios_Clinicas.Fecha_Ingreso,Inventarios_Clinicas.Estatus,Inventarios_Clinicas.CodigoEstatus,
Tipos_Mobiliarios_POS.Tip_Mob_ID,Tipos_Mobiliarios_POS.Nom_Tip_Mob from Inventarios_Clinicas,Tipos_Mobiliarios_POS 
WHERE Inventarios_Clinicas.FK_Tipo_Mob=Tipos_Mobiliarios_POS.Tip_Mob_ID AND Inventarios_Clinicas.Cantidad_Mobil !=0 AND Inventarios_Clinicas.ID_H_O_D ='".$row['ID_H_O_D']."'limit 5";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="MobiliariosPoragregar" class="table table-hover">
<thead>

<th>Codigo mobiliario</th>
    <th>Nombre</th>

<th>Descripcion</th>
<th>Cantidad</th>
	<th >Accciones</th>
	


</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>
<td > <?php echo $Usuarios['Cod_Equipo']; ?> <br><?php echo $Usuarios['Cod_Equipo_Repetido']; ?></td>

  <td > <?php echo $Usuarios['Nombre_equipo']; ?></td>
  <td > <?php echo $Usuarios['Descripcion']; ?>  </td>
  <td > <?php echo $Usuarios['Cantidad_Mobil']; ?>  </td>
  
    <td><button data-id="<?php echo  $Usuarios["ID_Inv_Clic"];?>"  type="button" class="btn-Asignacion btn btn-success btn-sm">Asignar</button>
    </td>
	
		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">Aún no hay mobiliario registrado para  <?echo $row['ID_H_O_D']?></p>
<?php endif;?>
  <!-- Modal -->
  <script>
  	$(".btn-Asignacion").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/AdminPOS/Modales/AsignaMobiliario.php","id="+id,function(data){
  			$("#formMobiliariosAS").html(data);
          $("#TituloMobiliariosAS").html("Asignacion de Mobiliarios por sucursales");
              $("#DiMobiliariosVAS").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#DiMobiliariosVAS").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#DiMobiliariosVAS").removeClass("modal-dialog modal-lg modal-notify modal-primary");
              $("#DiMobiliariosVAS").addClass("modal-dialog  modal-lg modal-notify modal-success");
  		});
  		$('#editModalMobiliariosV').modal('show');
  	});
    
  </script>
  <div class="modal fade" id="editModalMobiliariosV" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalLabel" aria-hidden="true">
  <div id="DiMobiliariosVAS"class="modal-dialog modal-lg modal-notify modal-info">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="TituloMobiliariosAS"></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
        <div id="MensajeMobiliariosPoragregarG"class="alert alert-info alert-styled-left text-blue-800 content-group">
						                <span id="Aviso" class="text-semibold">Estimado usuario, 
                            Verifique los campos antes de realizar alguna accion</span>
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
	        <div class="modal-body">
          <div class="text-center">
        <div id="formMobiliariosAS"></div>
        
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