<script type="text/javascript">
$(document).ready( function () {
    $('#CreditosDisponibles').DataTable({
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

$user_id=null;
$sql1="SELECT AbonoCreditos_POS.Folio_Abono,AbonoCreditos_POS.Fk_Folio_Credito,AbonoCreditos_POS.Fk_tipo_Credi,AbonoCreditos_POS.Nombre_Cred, AbonoCreditos_POS.Cant_Apertura,
AbonoCreditos_POS.Cant_Abono,AbonoCreditos_POS.Fecha_Abono,AbonoCreditos_POS.Fk_Sucursal,AbonoCreditos_POS.Saldo,AbonoCreditos_POS.Estatus, AbonoCreditos_POS.CodigoEstatus,
AbonoCreditos_POS.ID_H_O_D,Tipos_Credit_POS.ID_Tip_Cred,Tipos_Credit_POS.Nombre_Tip,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM 
AbonoCreditos_POS,Tipos_Credit_POS,SucursalesCorre where AbonoCreditos_POS.Fk_tipo_Credi = Tipos_Credit_POS.ID_Tip_Cred and 
AbonoCreditos_POS.Fk_Sucursal= SucursalesCorre.ID_SucursalC  AND AbonoCreditos_POS.ID_H_O_D ='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="CreditosDisponibles" class="table table-hover">
<thead>
  
    <th>N°</th>
    <th>Tratamiento</th>
    <th>Titular</th>
 
    <th>Fecha abono</th>
    <th>Saldo anterior</th>
    <th>Abono</th>
    <th>Saldo</th>
    <th>Estatus</th>
    <th>Acciones</th>
    
	


</thead>
<?php while ($Categorias=$query->fetch_array()):?>
<tr>

<td > <?php echo $Categorias["Folio_Abono"]; ?></td>

  <td > <?php echo $Categorias["Nombre_Tip"]; ?></td>
  <td > <?php echo $Categorias["Nombre_Cred"]; ?></td>
 
  <td > <?php echo $Categorias["Fecha_Abono"]; ?></td>
  <td > $<?php echo $Categorias["Cant_Apertura"]; ?></td>
  <td > $<?php echo $Categorias["Cant_Abono"]; ?></td>
  <td > $<?php echo $Categorias["Saldo"]; ?></td>
  
  <td> <button style="<?echo $Categorias['CodigoEstatus'];?>" class="btn btn-default btn-sm" > <?php echo $Categorias["Estatus"]; ?></button></td>
  <td>
		 <!-- Basic dropdown -->
<button class="btn btn-primary dropdown-toggle " type="button" data-toggle="dropdown"
  aria-haspopup="true" aria-expanded="false"><i class="fas fa-list-ul"></i></button>

<div class="dropdown-menu">

<a data-id="<?php echo  $Categorias["Fk_Folio_Credito"];?>" class="btn-desglosaTicket dropdown-item" >Desglose Ticket <i class="fas fa-receipt"></i></a>
 
 
 
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
  	$(".btn-edit").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/POS2/Modales/ReimprimeAbono.php","id="+id,function(data){
  			$("#form-edit").html(data);
          $("#Titulo").html("Generando reimpresion");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Di").removeClass("modal-dialog modal-xl modal-notify modal-primary");
              $("#Di").addClass("modal-dialog  modal-notify modal-info");
  		});
  		$('#editModal').modal('show');
  	});
    $(".btn-desglosaTicket").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/AdminPOS/Modales/DesglosaTicketAbono.php","id="+id,function(data){
  			$("#form-edit").html(data);
          $("#Titulo").html("Desglose de ticket");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di").removeClass("modal-dialog  modal-notify modal-info");
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