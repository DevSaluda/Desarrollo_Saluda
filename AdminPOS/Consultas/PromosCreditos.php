<script type="text/javascript">
$(document).ready( function () {
    $('#PromosCreditos').DataTable({
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


$user_id=null;
$sql1="SELECT Promos_Credit_POS.ID_Promo_Cred,Promos_Credit_POS.Nombre_Promo,
Promos_Credit_POS.CantidadADescontar, Promos_Credit_POS.Fk_Tratamiento,
Promos_Credit_POS.Estatus,Promos_Credit_POS.CodigoEstatus,Promos_Credit_POS.ID_H_O_D, 
Tipos_Credit_POS.ID_Tip_Cred,Tipos_Credit_POS.Nombre_Tip FROM Promos_Credit_POS,Tipos_Credit_POS where 
Promos_Credit_POS.Fk_Tratamiento = Tipos_Credit_POS.ID_Tip_Cred and Promos_Credit_POS.ID_H_O_D ='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="PromosCreditos" class="table table-hover">
<thead>
<th>Folio</th>
    <th>Nombre promocion</th>
    <th>Descuento</th>
    <th>Tratamiento</th>
    <th>Estatus</th>
    <th>Acciones</th>
    
	


</thead>
<?php while ($Categorias=$query->fetch_array()):?>
<tr>
<td > <?php echo $Categorias["ID_Promo_Cred"]; ?></td>
<td > <?php echo $Categorias["Nombre_Promo"]; ?></td>
<td > <?php echo $Categorias["CantidadADescontar"]; ?></td>
  <td > <?php echo $Categorias["Nombre_Tip"]; ?></td>
  <td> <button style="<?php echo $Categorias['CodigoEstatus'];?>" class="btn btn-default btn-sm" > <?php echo $Categorias["Estatus"]; ?></button></td>
  <td>
		 <!-- Basic dropdown -->
<button class="btn btn-primary dropdown-toggle " type="button" data-toggle="dropdown"
  aria-haspopup="true" aria-expanded="false"><i class="fas fa-list-ul"></i></button>

<div class="dropdown-menu">
<a data-id="<?php echo  $Categorias["ID_Promo_Cred"];?>" class="btn-editPromos dropdown-item" >Editar <i class="fas fa-edit"></i></a>
<a data-id="<?php echo $Categorias["ID_Promo_Cred"];?>" class="btn-HistorialPromos dropdown-item" >Movimientos <i class="fas fa-history" aria-hidden="true"></i></a>
 
 
 
 
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
  	$(".btn-editPromos").click(function(){
  		id = $(this).data("id");
  		$.post("https://saludapos.com/AdminPOS/Modales/EditaPromo.php","id="+id,function(data){
  			$("#EditPromos").html(data);
          $("#TituloPromos").html("Editar área de crédito");
        
          $("#DiPromos").removeClass(" modal-dialog modal-lg modal-notify modal-info");
              $("#DiPromos").removeClass("modal-dialog modal-xl modal-notify modal-primary");
              $("#DiPromos").addClass("modal-dialog  modal-notify modal-info");
  		});
  		$('#ModalPromos').modal('show');
  	});
    $(".btn-HistorialPromos").click(function(){
  		id = $(this).data("id");
  		$.post("https://saludapos.com/AdminPOS/Modales/HistorialPromosCreditos.php","id="+id,function(data){
              $("#EditPromos").html(data);
              $("#TituloPromos").html("Movimientos aplicados en el área");
              $("#DiPromos").removeClass(" modal-dialog modal-lg modal-notify modal-info");
              $("#DiPromos").removeClass("modal-dialog  modal-notify modal-info");
              $("#DiPromos").addClass("modal-dialog modal-xl modal-notify modal-primary");
  		});
  		$('#ModalPromos').modal('show');
    });
  </script>
  <div class="modal fade" id="ModalPromos" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="ModalPromosLabel" aria-hidden="true">
  <div id="DiPromos"class="modal-dialog modal-lg modal-notify modal-info">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="TituloPromos"></p>

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
        <div id="EditPromos"></div>
        
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