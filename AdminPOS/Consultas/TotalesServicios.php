<?$fcha = date("Y-m-d");?>
<script type="text/javascript">
$(document).ready( function () {
    $('#Servicios').DataTable({
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
        dom: "B<'#colvis row'><'row'><'row'<'col-md-6'l><'col-md-6'f>r>t<'bottom'ip><'clear'>'",
          buttons:[ 
			{
				extend:    'excelHtml5',
				text:      'Exportar a Excel  <i Exportar a Excel class="fas fa-file-excel"></i> ',
                titleAttr: 'Exportar a Excel',
                title: 'Totales de servicios del  <?echo $fcha;?>  ',
				className: 'btn btn-success'
			},
			
			
          
            
        ],
   
	   
        	        
    });  
	  
	
} );
</script>
<?php
include("db_connection.php");
include "Consultas.php";
include "Sesion.php";

$user_id=null;
$sql1="SELECT Ventas_POS.Identificador_tipo,Ventas_POS.Fk_sucursal,Ventas_POS.ID_H_O_D,Ventas_POS.Fecha_venta,Ventas_POS.Turno,Ventas_POS.AgregadoPor,
Ventas_POS.AgregadoEl,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal,
Servicios_POS.Servicio_ID,Servicios_POS.Nom_Serv,SUM(Ventas_POS.Importe) as totaldeservicios FROM
 Ventas_POS,Servicios_POS,SucursalesCorre WHERE Ventas_POS.Identificador_tipo = Servicios_POS.Servicio_ID 
 AND Ventas_POS.Fk_sucursal=SucursalesCorre.ID_SucursalC  AND Ventas_POS.ID_H_O_D ='".$row['ID_H_O_D']."' AND
 Ventas_POS.Fecha_venta = CURDATE() 
  GROUP by Servicios_POS.Servicio_ID,Ventas_POS.AgregadoPor,Ventas_POS.Turno";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="Servicios" class="table table-hover">
<thead>

<th>Sucursal</th>
<th>Vendedor</th>
<th>Turno</th>
<th>Nombre Servicio</th>

    <th>Total</th>
    
    
    


</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>



    <td><?php echo $Usuarios["Nombre_Sucursal"]; ?></td>
    <td> <?php echo $Usuarios["AgregadoPor"]; ?></td>
    <td> <?php echo $Usuarios["Turno"]; ?></td>
    <td> <?php echo $Usuarios["Nom_Serv"]; ?></td>
    <td>$<?php echo $Usuarios["totaldeservicios"]; ?></td>
   
    
		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">Aún no hay totales registrados </p>
<?php endif;?>
  <!-- Modal -->
  <script>
  	$(".btn-edit").click(function(){
  		id = $(this).data("id");
  		$.post("https://saludapos.com/AdminPOS/Modales/ContactoProveedor.php","id="+id,function(data){
  			$("#form-edit").html(data);
          $("#Titulo").html("Medios disponibles para contactar al proveedor");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-primary");
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