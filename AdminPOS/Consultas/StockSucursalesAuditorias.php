


<script>
    $(document).ready(function () {
    var table = $('#Productos').DataTable({
        "bProcessing": true,
 "ordering": true,
 "stateSave":true,
 "bAutoWidth": false,
 "order": [[ 0, "desc" ]],
 "sAjaxSource": "https://saludapos.com/AdminPOS/Consultas/ArrayStockSucursalesAuditorias.php",
 "aoColumns": [
       { mData: 'Cod_Barra' },
    
       { mData: 'Nombre_Prod' },
       { mData: 'Precio_Venta' },
       { mData: 'Nom_Serv' },
       { mData: 'Tipo' },
       { mData: 'Proveedor1' },
       { mData: 'Proveedor2' },
       { mData: 'Sucursal' },
       { mData: 'UltimoMovimiento' },
       { mData: 'Existencias_R' },
       { mData: 'Min_Existencia' },
       { mData: 'Max_Existencia' },
   
 


    
  
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
          
        //para usar los botones   
        responsive: "true",
       
       
    });
 
    $('a.toggle-vis').on('click', function (e) {
        e.preventDefault();
 
        // Get the column API object
        var column = table.column($(this).attr('data-column'));
 
        // Toggle the visibility
        column.visible(!column.visible());
    });
});
</script>
<div class="text-center">

	<div class="table-responsive">
	<table  id="Productos" class="table table-hover">
<thead>

<th style="background-color:#0057b8 !important;">Cod Barra</th>

<th style="background-color:#0057b8 !important;">Nombre</th>
<th style="background-color:#0057b8 !important;">PV</th>
<th style="background-color:#0057b8 !important;">Servicio</th>
<th style="background-color:#0057b8 !important;">Tipo</th>
<th style="background-color:#0057b8 !important;">Proveedor 1</th>
<th style="background-color:#0057b8 !important;">Proveedor 2</th>
<th style="background-color:#0057b8 !important;">Sucursal</th>
<th style="background-color:#0057b8 !important;">Ultimo movimiento registrado</th>
<th style="background-color:#0057b8 !important;">Stock</th>




</thead>

</div>
</div>



