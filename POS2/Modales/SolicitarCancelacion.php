
<script type="text/javascript">
$(document).ready( function () {
    var printCounter = 0;
    $('#HistorialCajas').DataTable({
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
<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";

$user_id=null;
$sql1= "SELECT DISTINCT Ventas_POS.Fk_Caja,Ventas_POS.Venta_POS_ID,Ventas_POS.Identificador_tipo,Ventas_POS.Folio_Ticket,Ventas_POS.Cod_Barra,Ventas_POS.Clave_adicional,
Ventas_POS.Nombre_Prod,Ventas_POS.Cantidad_Venta,Ventas_POS.Fk_sucursal,Ventas_POS.AgregadoPor,Ventas_POS.AgregadoEl,
Ventas_POS.Total_Venta,Ventas_POS.Lote,Ventas_POS.ID_H_O_D,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM 
Ventas_POS,SucursalesCorre WHERE Ventas_POS.Fk_sucursal= SucursalesCorre.ID_SucursalC AND Ventas_POS.ID_H_O_D ='".$row['ID_H_O_D']."' AND 
Fk_Caja= ".$_POST["id"];
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="HistorialCajas" class="table table-hover">
<thead>


<th>N° Ticket</th>
    <th>Cod producto</th>
  
    <th>Nom Prod</th>
   
    <th>Fecha|Hora</th>
    <th>Solicitar</th>



</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>



    <td><?php echo $Usuarios["Folio_Ticket"]; ?></td>
      <td><?php echo $Usuarios["Cod_Barra"]; ?></button></td>
     
      <td><?php echo $Usuarios["Nombre_Prod"]; ?></button></td>

      <td><?php echo fechaCastellano($Usuarios["AgregadoEl"]); ?> <br>
      <?php echo date("g:i a",strtotime($Usuarios["AgregadoEl"])); ?>
    </td>
    <td>  <button data-id="<?php echo $Usuarios["Venta_POS_ID"];?>" class="btn-cancelacion btn btn-dark btn-sm"  >Enviar cancelación <i class="fas fa-ban"></i></button></td>
        
     
      
   
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">No hay resultados</p>
<?php endif;?>
<script>
    $(".btn-cancelacion").click(function(){
    id = $(this).data("id");
    $.post("https://saludapos.com/POS2/Modales/EnviaSolicitudCancelacion.php","id="+id,function(data){
        $("#FormSolicitud").html(data);
        $("#dddd").removeClass("modal-dialog modal-lg modal-notify modal-info");
        $("#dddd").addClass("modal-dialog modal-notify modal-primary");
       

         
    });
    $('#CSolcita').modal('show');
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
 <div class="modal fade" id="CSolcita" tabindex="-2" role="dialog" style="overflow-y: scroll;" aria-labelledby="CSolcitaLabel" aria-hidden="true">
  <div id="dddd" class="modal-dialog modal-lg modal-notify modal-info">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="TituloCancelacion">Confirmacion de ticket</p>

       </div>
       
	        <div class="modal-body">
          <div class="text-center">
        <div id="FormSolicitud"></div>
        
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->