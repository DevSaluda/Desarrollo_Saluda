


<script>
    $(document).ready(function () {
    var table = $('#Productos').DataTable({
        "bProcessing": true,
 "ordering": true,
 "stateSave":true,
 "bAutoWidth": false,
 "order": [[ 0, "desc" ]],
 "sAjaxSource": "https://controlfarmacia.com/AdminPOS/Consultas/ArrayMobiliarioDisponible.php",
 "aoColumns": [
       { mData: 'Id_inventario' },
       { mData: 'Codigo' },
       { mData: 'Articulo' },
       { mData: 'Descripcion' },

       { mData: 'Marca' },
       { mData: 'Departamento' },
       { mData: 'Responsables' },
       { mData: 'Categoria' },
       { mData: 'Sucursal' },
       { mData: 'Valor' },
       { mData: 'Antiguedad' },
       { mData: 'Factura' },
       { mData: 'NSerie' },
       { mData: 'Vigencia' },
       { mData: 'Estado' },
       { mData: 'AgregadoEl' },
       { mData: 'AgregadoPor' },
      

       { mData: 'Acciones' }, 
       
  
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

<th>ID</th>
<th>Codigo</th>
<th>Articulo</th>
    <th>Descripcion</th>
    <th>Marca</th>
    <th>Departamento</th>
    <th>Responsables</th>
    <th>Categoria</th>
    <th>Sucursal </th>
    <th>Valor</th>
    <th>Antiguedad</th>
    <th>Factura</th>
    <th>Serie</th>
    <th>Vigencia</th>
        <th>Estado</th>
        <th>AgregadoEl </th>
        <th>AgregadoPor </th>
        <th>Acciones</th>


</thead>

</div>
</div>


