
<script>

tabla = $('#Productos').DataTable({

 "bProcessing": true,
 "ordering": true,
 "stateSave":true,
 "bAutoWidth": false,
 "order": [[ 0, "desc" ]],
 "sAjaxSource": "https://saludapos.com/POS2/Consultas/RegistrosEnergiaArray.php",
 "aoColumns": [
       { mData: 'Id_Registro' },
       { mData: 'Registro_energia' },
       { mData: 'Fecha_registro' },
       { mData: 'Sucursal' },
       { mData: 'Comentario' },
       { mData: 'Foto' },
  
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
     /*    dom: "B<'#colvis row'><'row'><'row'<'col-md-6'l><'col-md-6'f>r>t<'bottom'ip><'clear'>'",
        // buttons:[ 
		// 	{
		// 		extend:    'excelHtml5',
		// 		text:      'Descargar excel  <i Descargar excel class="fas fa-file-excel"></i> ',
		// 		titleAttr: 'Descargar excel',
        //         autoFilter: true,
        // title: 'Traspasos Enero  ',
		// 		className: 'btn btn-success'
		// 	},
        // ], */
       
   
	   
        	        
    });     

</script>
<div class="text-center">
	<div class="table-responsive">
	<table  id="Productos" class="table table-hover">
<thead>

<th>ID</th>
    <th>Valor en kilowatts</th>
    <th>Fecha </th>
    <th>Sucursal</th>
    <th>Comentario</th>

    <th>Foto</th>

</thead>

</div>
</div>


