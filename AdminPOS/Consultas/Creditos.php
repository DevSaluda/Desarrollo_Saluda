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


$user_id=null;
$sql1="SELECT Creditos_POS.Folio_Credito,Creditos_POS.Fk_tipo_Credi,Creditos_POS.Nombre_Cred,
Creditos_POS.Cant_Apertura,Creditos_POS.Costo_Tratamiento,Creditos_POS.Fk_Sucursal,Creditos_POS.Validez,
Creditos_POS.Saldo,Creditos_POS.Promocion,Creditos_POS.Costo_Descuento, Creditos_POS.Estatus,
Creditos_POS.CodigoEstatus,Creditos_POS.ID_H_O_D,Tipos_Credit_POS.ID_Tip_Cred, 
Tipos_Credit_POS.Nombre_Tip,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM Creditos_POS,Tipos_Credit_POS,SucursalesCorre WHERE
 Creditos_POS.Fk_tipo_Credi=Tipos_Credit_POS.ID_Tip_Cred AND Creditos_POS.Fk_Sucursal = SucursalesCorre.ID_SucursalC 
  AND Creditos_POS.Saldo !=0.00 AND Creditos_POS.ID_H_O_D='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
 
  <div class="text-center">
	<div class="table-responsive">
	<table  id="CreditosDisponibles" class="table table-hover">
<thead>
  
    <th style="background-color:#0057b8 !important;">N°</th>
    <th style="background-color:#0057b8 !important;">Tipo de crédito</th>
    <th style="background-color:#0057b8 !important;">Titular</th>
    <th style="background-color:#0057b8 !important;">Sucursal</th>
    <th style="background-color:#0057b8 !important;">Costo tratamiento</th>
    <th style="background-color:#0057b8 !important;">Promocion / Descuento</th>
    <th style="background-color:#0057b8 !important;">Costo total</th>
    <th style="background-color:#0057b8 !important;">Saldo</th>
    <th style="background-color:#0057b8 !important;">Validez</th>
    <th style="background-color:#0057b8 !important;">Acciones</th>
    
	


</thead>
<?php while ($Categorias=$query->fetch_array()):?>
<tr>
<td > <?php echo $Categorias["Folio_Credito"]; ?></td>
  <td > <?php echo $Categorias["Nombre_Tip"]; ?></td>
  <td > <?php echo $Categorias["Nombre_Cred"]; ?></td>
  <td > <?php echo $Categorias["Nombre_Sucursal"]; ?></td>
  <td > $<?php echo $Categorias["Costo_Tratamiento"]; ?></td>
  <td > <?php echo $Categorias["Promocion"]; ?> <br>
  $<?php echo $Categorias["Costo_Descuento"]; ?></td>
  
  <td > $<?php echo $Categorias["Cant_Apertura"]; ?></td>
  <td > $<?php echo $Categorias["Saldo"]; ?></td>
  <td > <?php echo fechaCastellano($Categorias["Validez"]); ?></td>
 
  <td>
		 <!-- Basic dropdown -->
<button class="btn btn-primary btn-sm dropdown-toggle " type="button" data-toggle="dropdown"
  aria-haspopup="true" aria-expanded="false"><i class="fas fa-list-ul"></i></button>

<div class="dropdown-menu">
<a data-id="<?php echo  $Categorias["Folio_Credito"];?>" class="btn-edit dropdown-item" >Abonar <i class="fas fa-edit"></i></a>
<a data-id="<?php echo $Categorias["Folio_Credito"];?>" class="btn-edit2 dropdown-item" >Ver movimientos <i class="fas fa-info-circle"></i></a>
<a data-id="<?php echo $Categorias["Folio_Credito"];?>" class="btn-edit3 dropdown-item" >Realizar ajuste <i class="fas fa-info-circle"></i></a>
 
 
 
 
</div>
<!-- Basic dropdown -->
	 </td>
     
		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">No hay créditos pendientes</p>
<?php endif;?>

<script>
  	$(".btn-edit").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/AdminPOS/Modales/AbonoCredito.php","id="+id,function(data){
  			$("#form-edit").html(data);
          $("#Titulo").html("Abono de crédito");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Di").removeClass("modal-dialog modal-xl modal-notify modal-primary");
              $("#Di").addClass("modal-dialog  modal-notify modal-info");
  		});
  		$('#editModal').modal('show');
  	});
    $(".btn-edit2").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/AdminPOS/Modales/HistorialSaldos.php","id="+id,function(data){
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
                            Verifique los campos antes de realizar alguna acción</span>
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