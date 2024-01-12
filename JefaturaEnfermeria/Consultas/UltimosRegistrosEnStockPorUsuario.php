
<script>

tabla = $('#Productos').DataTable({

 "bProcessing": true,

 "sAjaxSource": "https://controlfarmacia.com/JefaturaEnfermeria/Consultas/UltimosRegistrosStock.php",
 "aoColumns": [
       { mData: 'Cod_Barra' },
       { mData: 'Nombre_Prod' },
     
       { mData: 'Precio_C' },
       { mData: 'Precio_Venta' },
       { mData: 'Nombre_Sucursal' },
       { mData: 'Existencias_R' },
       { mData: 'AgregadoPor' },
       { mData: 'Acciones' },
  
      ],
     
     "order": [[ 0, "desc" ]],
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
	<table  id="Productos" class="table table-hover">
<thead>

<th>Codigo </th>
    <th>Nombre</th>
   
    <th>PC</th>
    <th>PV </th>
    <th>Sucursal </th>
    <th>Existencias </th>
    <th>Actualizo </th>
    
    <th>Acciones </th>
	


</thead>

</div>
</div>

