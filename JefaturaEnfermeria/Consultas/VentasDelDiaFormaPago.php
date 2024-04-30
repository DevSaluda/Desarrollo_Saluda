
<script>

tabla = $('#ProductosEnfermeria').DataTable({

 "bProcessing": true,
 "ordering": true,
 "stateSave":true,
 "bAutoWidth": true,
 "order": [[ 0, "desc" ]],
 "sAjaxSource": "https://saludapos.com/JefaturaEnfermeria/Consultas/ArrayDesgloseVentasPorFormaDePago.php",
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
        title: 'Crédito enfermería ',
				className: 'btn btn-success'
			},
        ],
       
       
   
	   
        	        
    });     

</script>
<div class="text-center">
	<div class="table-responsive">
	<table  id="ProductosEnfermeria" class="table table-hover">
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

