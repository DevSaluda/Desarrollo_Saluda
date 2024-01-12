<script type="text/javascript">
$(document).ready( function () {
    $('#AreasCreditos').DataTable({
      "order": [[ 0, "desc" ]],
      "lengthMenu": [[10,50, 150, 200, -1], [10,50, 150, 200, "Todos"]],   
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
        responsive: "true",
          dom: "<'#colvis row'><'row'><'row'<'col-md-6'l><'col-md-6'f>r>t<'bottom'ip><'clear'>'",
       
   
	   
        	        
    });     
});
   
	  
	 
</script>
<?php

include("db_connection.php");
include "Consultas.php";
include "Sesion.php";

$user_id=null;
$sql1="SELECT * FROM `Areas_Credit_POS` WHERE ID_H_O_D='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="AreasCreditos" class="table table-hover">
<thead>
  
    <th>N°</th>
    <th>Nombre de área</th>
    
    <th>Estatus</th>
    <th>Acciones</th>
    
	


</thead>
<?php while ($Categorias=$query->fetch_array()):?>
<tr>
<td > <?php echo $Categorias["ID_Area_Cred"]; ?></td>
  <td > <?php echo $Categorias["Nombre_Area"]; ?></td>
  <td> <button style="<?echo $Categorias['CodigoEstatus'];?>" class="btn btn-default btn-sm" > <?php echo $Categorias["Estatus"]; ?></button></td>
  <td>
		 <!-- Basic dropdown -->
<button class="btn btn-primary dropdown-toggle " type="button" data-toggle="dropdown"
  aria-haspopup="true" aria-expanded="false"><i class="fas fa-list-ul"></i></button>

<div class="dropdown-menu">
<a data-id="<?php echo  $Categorias["ID_Area_Cred"];?>" class="btn-editArea dropdown-item" >Editar <i class="fas fa-edit"></i></a>
<a data-id="<?php echo $Categorias["ID_Area_Cred"];?>" class="btn-HistorialAreas dropdown-item" >Movimientos <i class="fas fa-history" aria-hidden="true"></i></a>
 
 
 
 
</div>
<!-- Basic dropdown -->
	 </td>
     
		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">Aun no hay áreas </p>
<?php endif;?>

<script>
  	$(".btn-editArea").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/AdminPOS/Modales/EditaAreaCredito.php","id="+id,function(data){
  			$("#EditAreas").html(data);
          $("#TituloAreas").html("Editar área de crédito");
        
          $("#DiAreas").removeClass(" modal-dialog modal-lg modal-notify modal-info");
              $("#DiAreas").removeClass("modal-dialog modal-xl modal-notify modal-primary");
              $("#DiAreas").addClass("modal-dialog  modal-notify modal-info");
  		});
  		$('#ModalAreas').modal('show');
  	});
    $(".btn-HistorialAreas").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/AdminPOS/Modales/HistorialAreasCreditos.php","id="+id,function(data){
              $("#EditAreas").html(data);
              $("#TituloAreas").html("Movimientos aplicados en el área");
              $("#DiAreas").removeClass(" modal-dialog modal-lg modal-notify modal-info");
              $("#DiAreas").removeClass("modal-dialog  modal-notify modal-info");
              $("#DiAreas").addClass("modal-dialog modal-xl modal-notify modal-primary");
  		});
  		$('#ModalAreas').modal('show');
    });
  </script>
  <div class="modal fade" id="ModalAreas" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="ModalAreasLabel" aria-hidden="true">
  <div id="DiAreas"class="modal-dialog modal-lg modal-notify modal-info">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="TituloAreas"></p>

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
        <div id="EditAreas"></div>
        
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