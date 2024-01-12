<?$fcha = date("Y-m-d");?>
<script type="text/javascript">
$(document).ready( function () {
    $('#TotalesDiariosCortes').DataTable({
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
                title: 'Totales descargado el  <?echo $fcha;?>  ',
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
$sql1="SELECT Cajas_POS.ID_Caja,Cajas_POS.Fecha_Apertura,Cajas_POS.Cantidad_Fondo,Cajas_POS.Sucursal,
Cajas_POS.Empleado,Cajas_POS.ID_H_O_D,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal ,
Cortes_Cajas_POS.Fk_Caja,Cortes_Cajas_POS.Valor_Total_Caja,SUM(Cajas_POS.Valor_Total_Caja- Cajas_POS.Cantidad_Fondo) as TotalDeCajasCortes 
FROM Cajas_POS,SucursalesCorre,Cortes_Cajas_POS WHERE Cajas_POS.Sucursal = SucursalesCorre.ID_SucursalC 
AND Cajas_POS.ID_Caja = Cortes_Cajas_POS.Fk_Caja AND  Cajas_POS.ID_H_O_D  ='".$row['ID_H_O_D']."' AND Cajas_POS.Fecha_Apertura = CURDATE() GROUP BY Fecha_Apertura";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="TotalesDiariosCortes" class="table table-hover">
<thead>


<th>Fecha apertura</th>
<th>Cantidad fondo</th>
    <th>Empleado</th>
    <th>Sucursal</th>
    <th>Total de corte</th>
    <th>Total</th>
    
    


</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>



    <td><?php echo $Usuarios["Fecha_Apertura"]; ?></td>
    <td>$ <?php echo $Usuarios["Cantidad_Fondo"]; ?></td>
    <td><?php echo $Usuarios["Empleado"]; ?></td>
    <td><?php echo $Usuarios["Nombre_Sucursal"]; ?></td>
    <td>$ <?php echo $Usuarios["Valor_Total_Caja"]; ?></td>
    <td>$ <?php echo $Usuarios["TotalDeCajasCortes"]; ?></td>
    
		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">Aún no hay proveedores registrados para <?echo $row['ID_H_O_D']?></p>
<?php endif;?>
  <!-- Modal -->
  <script>
  	$(".btn-edit").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/AdminPOS/Modales/ContactoProveedor.php","id="+id,function(data){
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