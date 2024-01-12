
<script>

tabla = $('#Traspasos').DataTable({

 "bProcessing": true,
 "ordering": true,
 "bAutoWidth": false,
 "order": [[ 0, "desc" ]],
 "sAjaxSource": "https://controlfarmacia.com/POS2/Consultas/ArrrayTraspasosAplicados.php",
 "aoColumns": [
       { mData: 'IDTraspasoGenerado' },
       { mData: 'Cod_Barra' },
       { mData: 'Nombre_Prod' },
       { mData: 'Fk_sucursal' },
       { mData: 'Destino' },
       { mData: 'Cantidad' },
       { mData: 'Orden' },
       { mData: 'Proveedor' },
       { mData: 'FechaEntrega' },
        {mData: "Estatus",
       "searchable": true,
        "orderable":true,
        "render": function (data, type, row) {
            if ( row.Estatus=="Generado") {

            return '<button class="btn btn-default btn-sm" style="background-color:#2b73bb !important">Generado / En ruta</button>';
        }
        else if ( row.Estatus=="Entregado,con detalles o incompleto") {
return '<button class="btn btn-default btn-sm" style="background-color:#ffc107!important">Entregado Con Detalle</button>'
        }
        
            else {
 
    return '<button class="btn btn-default btn-sm" style="background-color:#2bbb1d!important">Entregado</button>';
 
}
        }
 
    },
   
    { mData: 'Recibio' },
    
       
       
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

<th>ID</th>
<th>Codigo de barras</th>
<th>Nombre</th>
<th>Origen</th>
<th>Destino</th>
<th>Cantidad</th>
<th># de orden</th>
<th>Proveedor</th>
<th>Fecha estimada de entrega</th>
<th>Estatus</th>
<th>Recepciono</th>

</thead>

</div>
</div>


