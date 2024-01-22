
<script>

tabla = $('#Traspasos').DataTable({

 "bProcessing": true,
 "ordering": true,
 "order": [[ 0, "desc" ]],
 "sAjaxSource": "https://controlfarmacia.com/JefaturaEnfermeria/Consultas/ArrrayTraspasosExcel.php",
 "aoColumns": [
       { mData: 'IDTraspasoGenerado' },
       { mData: 'Cod_Barra' },
       { mData: 'Nombre_Prod' },
       { mData: 'Proveedor1' },
       { mData: 'Proveedor2' },
       { mData: 'Fk_sucursal' },
       { mData: 'Destino' },
       { mData: 'Cantidad' },
       { mData: 'PrecioCompra' },
       { mData: 'PrecioVenta' },
       { mData: 'Total_traspaso' },
       { mData: 'TotalVenta' },
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
    { mData: 'Envio' },
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
        dom: "B<'#colvis row'><'row'><'row'<'col-md-6'l><'col-md-6'f>r>t<'bottom'ip><'clear'>'",
        buttons:[ 
			{
				extend:    'excelHtml5',
				text:      'Descargar excel  <i Descargar excel class="fas fa-file-excel"></i> ',
				titleAttr: 'Descargar excel',
                autoFilter: true,
        title: 'Traspasos Enero  ',
				className: 'btn btn-success'
			},
        ],
       
       
        	        
    });     

</script>
<div class="text-center">
	<div class="table-responsive">
	<table  id="Traspasos" class="table table-hover">
<thead>

<th>ID</th>
<th>Codigo de barras</th>
<th>Nombre</th>
<th>Proveedor 1</th>
<th>Proveedor 2</th>
<th>Origen</th>
<th>Destino</th>
<th>Cantidad</th>
<th>P.C</th>
<th>P.V</th>

<th>Total de precio compra</th>
<th>Total de precio venta</th>
<th>Fecha estimada de entrega</th>
<th>Estatus</th>
<th>Generado por</th>
<th>Recepciono</th>

</thead>

</div>
</div>


