
<script type="text/javascript">
$(document).ready( function () {
    var printCounter = 0;
    $('#VEntas').DataTable({
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
<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";

$user_id=null;
$sql1= "SELECT Ventas_POS.Turno,Ventas_POS.Fk_sucursal,SUM(Ventas_POS.Importe) as TotalGenerado,Ventas_POS.Fecha_venta,Ventas_POS.AgregadoPor, 
SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM Ventas_POS,SucursalesCorre WHERE Ventas_POS.Fk_sucursal=SucursalesCorre.ID_SucursalC AND 
Fecha_venta =CURDATE() GROUP BY Ventas_POS.AgregadoPor,Ventas_POS.Turno,SucursalesCorre.Nombre_Sucursal,Ventas_POS.Fecha_venta ORDER BY `SucursalesCorre`.`ID_SucursalC` ASC";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="VEntas" class="table table-hover">
<thead>


<th style ="background-color:#0057b8 !important;">Turno</th>
<th style ="background-color:#0057b8 !important;">Sucursal</th>
    <th style ="background-color:#0057b8 !important;">Vendedor</th>
    <th style ="background-color:#0057b8 !important;">Fecha</th>
    <th style ="background-color:#0057b8 !important;">Total Generado</th>
    


</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>



    <td><?php echo $Usuarios["Turno"]; ?></td>
    <td><?php echo $Usuarios["Nombre_Sucursal"]; ?></td>
     <td><?php echo $Usuarios["AgregadoPor"]; ?></td>
    <td><?php echo fechaCastellano($Usuarios["Fecha_venta"]); ?> </td>
    <td><?php echo $Usuarios["TotalGenerado"]; ?></td>
   
  
     
      
   
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">No hay resultados</p>
<?php endif;?>
<script>
    $(".btn-desglose").click(function(){
    id = $(this).data("id");
    $.post("https://controlfarmacia.com/AdminPOS/Modales/DesgloseTicket.php","id="+id,function(data){
        $("#FormCancelacion").html(data);
        $("#TituloCancelacion").html("Desglose del ticket");
        $("#Di3").removeClass("modal-dialog modal-lg modal-notify modal-info");
        $("#Di3").removeClass("modal-dialog modal-xl modal-notify modal-success");
        $("#Di3").addClass("modal-dialog modal-xl modal-notify modal-primary");
        var modal_lv = 0;
          $('.modal').on('shown.bs.modal', function (e) {
            $('.modal-backdrop:last').css('zIndex', 1051 + modal_lv);
            $(e.currentTarget).css('zIndex', 1052 + modal_lv);
            modal_lv++
          });

          $('.modal').on('hidden.bs.modal', function (e) {
            modal_lv--
          });
    });
    $('#Cancelacionmodal').modal('show');
});

$(".btn-Reimpresion").click(function(){
    id = $(this).data("id");
    $.post("https://controlfarmacia.com/AdminPOS/Modales/ReimpresionTicketVenta.php","id="+id,function(data){
        $("#FormCancelacion").html(data);
        $("#TituloCancelacion").html("Editar datos de categoría");
        $("#Di3").removeClass("modal-dialog modal-lg modal-notify modal-info");
        $("#Di3").removeClass("modal-dialog modal-xl modal-notify modal-primary");
        $("#Di3").addClass("modal-dialog modal-xl modal-notify modal-success");
        var modal_lv = 0;
          $('.modal').on('shown.bs.modal', function (e) {
            $('.modal-backdrop:last').css('zIndex', 1051 + modal_lv);
            $(e.currentTarget).css('zIndex', 1052 + modal_lv);
            modal_lv++
          });

          $('.modal').on('hidden.bs.modal', function (e) {
            modal_lv--
          });
    });
    $('#Cancelacionmodal').modal('show');
});
</script>
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
 <div class="modal fade" id="Cancelacionmodal" tabindex="-2" role="dialog" style="overflow-y: scroll;" aria-labelledby="CancelacionmodalLabel" aria-hidden="true">
  <div id="Di3" class="modal-dialog modal-lg modal-notify modal-info">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="TituloCancelacion">Confirmacion de ticket</p>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
       
	        <div class="modal-body">
          <div class="text-center">
        <div id="FormCancelacion"></div>
        
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->