
<script>

tabla = $('#Traspasos').DataTable({

 "bProcessing": true,
 "ordering": true,
 "order": [[ 0, "desc" ]],
 "sAjaxSource": "https://controlfarmacia.com/AdminPOS/Consultas/ArrrayTraspasosV2.php",
 "aoColumns": [
       { mData: 'FolioTraspaso' },
      
       { mData: 'Fk_sucursal' },
      
       { mData: 'Cantidad' },
       { mData: 'Total_compra' },
       { mData: 'TotalVenta' },
       
        { mData: 'Recibio' },
       { mData: 'Acciones' },
       
       
      ],
     
    
      "lengthMenu": [[20,50,150,250,500, -1], [20,50,150,250,500, "Todos"]],  
  
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

</script>
<div class="text-center">
	<div class="table-responsive">
	<table  id="Traspasos" class="table table-hover">
<thead>

<th>Folio de traspaso</th>
<th>Destino</th>
<th>Cantidad</th>
<th>Valor total de venta</th>
<th>Valor total de compra</th>
<th>Generado Por</th>
<th>Acciones</th>
</thead>

</div>
</div>


