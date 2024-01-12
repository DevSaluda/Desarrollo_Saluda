
<script>

tabla = $('#Productos').DataTable({

 "bProcessing": true,
 "ordering": true,
 "stateSave":true,
 "bAutoWidth": true,
 "order": [[ 0, "desc" ]],
 "sAjaxSource": "https://controlfarmacia.com/AdminPOS/Consultas/ArrayDesgloseVentasLibres.php",
 "aoColumns": [
       { mData: 'Cod_Barra' },
       { mData: 'Nombre_Prod' },
       { mData: 'FolioTicket' },
       { mData: 'Turno' },
       { mData: 'Sucursal' }, 
       { mData: 'Cantidad_Venta' },
       { mData: 'Total_Venta' },
       { mData: 'Importe' },
       { mData: 'Descuento' },
       { mData: 'FormaPago' },
       { mData: 'Cliente' },
       { mData: 'FolioSignoVital' },
       { mData: 'NomServ' },
       { mData: 'AgregadoEl' },
       { mData: 'AgregadoEnMomento' },
       { mData: 'AgregadoPor' },
       { mData: 'Enfermero' },
       { mData: 'Doctor' },
      
      
  
      ],
     
    
      "lengthMenu": [[10,20,150,250,500, -1], [10,20,50,250,500, "Todos"]],  
  
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
          
            responsive: "true",
          dom: "<'#colvis row'><'row'><'row'<'col-md-6'l><'col-md-6'f>r>t<'bottom'ip><'clear'>'",
        // buttons:[ 
		// 	{
		// 		extend:    'excelHtml5',
		// 		text:      'Exportar a Excel  <i Exportar a Excel class="fas fa-file-excel"></i> ',
		// 		titleAttr: 'Exportar a Excel',
        //         title: 'registro de ventas general',
		// 		className: 'btn btn-success'
		// 	},
			
		
        // ],
       
   
	   
        	        
    });     

   
       
        

</script>
<div class="text-center">
	<div class="table-responsive">
	<table  id="Productos" class="table table-hover">
<thead>

<th>Cod</th>
<th>Nombre</th>
<th>N° Ticket</th>
<th>Turno</th>
<th>Sucursal</th>
<th>Cantidad</th>
<th>P.U</th>
<th>Importe</th> 
<th>Descuento</th>
<th>Forma de pago</th>
<th>Cliente</th>
<th>Folio Signo Vital</th>
<th>Servicio</th>
<th>Fecha</th>
<th>Hora</th>   
<th>Vendedor</th>
<th>Enfermero</th>
<th>Doctor</th>



</thead>

</div>
</div>
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

<!-- <script>
  $(".btn-edit").click(function(){
    id = $(this).data("id");
    $.post("https://controlfarmacia.com/AdminPOS/Modales/ReasignaProducto.php","id="+id,function(data){
        alert($(this).data("id"));
        $("#form-editProductosG").html(data);
    $("#TituloProductosG").html("Asignacion de productos en otras sucursales");
       
        $("#DiProductosG").removeClass("modal-dialog  modal-xl modal-notify modal-info");
        $("#DiProductosG").removeClass("modal-dialog modal-lg modal-notify modal-primary");
        $("#DiProductosG").addClass("modal-dialog  modal-xl modal-notify modal-success");
    });
    $('#editModalProductosG').modal('show'); 
});
$(".btn-VerDistribucion").click(function(){
    id = $(this).data("id");
    $.post("https://controlfarmacia.com/AdminPOS/Modales/DistribucionesProductos.php","id="+id,function(data){
        $("#form-editProductosG").html(data);
    $("#TituloProductosG").html("Distribucion de productos");
       
        $("#DiProductosG").removeClass("modal-dialog modal-lg modal-notify modal-danger");
        $("#DiProductosG").removeClass("modal-dialog modal-lg modal-notify modal-primary");
        $("#DiProductosG").addClass("modal-dialog  modal-xl modal-notify modal-info");
    });
    $('#editModalProductosG').modal('show');
});
$(".btn-editProd").click(function(){
    id = $(this).data("id");
    $.post("https://controlfarmacia.com/AdminPOS/Modales/EditaProductosStockGeneral.php","id="+id,function(data){
        $("#form-editProductosG").html(data);
    $("#TituloProductosG").html("Editar datos");
       
        $("#DiProductosG").removeClass("modal-dialog modal-lg modal-notify modal-danger");
        $("#DiProductosG").removeClass("modal-dialog modal-lg modal-notify modal-primary");
        $("#DiProductosG").addClass("modal-dialog  modal-xl modal-notify modal-info");
    });
    $('#editModalProductosG').modal('show');
});
$(".btn-History").click(function(){
    id = $(this).data("id");
    $.post("https://controlfarmacia.com/AdminPOS/Modales/HistorialProductos.php","id="+id,function(data){
        $("#form-editProductosG").html(data);
    $("#TituloProductosG").html("Actualizaciones y movimientos");
       
        $("#DiProductosG").removeClass("modal-dialog modal-lg modal-notify modal-danger");
        $("#DiProductosG").removeClass("modal-dialog modal-lg modal-notify modal-primary");
        $("#DiProductosG").addClass("modal-dialog  modal-xl modal-notify modal-info");
    });
    $('#editModalProductosG').modal('show');
});


$(".btn-Delete").click(function(){
    id = $(this).data("id");
    $.post("https://controlfarmacia.com/AdminPOS/Modales/DeleteProductos.php","id="+id,function(data){
        alert($(this).data("id"));
        $("#form-editProductosG").html(data);
    $("#TituloProductosG").html("Eliminar producto");
       
        $("#DiProductosG").removeClass("modal-dialog modal-lg modal-notify modal-danger");
        $("#DiProductosG").removeClass("modal-dialog modal-lg modal-notify modal-primary");
        $("#DiProductosG").removeClass("modal-dialog  modal-xl modal-notify modal-info");
        $("#DiProductosG").addClass("modal-dialog modal-sm modal-notify modal-danger");
    });
    $('#editModalProductosG').modal('show');
});


</script>


  <div class="modal fade" id="editModalProductosG" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalLabel" aria-hidden="true">
  <div id="DiProductosG"class="modal-dialog modal-lg modal-notify modal-info">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="TituloProductosG"></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
       
	        <div class="modal-body">
          <div class="text-center">
        <div id="form-editProductosG"></div>
        
        </div>

      </div>
    </div>
  </div> -->
