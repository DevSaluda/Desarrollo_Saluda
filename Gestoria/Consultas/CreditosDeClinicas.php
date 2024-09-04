<script type="text/javascript">
$(document).ready( function () {
    $('#CreditosClinicas').DataTable({
      "order": [[ 0, "desc" ]],
      "lengthMenu": [[25,50, 150, 200, -1], [25,50, 150, 200, "Todos"]],   
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
include "ConsultaCaja.php";

$user_id=null;
$sql1="SELECT Creditos_Clinicas_POS.Folio_Credito,Creditos_Clinicas_POS.Fk_tipo_Credi,Creditos_Clinicas_POS.Nombre_Cred,
Creditos_Clinicas_POS.Fecha_Inicio,Creditos_Clinicas_POS.Fk_Sucursal,Creditos_Clinicas_POS.Estatus,Creditos_Clinicas_POS.CodigoEstatus,
Creditos_Clinicas_POS.ID_H_O_D,Creditos_Clinicas_POS.Saldo, SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM
Creditos_Clinicas_POS,SucursalesCorre where Creditos_Clinicas_POS.Fk_Sucursal = SucursalesCorre.ID_SucursalC and Creditos_Clinicas_POS.Estatus='Vigente' AND Creditos_Clinicas_POS.ID_H_O_D ='".$row['ID_H_O_D']."'
AND Creditos_Clinicas_POS.Fk_Sucursal ='".$row['Fk_Sucursal']."'";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="CreditosDisponibles" class="table table-hover">
<thead>
  
<th>N°</th>
    <th>Titular</th>
    
    <th>Sucursal</th>
  
    
    <th>Saldo</th>

    <th>Acciones</th>
    
	


</thead>
<?php while ($Categorias=$query->fetch_array()):?>
<tr>
<td > <?php echo $Categorias["Folio_Credito"]; ?></td>
 
  <td > <?php echo $Categorias["Nombre_Cred"]; ?></td>

  <td > <?php echo $Categorias["Nombre_Sucursal"]; ?></td>

  <td > $<?php echo $Categorias["Saldo"]; ?></td>
 

  <td>
		 <!-- Basic dropdown -->
<button class="acciones btn btn-primary btn-sm dropdown-toggle " type="button"  data-toggle="dropdown"
  aria-haspopup="true" aria-expanded="false"><i class="fas fa-list-ul"></i></button>

<div class="dropdown-menu">
<a data-id="<?php echo  $Categorias["Folio_Credito"];?>" class="btn-AddProducto dropdown-item" >Agregar productos <i class="fas fa-barcode"></i></a>
<a data-id="<?php echo $Categorias["Folio_Credito"];?>" class="btn-HistorialCreditoClinica dropdown-item" >Ver movimientos <i class="fas fa-info-circle"></i></a>
<a data-id="<?php echo $Categorias["Folio_Credito"];?> "  class="btn-finaliza dropdown-item" > Finalizar <i class="fas fa-minus"></i></a>

 

 
 
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

<script>
  	$(".btn-AddProducto").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/POS2/Modales/AgregaProdCred.php","id="+id,function(data){
  			$("#form-editClini").html(data);
          $("#TituloClini").html("Abono de credito");
              $("#DiClini").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#DiClini").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#DiClini").removeClass("modal-dialog modal-xl modal-notify modal-primary");
              $("#DiClini").addClass("modal-dialog modal-lg modal-notify modal-info");
  		});
  		$('#editModalClini').modal('show');
  	});
    $(".btn-HistorialCreditoClinica").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/POS2/Modales/HistorialSaldosClinicas.php","id="+id,function(data){
              $("#form-editClini").html(data);
              $("#TituloClini").html("Historial de pagos");
              $("#DiClini").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#DiClini").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#DiClini").addClass("modal-dialog modal-xl modal-notify modal-primary");
  		});
  		$('#editModalClini').modal('show');
    });
    $(".btn-finaliza").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/POS2/Modales/FinalizaCreditoClinicas.php","id="+id,function(data){
              $("#form-editClini").html(data);
              $("#TituloClini").html("Finalizando credito");
              $("#DiClini").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#DiClini").removeClass("modal-dialog modal-xl modal-notify modal-primary");
              $("#DiClini").addClass("modal-dialog modal-notify modal-primary");
  		});
  		$('#editModalClini').modal('show');
    });
  </script>
  <div class="modal fade" id="editModalClini"  role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalLabel" aria-hidden="true">
  <div id="DiClini"class="modal-dialog modal-lg modal-notify modal-info">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="TituloClini"></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
        <div id="MensajeClini "class="alert alert-info alert-styled-left text-blue-800 content-group">
						                <span id="Aviso" class="text-semibold">Estimado usuario, 
                            Verifique los campos antes de realizar alguna accion</span>
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
	        <div class="modal-body">
          <div class="text-center">
        <div id="form-editClini"></div>
        
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
<?php
if($ValorCaja["Estatus"] == 'Abierta'){

  echo '
  <script>
$(document).ready(function()
{
// id de nuestro modal

$(".acciones").attr("disabled", false);
});
</script>
  ';
     }else{
    
      echo '
      <script>
$(document).ready(function()
{
  // id de nuestro modal

  $(".acciones").attr("disabled", true);
});
</script>
      ';
      
      
    
     } ?>