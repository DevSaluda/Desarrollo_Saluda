
<script>

tabla = $('#ProductosFarmaceutico').DataTable({

 "bProcessing": true,
 "ordering": true,
 "stateSave":true,
 "bAutoWidth": true,
 "order": [[ 0, "desc" ]],
 "sAjaxSource": "https://controlfarmacia.com/AdminPOS/Consultas/ArrayDesgloseVentasCreditoFarmaceutico.php",
 "aoColumns": [
       { mData: 'Cod_Barra' },
       { mData: 'Nombre_Prod' },
       { mData: 'FolioTicket' },
       { mData: 'Turno' },
       { mData: 'Cantidad_Venta' },
       { mData: 'Total_Venta' },
       { mData: 'Importe' },
       { mData: 'FormaPago' },
       { mData: 'NomServ' },
       { mData: 'Sucursal' },
       { mData: 'Cliente' },
       { mData: 'AgregadoEl' },
       { mData: 'AgregadoEnMomento' },
       { mData: 'AgregadoPor' },
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
        dom: "B<'#colvis row'><'row'><'row'<'col-md-6'l><'col-md-6'f>r>t<'bottom'ip><'clear'>'",
        buttons:[ 
            {
                extend:    'excelHtml5',
                text:      'Descargar excel  <i Descargar excel class="fas fa-file-excel"></i> ',
                titleAttr: 'Descargar excel',
                autoFilter: true,
        title: 'Crédito de Farmaceutico ',
                className: 'btn btn-success'
            },
        ],
       
       
   
       
                    
    });     

</script>
<div class="text-center">
    <div class="table-responsive">
    <table  id="ProductosFarmaceutico" class="table table-hover">
<thead>

<th style = "background-color: #0057b8 !important;">Cod</th>
<th style = "background-color: #0057b8 !important;">Nombre</th>
<th style = "background-color: #0057b8 !important;">N° Ticket</th>
<th style = "background-color: #0057b8 !important;">Turno</th>
<th style = "background-color: #0057b8 !important;">Cantidad</th>
<th style = "background-color: #0057b8 !important;">P.U</th>
<th style = "background-color: #0057b8 !important;">Importe</th>
<th style = "background-color: #0057b8 !important;">Forma de pago</th>
<th style = "background-color: #0057b8 !important;">Servicio</th>
<th style = "background-color: #0057b8 !important;">Sucursal</th>
<th style = "background-color: #0057b8 !important;">Cliente</th>
<th style = "background-color: #0057b8 !important;">Fecha</th>
<th style = "background-color: #0057b8 !important;">Hora</th>   
<th style = "background-color: #0057b8 !important;">Vendedor</th>


</thead>

</div>
</div>


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
